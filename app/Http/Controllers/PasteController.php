<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rules\Password;
use App\Models\Paste;
use App\Helpers\Helpers;
use App\Helpers\PasteHelpers;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PasteController extends Controller
{

	/**
     * Display a paste
	*/
	public function create(Request $request, string $token)
	{
		if (!PasteHelpers::pasteExists($token))
			abort(404);

		$paste = Paste::select('title', 'content', 'syntax', 'password', 'privacy', 'expire', 'user', 'created_at', 'updated_at', 'deleted_at')
			->where(['token' => $token])
			->first();

		if (\is_null($paste))
			abort(404);
		
		if (PasteHelpers::isExpired($paste->expire))
			abort(404);

		$privacy = NULL;

		$data = [
			'token'					=>	$token,
			'title'					=>	NULL,
			'content'				=>	NULL,
			'syntax'				=>	NULL,
			'privacy'				=>	NULL,
			'size'					=>	NULL,
			'password_protected'	=>	false,
			'authorized'			=>	false,
			'created_at'			=>	Carbon::createFromFormat('Y-m-d H:i:s', $paste->created_at, (new \DateTimeZone('UTC')))->diffForHumans(),
			'expires_at'			=>	(!\is_null($paste->expire)) ? Carbon::createFromFormat('Y-m-d H:i:s', $paste->expire, (new \DateTimeZone('UTC')))->diffForHumans() : 'Never',
		];

		$paste->privacy = \intval($paste->privacy);

		switch (\intval( $paste->privacy )) {
				
			case 1:
				$privacy = 'Unlisted';
				break;

			case 2:
				$privacy = 'Password protected';
				$data['password_protected'] = true;
				$data['authorized'] = PasteHelpers::isAuthorized($token);
				break;

			default:
				$privacy = 'Public';

		}

		if (!$data['password_protected'] || $data['authorized'])
		{
			$paste->syntax = \intval( $paste->syntax );
			$data['syntax'] = PasteHelpers::resolveSyntaxHighlightLanguage( $paste->syntax );

			$data['title'] = (!\is_string($paste->title) || Str::of($paste->title)->trim()->isEmpty()) ? 'Untitled' : Str::of($paste->title)->trim()->toString();
			$data['content'] = $paste->content;
			$data['privacy'] = $privacy;
			$data['size'] = Helpers::formatBytes(\mb_strlen($data['content'], 'utf-8'));
		}
		else
		{
			$data['title'] = 'Protected Content';
		}
		
		return view('view', $data);
	}


	/**
     * Authenticate user to password protected content.
	*/
	public function auth(Request $request, string $token)
	{
		$validator = Validator::make(request()->all(), [
			'password' => ['required', 'string']
        ]);

		if ($validator->fails()) {
			return response()->json([
				'success'	=>	false,
				'message'	=>	'Sorry, but some fields are invalid.',
				'errors'	=>	$validator->errors()
			])->setStatusCode(400);
        }

		$validated = $validator->validated();

		$ip = request()->ip();
		$hash = \md5($ip . '|' . $token);

		if (RateLimiter::remaining('unlock-paste:' . $hash, $perMinute = 5))
		{
			RateLimiter::hit('unlock-paste:' . $hash);

			if (!PasteHelpers::pasteExists($token))
			{
				return response()->json([
					'success'	=>	false,
					'message'	=>	'Sorry, but this paste does not exist.',
					'errors'	=>	[]
				])->setStatusCode(404);
			}

			$paste = Paste::select('password', 'expire', 'privacy')
				->where(['token' => $token])
				->first();

			if (\is_null($paste) || PasteHelpers::isExpired($paste->expire))
			{
				return response()->json([
					'success'	=>	false,
					'message'	=>	'Sorry, but this paste does not exist.',
					'errors'	=>	[]
				])->setStatusCode(404);
			}
			
			$paste->privacy = \intval( $paste->privacy );
			
			if ($paste->privacy !== 2 || !\is_string($paste->password))
			{
				return response()->json([
					'success'	=>	false,
					'message'	=>	'This paste is not password protected.',
					'errors'	=>	[]
				])->setStatusCode(400);
			}
			
			if (Hash::check($validated['password'], $paste->password))
			{
				PasteHelpers::authorizeView($token);
				
				return response()->json([
					'success'	=>	true,
					'message'	=>	'The paste has been unlocked successfully. You must submit the password again in 10 minutes.',
					'errors'	=>	[]
				])->setStatusCode(200);
			}
			else
			{
				return response()->json([
					'success'	=>	false,
					'message'	=>	'Sorry, but you entered a wrong password.',
					'errors'	=>	[]
				])->setStatusCode(401);
			}
			

		} else {
			return response()->json([
				'success'	=>	false,
				'message'	=>	'You have hit the rate limit for this resource. Please try again later!',
				'errors'	=>	[]
			])->setStatusCode(429);
		}
		
	}


	/**
     * Display a raw paste
	*/
	public function createRaw(Request $request, string $token)
	{
		if (!PasteHelpers::pasteExists($token))
			abort(404);

		$paste = Paste::select('content', 'privacy', 'expire',)
			->where(['token' => $token])
			->first();

		if (\is_null($paste) || PasteHelpers::isExpired($paste->expire))
			abort(404);

		$paste->privacy = \intval( $paste->privacy );

		if ($paste->privacy === 2 && !PasteHelpers::isAuthorized($token))
			abort(401);

		return response($paste->content)
					->header('Content-Type', 'text/plain; charset=utf-8')
					->header('Content-Length', Str::of($paste->content)->length('utf-8'));
	}

    
	/**
     * Handle incoming paste creation.
	*/
	public function store(Request $request)
	{
		$validator = Validator::make(request()->all(), [
			'title' => ['nullable', 'string', 'max:70'],
			'content' => ['required', 'string', 'min:1', 'max:16777215'],
			'syntax' => ['required', 'integer', 'in:0,1,2,3,4,5,6,7,8,9,10,11'],
            'expire' => ['required', 'integer', 'in:0,1,2,3,4,5,6,7,8,9,10'],
			'privacy' => ['required', 'integer', 'in:0,1,2'],
			'password' => ['nullable', 'string', 'required_if:privacy,2', Password::min(6)],
			'h-captcha-response' => 'required|HCaptcha'
        ]);

		if ($validator->fails()) {
			return response()->json([
				'success'	=>	false,
				'message'	=>	'Sorry, but some fields are invalid.',
				'errors'	=>	$validator->errors()
			])->setStatusCode(400);
        }

		$validated = $validator->validated();

		$ip = request()->ip();
		$hash = \md5($ip);

		if (RateLimiter::remaining('submit-paste:' . $hash, $perMinute = 2)) {
			
			RateLimiter::hit('submit-paste:' . $hash);

			$token = PasteHelpers::createToken();

			$expire = PasteHelpers::resolveExpirationDate(\intval( $validated['expire'] ));

			if (!\is_null($validated['password']))
				$validated['password'] = Hash::make($validated['password']);

			Paste::create([
				'token'			=>	$token,
				'title'			=>	!\is_null($validated['title']) ? Str::of($validated['title'])->trim()->toString() : NULL,
				'content'		=>	'',
				'syntax'		=>	$validated['syntax'],
				'privacy'		=>	$validated['privacy'],
				'password'		=>	$validated['password'],
				'creation_ip'	=>	$ip,
				'expire'		=>	$expire
			]);

			$id = DB::getPdo()->lastInsertId();
			
			try {
				Paste::where([
					'id'			=>	$id
				])->update([
					'content'		=>	$validated['content']
				]);
			} catch (\Throwable $ex) {
				Log::channel(['stderr', 'errorlog'])->error($ex->getMessage());
				Paste::where('id', $id)->forceDelete();

				return response()->json([
					'success'	=>	true,
					'message'	=>	'Oops! You’ve caught a rare error. This is probably our fault, so please try again in a moment.',
					'errors'	=>	[],
					'data'		=>	[]
				])->setStatusCode(500);
			}
			
			return response()->json([
				'success'	=>	true,
				'message'	=>	'OK',
				'errors'	=>	[],
				'data'		=>	[
					'id'	=>	$token
				]
			])->setStatusCode(200);
		} else {
			return response()->json([
				'success'	=>	false,
				'message'	=>	'You have hit the rate limit for this resource. Please try again later!',
				'errors'	=>	[]
			])->setStatusCode(429);
		}
	}
}

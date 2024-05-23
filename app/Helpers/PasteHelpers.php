<?php

namespace App\Helpers;
use Illuminate\Http\Request;
use App\Helpers\Helpers;
use App\Models\Paste;
use Carbon\Carbon;


class PasteHelpers
{
	/**
	 * Check if a paste exists by its token.
	 *
	 * @param  string $token
	 * @return boolean
	 */
	public static function pasteExists(string $token) : bool
	{
		$id = Paste::select('id')->where(['token' => $token])->first();
		return (!\is_null($id));
	}


	/**
	 * Generate an unique token for a new paste.
	 *
	 * @return string
	 */
	public static function createToken() : string
	{
		$token = Helpers::randomString('alnum', 7);
		$doesNotExist = false;

		while (!$doesNotExist)
		{
			if (!PasteHelpers::pasteExists($token))
			{
				$doesNotExist = true;
				break;
			}

			$token = Helpers::randomString('alnum', 7);
		}

		return $token;
	}


	/**
	 * Check if client is authorized to view a password protected paste.
	 *
	 * @param  string  $token
	 * @return boolean
	 */
	public static function isAuthorized(string $token) : bool
	{
		$data = session()->get('paste.auth');

		if (\is_null($data) || !\is_array($data) || !\array_key_exists($token, $data))
			return false;
		
		$expire = $data[$token];
		$now = Carbon::now('UTC');

		if ($now->gt($expire))
		{
			unset($data[$token]);
			session()->put('paste.auth', $data);
			return false;
		}
		else
			return true;
	}


	/**
	 * Authorize client to view password protected paste.
	 *
	 * @param  string $token
	 * @return void
	 */
	public static function authorizeView(string $token) : void
	{
		$data = session()->get('paste.auth');

		if (\is_null($data))
		{
			$data = [];
			$data[$token] = Carbon::now('UTC')->addMinutes(10);
		}
		else
		{
			if (\array_key_exists($token, $data))
				unset($data[$token]);

			$data[$token] = Carbon::now('UTC')->addMinutes(10);
		}

		session()->put('paste.auth', $data);
		
	}


	/**
	 * Generate Carbon object for paste expiration from an expiration date option in a request.
	 *
	 * @param  integer $expire
	 * @return Carbon\Carbon
	 */
	public static function resolveExpirationDate(int $expire)
	{
		$date = Carbon::now('UTC');
		switch ($expire) {
			
			case 0:
				$date = NULL;
				break;
			
			case 1:
				$date = $date->addMinutes(15);
				break;

			case 2:
				$date = $date->addMinutes(30);
				break;

			case 3:
				$date = $date->addHour();
				break;

			case 4:
				$date = $date->addHours(12);
				break;

			case 5:
				$date = $date->addHours(24);
				break;

			case 6:
				$date = $date->addWeek();
				break;

			case 7:
				$date = $date->addWeeks(2);
				break;

			case 8:
				$date = $date->addMonth();
				break;

			case 9:
				$date = $date->addMonths(6);
				break;

			case 10:
				$date = $date->addYear();
				break;

			default:
				$date = NULL;

		}

		return $date;
	}


	/**
	 * Compare expiration timestamp with current time
	 * to determine whether a paste is expired or not.
	 *
	 * @param  mixed   $expire
	 * @return boolean
	 */
	public static function isExpired(mixed $expire = NULL) : bool
	{
		if (\is_null($expire) || !\is_string($expire))
			return false;

		$now = Carbon::now('UTC');
		$expires_at = Carbon::createFromFormat('Y-m-d H:i:s', $expire, (new \DateTimeZone('UTC')));

		return ($now->gt($expires_at));
	}


	/**
	 * Convert syntax highlighting option for client-side.
	 *
	 * @param  integer $syntax
	 * @return array
	 */
	public static function resolveSyntaxHighlightLanguage(int $syntax) : array
	{
		$data = [
			'id'			=>	NULL,
			'language'		=>	NULL,
			'codeMirror'	=>	[
				'mode'		=>	NULL,
				'scripts'	=>	[]
			]
		];

		$data['id'] = \intval( $syntax );

		switch ($syntax) {

			case 1:
				$data['language'] = 'HTML';
				$data['codeMirror']['mode'] = 'htmlmixed';
				$data['codeMirror']['scripts'][] = '<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/mode/htmlmixed/htmlmixed.min.js" integrity="sha512-HN6cn6mIWeFJFwRN9yetDAMSh+AK9myHF1X9GlSlKmThaat65342Yw8wL7ITuaJnPioG0SYG09gy0qd5+s777w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
				$data['codeMirror']['scripts'][] = '<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/mode/vbscript/vbscript.min.js" integrity="sha512-8X458sUg/WhaOx+sZNj5qcqKLafbr9KulHj/KBfR+1x3GoI8orXv0bXyoowx0AyS6FVFQfqkntrJ2opVzIvmDg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
				$data['codeMirror']['scripts'][] = '<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/mode/javascript/javascript.min.js" integrity="sha512-I6CdJdruzGtvDyvdO4YsiAq+pkWf2efgd1ZUSK2FnM/u2VuRASPC7GowWQrWyjxCZn6CT89s3ddGI+be0Ak9Fg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
				$data['codeMirror']['scripts'][] = '<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/mode/css/css.min.js" integrity="sha512-rQImvJlBa8MV1Tl1SXR5zD2bWfmgCEIzTieFegGg89AAt7j/NBEe50M5CqYQJnRwtkjKMmuYgHBqtD1Ubbk5ww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
				$data['codeMirror']['scripts'][] = '<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/mode/xml/xml.min.js" integrity="sha512-LarNmzVokUmcA7aUDtqZ6oTS+YXmUKzpGdm8DxC46A6AHu+PQiYCUlwEGWidjVYMo/QXZMFMIadZtrkfApYp/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
				break;

			case 2:
				$data['language'] = 'JavaScript';
				$data['codeMirror']['mode'] = 'text/javascript';
				$data['codeMirror']['scripts'][] = '<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/mode/javascript/javascript.min.js" integrity="sha512-I6CdJdruzGtvDyvdO4YsiAq+pkWf2efgd1ZUSK2FnM/u2VuRASPC7GowWQrWyjxCZn6CT89s3ddGI+be0Ak9Fg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
				break;

			case 3:
				$data['language'] = 'CSS';
				$data['codeMirror']['mode'] = 'text/css';
				$data['codeMirror']['scripts'][] = '<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/mode/css/css.min.js" integrity="sha512-rQImvJlBa8MV1Tl1SXR5zD2bWfmgCEIzTieFegGg89AAt7j/NBEe50M5CqYQJnRwtkjKMmuYgHBqtD1Ubbk5ww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
				break;

			case 4:
				$data['language'] = 'XML';
				$data['codeMirror']['mode'] = 'application/xml';
				$data['codeMirror']['scripts'][] = '<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/mode/xml/xml.min.js" integrity="sha512-LarNmzVokUmcA7aUDtqZ6oTS+YXmUKzpGdm8DxC46A6AHu+PQiYCUlwEGWidjVYMo/QXZMFMIadZtrkfApYp/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
				break;

			case 5:
				$data['language'] = 'SQL';
				$data['codeMirror']['mode'] = 'text/x-sql';
				$data['codeMirror']['scripts'][] = '<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/mode/sql/sql.min.js" integrity="sha512-JOURLWZEM9blfKvYn1pKWvUZJeFwrkn77cQLJOS6M/7MVIRdPacZGNm2ij5xtDV/fpuhorOswIiJF3x/woe5fw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
				break;

			case 6:
				$data['language'] = 'PHP';
				$data['codeMirror']['mode'] = 'text/x-php';
				$data['codeMirror']['scripts'][] = '<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/mode/htmlmixed/htmlmixed.min.js" integrity="sha512-HN6cn6mIWeFJFwRN9yetDAMSh+AK9myHF1X9GlSlKmThaat65342Yw8wL7ITuaJnPioG0SYG09gy0qd5+s777w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
				$data['codeMirror']['scripts'][] = '<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/mode/javascript/javascript.min.js" integrity="sha512-I6CdJdruzGtvDyvdO4YsiAq+pkWf2efgd1ZUSK2FnM/u2VuRASPC7GowWQrWyjxCZn6CT89s3ddGI+be0Ak9Fg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
				$data['codeMirror']['scripts'][] = '<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/mode/css/css.min.js" integrity="sha512-rQImvJlBa8MV1Tl1SXR5zD2bWfmgCEIzTieFegGg89AAt7j/NBEe50M5CqYQJnRwtkjKMmuYgHBqtD1Ubbk5ww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
				$data['codeMirror']['scripts'][] = '<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/mode/xml/xml.min.js" integrity="sha512-LarNmzVokUmcA7aUDtqZ6oTS+YXmUKzpGdm8DxC46A6AHu+PQiYCUlwEGWidjVYMo/QXZMFMIadZtrkfApYp/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
				$data['codeMirror']['scripts'][] = '<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/mode/clike/clike.min.js" integrity="sha512-l8ZIWnQ3XHPRG3MQ8+hT1OffRSTrFwrph1j1oc1Fzc9UKVGef5XN9fdO0vm3nW0PRgQ9LJgck6ciG59m69rvfg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
				$data['codeMirror']['scripts'][] = '<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/mode/php/php.min.js" integrity="sha512-jZGz5n9AVTuQGhKTL0QzOm6bxxIQjaSbins+vD3OIdI7mtnmYE6h/L+UBGIp/SssLggbkxRzp9XkQNA4AyjFBw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
				break;

			case 7:
				$data['language'] = 'Java';
				$data['codeMirror']['mode'] = 'text/x-java';
				$data['codeMirror']['scripts'][] = '<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/mode/clike/clike.min.js" integrity="sha512-l8ZIWnQ3XHPRG3MQ8+hT1OffRSTrFwrph1j1oc1Fzc9UKVGef5XN9fdO0vm3nW0PRgQ9LJgck6ciG59m69rvfg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
				break;

			case 8:
				$data['language'] = 'C#';
				$data['codeMirror']['mode'] = 'text/x-csharp';
				$data['codeMirror']['scripts'][] = '<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/mode/clike/clike.min.js" integrity="sha512-l8ZIWnQ3XHPRG3MQ8+hT1OffRSTrFwrph1j1oc1Fzc9UKVGef5XN9fdO0vm3nW0PRgQ9LJgck6ciG59m69rvfg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
				break;

			case 9:
				$data['language'] = 'Shell';
				$data['codeMirror']['mode'] = 'application/x-sh';
				$data['codeMirror']['scripts'][] = '<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/mode/shell/shell.min.js" integrity="sha512-HoC6JXgjHHevWAYqww37Gfu2c1G7SxAOv42wOakjR8csbTUfTB7OhVzSJ95LL62nII0RCyImp+7nR9zGmJ1wRQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
				break;

			case 10:
				$data['language'] = 'Python';
				$data['codeMirror']['mode'] = 'text/x-python';
				$data['codeMirror']['scripts'][] = '<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/mode/python/python.min.js" integrity="sha512-2M0GdbU5OxkGYMhakED69bw0c1pW3Nb0PeF3+9d+SnwN1ryPx3wiDdNqK3gSM7KAU/pEV+2tFJFbMKjKAahOkQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
				break;

			case 10:
				$data['language'] = 'Python';
				$data['codeMirror']['mode'] = 'text/x-python';
				$data['codeMirror']['scripts'][] = '<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/mode/python/python.min.js" integrity="sha512-2M0GdbU5OxkGYMhakED69bw0c1pW3Nb0PeF3+9d+SnwN1ryPx3wiDdNqK3gSM7KAU/pEV+2tFJFbMKjKAahOkQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
				break;

			case 11:
				$data['language'] = 'C++';
				$data['codeMirror']['mode'] = 'text/x-c++src';
				$data['codeMirror']['scripts'][] = '<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/mode/clike/clike.min.js" integrity="sha512-l8ZIWnQ3XHPRG3MQ8+hT1OffRSTrFwrph1j1oc1Fzc9UKVGef5XN9fdO0vm3nW0PRgQ9LJgck6ciG59m69rvfg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
				break;

			default:
				$data['language'] = NULL;
				$data['codeMirror']['mode'] = NULL;

			
		}


		return $data;
	}

}
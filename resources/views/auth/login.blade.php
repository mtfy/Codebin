@extends('layouts.main')

@section('title', 'Sign In')

@section('content')
	<div class="flex flex-col self-center items-center w-full max-w-[100%] container relative pt-[64px]">
		<div class="flex flex-col w-full max-w-[100%] lg:max-w-[1024px] xl:max-w-[1140px] 2xl:max-w-[1280px] relative p-4">
			<div class="flex flex-col py-12 text-center w-full justify-center items-center relative">
				<h1 class="text-3xl md:text-4xl font-satoshi font-medium text-theme-foreground-contrast capitalize leading-loose mb-2">Sign In</h1>
				<p class="text-lg font-inter font-light text-theme-foreground-primary leading-relaxed">If you do not have an account, <a href="{{ route('auth.register') }}" class="text-blue-400 hover:text-blue-500 transition-general">create one</a>. Forgot your password? <a href="{{ route('auth.register') }}" class="text-blue-400 hover:text-blue-500 transition-general">Reset it here</a>.</p>
			</div>
			<div class="flex flex-col px-4 w-full justify-center items-left relative max-w-[100%] md:max-w-[75%] lg:max-w-[50%] md:self-center">
				<h4 class="text-lg md:text-xl font-inter font-medium text-theme-foreground-contrast leading-loose mb-5">Login to {{ \ucfirst(\mb_strtolower(config('app.name'), 'utf-8')) }}</h4>
				<form class="flex flex-col w-full relative justify-center items-center space-y-6" method="POST" id="login-form">
					<div class="flex flex-col w-full relative">
						<div class="flex flex-col w-full">
							<div class="flex flex-col w-full">
								<x-forms.input type="email" style="alternative" id="email" name="email" label="Email" placeholder="your@example.com" autocomplete="email" />
								<span class="whitespace-nowrap text-red-400 text-[11px] leading-loose __hidden" aria-hidden="true" id="email-error"></span>
							</div>
						</div>
					</div>
					<div class="flex flex-col w-full relative">
						<div class="flex flex-col w-full">
							<div class="flex flex-col w-full">
								<x-forms.input type="password" style="alternative" id="password" name="password" label="Password" placeholder="Password" autocomplete="password" />
								<span class="whitespace-nowrap text-red-400 text-[11px] leading-loose __hidden" aria-hidden="true" id="password-error"></span>
							</div>
						</div>
					</div>
					<div class="flex flex-col space-y-6 w-full relative">
						<div class="flex flex-col w-full">
							<x-forms.checkbox id="remember" name="remember" label="Remember this device" />
						</div>
					</div>
					<div class="flex flex-col w-full relative items-center justify-center pt-6">
						<x-forms.button type="submit" id="submit" name="submit" style="primaryNoRadius" class="flex flex-row space-x-2 items-center justify-center capitalize px-16 py-3 lg:px-48">
							<div class="flex flex-col"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="18" height="18" viewBox="0 0 16 16" aria-hidden="true"><path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/><path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/></svg></div>
							<div class="flex flex-col text-[18px] leading-loose">Sign in</div>
						</x-button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
@extends('layouts.main')

@section('title', 'Sign Up')

@section('content')
	<div class="flex flex-col self-center items-center w-full max-w-[100%] container relative pt-[64px]">
		<div class="flex flex-col w-full max-w-[100%] lg:max-w-[1024px] xl:max-w-[1140px] 2xl:max-w-[1280px] relative p-4">
			<div class="flex flex-col py-12 text-center w-full justify-center items-center relative">
				<h1 class="text-3xl md:text-4xl font-satoshi font-medium text-theme-foreground-contrast capitalize leading-loose mb-2">Sign Up</h1>
				<p class="text-lg font-inter font-light text-theme-foreground-primary leading-relaxed">Signing up gives more features and takes a maximum of 1 minute to complete.</p>
			</div>
			<div class="flex flex-col px-4 w-full justify-center items-left relative">
				<h4 class="text-lg md:text-xl font-inter font-medium text-theme-foreground-contrast leading-loose capitalize mb-5">Account Details</h4>
				<form class="flex flex-col w-full relative justify-center items-center space-y-6" method="POST" id="register-form">
					<div class="flex flex-col space-y-8 md:space-y-0 md:space-x-8 md:flex-row w-full relative">
						<div class="flex flex-col w-full md:w-6/12">
							<div class="flex flex-col w-full">
								<x-forms.input type="email" style="alternative" id="email" name="email" label="Email" placeholder="your@example.com" autocomplete="email" />
								<span class="whitespace-nowrap text-red-400 text-[11px] leading-loose __hidden" aria-hidden="true" id="email-error"></span>
							</div>
						</div>
						<div class="flex flex-col w-full md:w-6/12">
							<div class="flex flex-col w-full">
								<x-forms.input type="text" style="alternative" id="name" name="name" label="Display Name" placeholder="John Doe" autocomplete="off" />
								<span class="whitespace-nowrap text-red-400 text-[11px] leading-loose __hidden" aria-hidden="true" id="name-error"></span>
							</div>
						</div>
					</div>
					<div class="flex flex-col space-y-6 md:space-y-0 md:space-x-8 md:flex-row w-full relative">
						<div class="flex flex-col w-full md:w-6/12">
							<div class="flex flex-col w-full">
								<x-forms.input type="password" style="alternative" id="password" name="password" label="Password" placeholder="Password" autocomplete="new-password" />
								<span class="whitespace-nowrap text-red-400 text-[11px] leading-loose __hidden" aria-hidden="true" id="password-error"></span>
							</div>
						</div>
						<div class="flex flex-col w-full md:w-6/12">
							<div class="flex flex-col w-full">
							<x-forms.input type="password" style="alternative" id="password_confirm" name="password_confirm" label="Confirm Password" placeholder="Confirm Password" autocomplete="new-password" />
								<span class="whitespace-nowrap text-red-400 text-[11px] leading-loose __hidden" aria-hidden="true" id="password_confirm-error"></span>
							</div>
						</div>
					</div>
					<div class="block w-full relative py-8 pointer-events-none select-none">
						<hr class="border-theme-300 block w-full" />
					</div>
					<div class="flex flex-col space-y-6 w-full relative md:px-6">
						<div class="flex flex-col w-full">
							<x-forms.checkbox id="terms" name="terms" label="I agree to the Terms of Service & Privacy Policy" />
						</div>
					</div>
					<div class="flex flex-col w-full relative items-center justify-center pt-6">
						<x-forms.button type="submit" id="submit" name="submit" style="primaryNoRadius" class="flex flex-row space-x-2 items-center justify-center capitalize px-16 py-3 lg:px-48">
							<div class="flex flex-col"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="20" height="20" viewBox="0 0 16 16" aria-hidden="true"><path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/><path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/></svg></div>
							<div class="flex flex-col text-[18px] leading-loose">Sign up</div>
						</x-button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
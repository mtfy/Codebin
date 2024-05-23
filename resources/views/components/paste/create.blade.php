@pushOnce('styles')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/codemirror.min.css" integrity="sha512-uf06llspW44/LZpHzHT6qBOIVODjWtv4MxCricRxkzvopAlSWnTf6hpZTFxuuZcuNE9CBQhqE0Seu1CoRk84nQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/addon/dialog/dialog.min.css" integrity="sha512-Vogm+Cii1SXP5oxWQyPdkA91rHB776209ZVvX4C/i4ypcfBlWVRXZGodoTDAyyZvO36JlTqDqkMhVKAYc7CMjQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endPushOnce
@pushOnce('meta')
	<meta name="hcaptcha-site-key" content="{{ env('HCAPTCHA_SITEKEY', '') }}" />
@endPushOnce
@pushOnce('scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/codemirror.min.js" integrity="sha512-8RnEqURPUc5aqFEN04aQEiPlSAdE0jlFS/9iGgUyNtwFnSKCXhmB6ZTNl7LnDtDWKabJIASzXrzD0K+LYexU9g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/addon/dialog/dialog.min.js" integrity="sha512-NAJeqwfpM7/nfX90EweQhjudb66diK3Y9mkBjb4xJ6wufuVqFVAjHd8mJW//CGHNR9cI8wUfDRJ0jtLzZ9v8Qg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/addon/comment/comment.min.js" integrity="sha512-UaJ8Lcadz5cc5mkWmdU8cJr0wMn7d8AZX5A24IqVGUd1MZzPJTq9dLLW6I102iljTcdB39YvVcCgBhM0raGAZQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/addon/comment/continuecomment.min.js" integrity="sha512-bPfnPUeDAbKU71b0+CKJBuYLXujAOrzS3bjB1GLr5lgmPEjvWYnmjOG8cioWf7YdSj/SaXMCnYr44C/E0XGzTw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/addon/search/search.min.js" integrity="sha512-Mw3RqCUHTyvN3iSp5TSs731TiLqnKrxzyy2UVZv3+tJa524Rj7pBC7Ivv3ka2oDnkQwLOMHNDKU5nMJ16YRgrA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/addon/search/searchcursor.min.js" integrity="sha512-+ZfZDC9gi1y9Xoxi9UUsSp+5k+AcFE0TRNjI0pfaAHQ7VZTaaoEpBZp9q9OvHdSomOze/7s5w27rcsYpT6xU6g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/addon/search/jump-to-line.min.js" integrity="sha512-cFdaiExVrVnsHaQhcn3wR9zyndnXI6w7diUSonYbGoV6v/PgBEGZevVC4gvg+Jz5yfO3K0/r1ZMk3+IcdEl+pQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	{!! HCaptcha::renderJs(NULL, true, '__hCaptchaLoad') !!}
@endPushOnce

<form method="POST" class="flex flex-col w-full max-w-[100%] relative" id="{{ $attributes['id'] ?? 'createPasteForm' }}">
	@csrf
	
	<div class="flex flex-col w-full max-w-[100%] relative">
		<div class="flex flex-col lg:flex-row space-y-6 lg:space-y-0 lg:space-x-4 w-full max-w-[100%] relative">
			<div class="flex flex-col w-full lg:grow lg:shrink lg:w-3/12">
				<div class="flex flex-col w-full bg-theme-400 shadow-sm rounded-lg h-full">
					<div class="flex flex-col w-full px-6 py-5 border-b border-theme-500">
						<span class="text-md text-theme-foreground-primary font-satoshi font-medium">Create a new paste</span>
					</div>
					<div class="flex flex-col w-full p-4 pb-6 space-y-6 lg:grow lg:shrink">
						<div class="flex flex-col w-full">
							<x-forms.input type="text" style="primary" id="title" name="title" label="Title" placeholder="Untitled" autocomplete="off" />
							<span class="whitespace-nowrap text-red-400 text-[11px] leading-loose __hidden" aria-hidden="true" id="title-error"></span>
						</div>
						<div class="flex flex-col w-full">
							<div class="flex flex-col space-y-2 relative">
								<label class="whitespace-nowrap text-theme-foreground-primary text-sm font-semibold" for="syntax">Syntax</label>
								<select id="syntax" name="syntax" class="whitespace-nowrap text-foreground-primary text-sm bg-theme-400 border border-theme-600 ring-theme-500 block w-full px-2.5 py-2 text-foreground-primary placeholder-neutral-400 focus:ring">
									<option value="0">None</option>
									<option value="1">HTML</option>
									<option value="2">Javascript</option>
									<option value="3">CSS</option>
									<option value="4">XML</option>
									<option value="5">SQL</option>
									<option value="6">PHP</option>
									<option value="7">Java</option>
									<option value="8">C#</option>
									<option value="9">Shell</option>
									<option value="10">Python</option>
									<option value="11">C++</option>
								</select>
							</div>
						</div>
						<div class="flex flex-col w-full">
							<div class="flex flex-col space-y-2 relative">
								<label class="whitespace-nowrap text-theme-foreground-primary text-sm font-semibold" for="expire">Expires</label>
								<select id="expire" name="expire" class="whitespace-nowrap text-foreground-primary text-sm bg-theme-400 border border-theme-600 ring-theme-500 block w-full px-2.5 py-2 text-foreground-primary placeholder-neutral-400 focus:ring">
									<option value="0" selected="">Never</option>
									<option value="1">15 Minutes</option>
									<option value="2">30 Minutes</option>
									<option value="3">1 Hour</option>
									<option value="4">12 Hours</option>
									<option value="5">1 Day</option>
									<option value="6">1 Week</option>
									<option value="7">2 Weeks</option>
									<option value="8">1 Month</option>
									<option value="9">6 Months</option>
									<option value="10">1 Year</option>
								</select>
							</div>
						</div>
						<div class="flex flex-col w-full">
							<div class="flex flex-col space-y-2 relative">
								<label class="whitespace-nowrap text-theme-foreground-primary text-sm font-semibold" for="privacy">Privacy</label>
								<select id="privacy" name="privacy" class="whitespace-nowrap text-foreground-primary text-sm bg-theme-400 border border-theme-600 ring-theme-500 block w-full px-2.5 py-2 text-foreground-primary placeholder-neutral-400 focus:ring">
									<option value="0" selected="">Public</option>
									<option value="1">Unlisted</option>
									<option value="2">Password Protected</option>
								</select>
							</div>
						</div>
						<div class="flex flex-col w-full transition-general __hidden" id="password-wrapper" aria-hidden="true">
							<x-forms.input type="text" style="primary" id="password" name="password" label="Password" autocomplete="off" helperText="Set a password required for viewing this paste." />
							<span class="whitespace-nowrap text-red-400 text-[11px] leading-loose __hidden" aria-hidden="true" id="password-error"></span>
						</div>
						<div class="flex flex-col w-full relative __hidden" aria-hidden="true" data-site-key="{{ env('HCAPTCHA_SITEKEY', '') }}" id="captcha-1" data-size="invisible"></div>
						<div class="flex flex-col w-full h-full justify-end space-y-3 md:space-y-4">
							<div class="flex flex-col w-full justify-center items-center relative">
								<div class="text-[10.8px] leading-tight text-neutral-400" data-nosnippet="">This site is protected by <a class="transition-general text-neutral-300 hover:opacity-90" href="https://www.hcaptcha.com/" referrerpolicy="no-referrer" rel="external">hCaptcha</a> and its <a class="transition-general text-neutral-300 hover:opacity-90" href="https://www.hcaptcha.com/privacy" referrerpolicy="no-referrer" rel="external" target="_blank">Privacy Policy</a> and <a class="transition-general text-neutral-300 hover:opacity-90" href="https://www.hcaptcha.com/terms" referrerpolicy="no-referrer" rel="external" target="_blank">Terms of Service</a> apply.</div>
							</div>
							<div class="flex flex-col w-full">
							<span class="whitespace-nowrap text-red-400 text-[11px] leading-loose p-0 mb-1 w-full __hidden" aria-hidden="true" id="h-captcha-response-error" data-nosnippet="">Please verify that you are not a robot.</span>
								<x-forms.button
									style="primaryNoRadius"
									class="flex flex-row space-x-2 items-center justify-center capitalize px-4 py-3"
									type="submit"
									name="submit"
									id="submit"
									disabled=""
									aria-disabled="true"
								>
									<div class="flex flex-col"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" fill="currentColor" width="18" height="18" viewBox="0 0 512 512" class="select-none pointer-events-none leading-[20px]"><path d="M384,224V408a40,40,0,0,1-40,40H104a40,40,0,0,1-40-40V168a40,40,0,0,1,40-40H271.48" style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"/><path d="M459.94,53.25a16.06,16.06,0,0,0-23.22-.56L424.35,65a8,8,0,0,0,0,11.31l11.34,11.32a8,8,0,0,0,11.34,0l12.06-12C465.19,69.54,465.76,59.62,459.94,53.25Z"/><path d="M399.34,90,218.82,270.2a9,9,0,0,0-2.31,3.93L208.16,299a3.91,3.91,0,0,0,4.86,4.86l24.85-8.35a9,9,0,0,0,3.93-2.31L422,112.66A9,9,0,0,0,422,100L412.05,90A9,9,0,0,0,399.34,90Z"/></svg><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" width="18" height="18" class="select-none pointer-events-none leading-[20px] __hidden" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid"><circle cx="50" cy="50" fill="none" stroke="currentColor" stroke-width="10" r="35" stroke-dasharray="164.93361431346415 56.97787143782138"><animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="0.6666666666666666s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform></circle></svg></div>
									<div class="flex flex-col">Create</div>
								</x-forms.button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="flex flex-col w-full lg:grow lg:shrink lg:w-9/12">
				<div class="flex flex-col relative w-full bg-theme-400 shadow-sm rounded-lg lg:h-full">
					<div class="flex flex-col w-full p-4 relative lg:h-full">
						<div class="flex cm-wrapper flex-col w-full relative lg:h-full" id="textarea-wrapper" style="visibility:hidden">
							<textarea id="editor"></textarea>
						</div>
						<span class="whitespace-nowrap text-red-400 text-[11px] leading-loose __hidden" aria-hidden="true" id="content-error"></span>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
<script type="text/javascript">
	window.__hCaptchaWidgetID = null;

	window.__hCaptchaLoad = function () {
		window.console.log('Initialized hCaptcha');
		
		var widgetID = null, __siteKey = null;
		
		const meta = document.querySelector(`meta[name="hcaptcha-site-key"][content]`);

		if (null !== meta) {
			const attr = meta.getAttribute('content');
			if (null !== attr && 'string' === typeof attr) {
				__siteKey = attr;
				
			}
		}
		
		if (null !== __siteKey) {
			try {
				widgetID = window.hcaptcha.render('captcha-1', { sitekey: __siteKey });
			} catch (err) {
				widgetID = null;
				window.console.error('Unable to render hCatpcha widget.', err);
			}
		}

		if (null !== widgetID) {
			window.__hCaptchaWidgetID = widgetID;
		}
		
	}
</script>
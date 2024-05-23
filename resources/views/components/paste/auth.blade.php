<form method="POST" class="flex flex-col w-full max-w-[100%] relative" id="{{ $attributes['id'] ?? 'authPasteForm' }}">
	@csrf
	<input type="hidden" name="token" class="__hidden hidden" value="{{ $token }}" disabled="" aria-hidden="true" aria-disabled="true" />
	<div class="flex flex-col w-full max-w-[100%] lg:max-w-[50%] xl:max-w-[33.33%] self-center relative">
		<div class="flex flex-col w-full justify-center items-center relative shadow-xl bg-theme-400 rounded-lg h-full">
			<div class="flex flex-col w-full px-6 py-5 border-b border-theme-500">
				<span class="text-md w-full text-theme-foreground-primary font-satoshi font-medium truncate whitespace-nowrap">Protected Content</span>
			</div>
			<div class="flex flex-col w-full p-4 pb-6 lg:p-8 lg:pb-12 space-y-6 lg:grow lg:shrink">
				<div class="flex flex-col w-full">
					<x-forms.input type="password" style="primary" id="password" name="password" label="Password" autocomplete="off" helperText="Enter the password for viewing this paste." required="" aria-required="true" />
					<span class="whitespace-nowrap text-red-400 text-[11px] leading-loose __hidden" aria-hidden="true" id="password-error"></span>
				</div>
				<div class="flex flex-col w-full h-full justify-end">
					<div class="flex flex-col w-full">
						<x-forms.button
							style="secondary"
							class="flex flex-row space-x-2 items-center justify-center capitalize px-4 py-3"
							type="submit"
							name="submit"
							id="submit"
							disabled=""
							aria-disabled="true"
						>
							<div class="flex flex-col"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="18" height="18" viewBox="0 0 16 16" aria-hidden="true" class="select-none pointer-events-none leading-[20px]"><path d="M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2zM3 8a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1H3z"/></svg><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" width="18" height="18" class="select-none pointer-events-none leading-[20px] __hidden" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid"><circle cx="50" cy="50" fill="none" stroke="currentColor" stroke-width="10" r="35" stroke-dasharray="164.93361431346415 56.97787143782138"><animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="0.6666666666666666s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform></circle></svg></div>
							<div class="flex flex-col">Unlock</div>
						</x-forms.button>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
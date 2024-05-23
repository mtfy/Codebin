<div class="flex flex-col w-full justify-center items-center min-h-[65px] max-h-[65px] h-[65px] m-0 p-[12px] overflow-hidden transition-general fixed z-[7668] active-navigation bg-theme-500">
	<div class="flex flex-row m-0 w-full justify-between items-center min-h-[65px] max-h-[65px] h-[65px] max-w-[100%] lg:max-w-[1024px] xl:max-w-[1280px] z-[7668] relative">
		<a href="{{ route('home') }}" class="flex flex-row items-center justify-center space-x-[1.25px] m-0 p-0 relative font-satoshi text-theme-foreground-lighter hover:text-theme-foreground-darker text-[24px] leading-tight font-medium transition-general hover:opacity-70 select-none z-[7669]" role="banner">
			{!! config('app.logo') !!}
		</a>
		<div class="flex flex-col justify-center items-center m-0 p-0 relative">
			<nav class="flex flex-col justify-center items-center w-full m-0 p-0 relative top-navigation" role="navigation">
				<ul class="flex flex-row space-x-4 justify-center items-center text-[14px] leading-loose list-none text-center font-satoshi">
					<li>
						<x-forms.button style="primary" class="flex flex-row space-x-2 items-center justify-center capitalize px-4 py-2" href="#">
							<div class="flex flex-col"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="14" height="14" viewBox="0 0 512 512"><path d="M320 96V80C320 53.49 298.5 32 272 32H215.4C204.3 12.89 183.6 0 160 0S115.7 12.89 104.6 32H48C21.49 32 0 53.49 0 80v320C0 426.5 21.49 448 48 448l144 .0013L192 176C192 131.8 227.8 96 272 96H320zM160 88C146.8 88 136 77.25 136 64S146.8 40 160 40S184 50.75 184 64S173.3 88 160 88zM416 128v96h96L416 128zM384 224L384 128h-112C245.5 128 224 149.5 224 176v288c0 26.51 21.49 48 48 48h192c26.51 0 48-21.49 48-48V256h-95.99C398.4 256 384 241.6 384 224z"/></svg></div>
							<div class="flex flex-col">Create</div>
						</x-button>
					</li>
					@php
						/*<li>
							<x-forms.button style="primaryNoRadius" class="flex flex-row space-x-2 items-center justify-center capitalize px-4 py-2" href="{{ route('auth.login') }}">
								<div class="flex flex-col"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="18" height="18" viewBox="0 0 16 16" aria-hidden="true"><path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/><path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/></svg></div>
								<div class="flex flex-col">Sign in</div>
							</x-button>
						</li>
						<li>
							<x-forms.button style="secondaryNoRadius" class="flex flex-row space-x-2 items-center justify-center capitalize px-4 py-2" href="{{ route('auth.register') }}">
								<div class="flex flex-col"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="18" height="18" viewBox="0 0 16 16" aria-hidden="true"><path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/><path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/></svg></div>
								<div class="flex flex-col">Sign Up</div>
							</x-button>
						</li>*/
					@endphp
				</ul>
			</nav>
		</div>
	</div>
</div>
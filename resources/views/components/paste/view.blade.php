	<div class="flex flex-col w-full max-w-[100%] relative" id="{{ $attributes['id'] ?? 'viewPasteForm' }}">
		<textarea class="hidden __hidden" id="__data" autocomplete="off" readonly="" disabled="" aria-autocomplete="off" aria-disabled="true" aria-readonly="true" aria-hidden="true">{{ $content }}</textarea>
		<div class="flex flex-col w-full max-w-[100%] relative">
			<div class="flex flex-col lg:flex-row space-y-6 lg:space-y-0 lg:space-x-4 w-full max-w-[100%] relative">
				<div class="flex flex-col w-full lg:grow lg:shrink lg:w-3/12">
					<div class="flex flex-col w-full bg-theme-400 shadow-sm rounded-lg h-full">
						<div class="flex flex-col w-full px-6 py-5 border-b border-theme-500">
							<span class="text-md w-full text-theme-foreground-primary font-satoshi font-medium truncate whitespace-nowrap">{{ $title }}</span>
						</div>
						<div class="flex flex-col w-full p-4 pb-6 space-y-6 lg:grow lg:shrink">
							<div class="flex flex-col w-full">
								<span class="text-sm text-theme-foreground-darker font-satoshi">Author</span>
								<span class="text-md text-theme-foreground-primary font-satoshi font-medium">Anonymous</span>
							</div>
							<div class="flex flex-col w-full">
								<span class="text-sm text-theme-foreground-darker font-satoshi">Created</span>
								<span class="text-md text-theme-foreground-primary font-satoshi font-medium">{{ $createdAt }}</span>
							</div>
							<div class="flex flex-col w-full">
								<span class="text-sm text-theme-foreground-darker font-satoshi">Expires</span>
								<span class="text-md text-theme-foreground-primary font-satoshi font-medium">{{ $expireAt }}</span>
							</div>
							<div class="flex flex-col w-full">
								<span class="text-sm text-theme-foreground-darker font-satoshi">Privacy</span>
								<span class="text-md text-theme-foreground-primary font-satoshi font-medium">{{ $privacy }}</span>
							</div>
							<div class="flex flex-col w-full">
								<span class="text-sm text-theme-foreground-darker font-satoshi">Size</span>
								<span class="text-md text-theme-foreground-primary font-satoshi font-medium">{{ $fileSize }}</span>
							</div>
							<div class="flex flex-col w-full max-w-[100%] space-y-4 md:space-y-3">
								<div class="flex flex-col w-full justify-center space-y-4 md:space-y-0 md:space-x-3 md:flex-row md:justify-between items-center relative">
									<div class="flex flex-col w-full md:max-w-6/12">
										<x-forms.button
											style="primaryNoRadius"
											class="flex flex-row space-x-1 items-center justify-center capitalize px-3 py-3 lg:py-2 w-full"
											href="{{ route('paste.raw', $token) }}"
										>
											<div class="flex flex-col"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="16" fill="currentColor" viewBox="0 0 16 16" class="leading-[20px]" aria-hidden="true"><path fill-rule="evenodd" d="M2 12.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/></svg></div>
											<div class="flex flex-col">View raw</div>
										</x-forms.button>
									</div>
									<div class="flex flex-col w-full md:max-w-6/12">
										<x-forms.button
											style="primaryNoRadius"
											class="flex flex-row space-x-1 items-center justify-center capitalize px-3 py-3 lg:py-2 w-full"
											type="button"
											id="copy"
											disabled=""
											aria-disabled="true"
										>
											<div class="flex flex-col"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="leading-[20px]" aria-hidden="true"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" /><rect x="9" y="3" width="6" height="4" rx="2" /><path d="M9 12h6" /><path d="M9 16h6" /></svg></div>
											<div class="flex flex-col">Copy</div>
										</x-forms.button>
									</div>
								</div>
								<div class="flex flex-col w-full justify-center items-center relative">
									<x-forms.button
										style="primaryNoRadius"
										class="flex flex-row space-x-2 items-center justify-center capitalize px-4 py-3 lg:py-2 w-full"
										type="button"
										id="download"
										disabled=""
										aria-disabled="true"
										data-token="{{ $token }}"
									>
										<div class="flex flex-col"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="18" height="18" viewBox="0 0 256 256" class="leading-[20px]" aria-hidden="true"><rect width="256" height="256" fill="none"/><path d="M80.3,115.7a8.2,8.2,0,0,1-1.7-8.7,8,8,0,0,1,7.4-5h34V40a8,8,0,0,1,16,0v62h34a8,8,0,0,1,7.4,5,8.2,8.2,0,0,1-1.7,8.7l-42,42a8.2,8.2,0,0,1-11.4,0ZM216,144a8,8,0,0,0-8,8v56H48V152a8,8,0,0,0-16,0v56a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V152A8,8,0,0,0,216,144Z"/></svg></div>
										<div class="flex flex-col">Download</div>
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
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
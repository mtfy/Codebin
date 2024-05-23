<!DOCTYPE html>
<html lang="en">
    <head>
	<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		
		<link rel="preconnect" href="https://fonts.googleapis.com" />
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="" />
		<link rel="preconnect" href="https://api.fontshare.com" />
		<link rel="preconnect" href="https://cdn.fontshare.com" crossorigin="" />

		<link href="https://api.fontshare.com/v2/css?f[]=satoshi@900,700,500,300,400&display=swap" rel="stylesheet" />
		<link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />

		<title>@yield('title') &#x2d; {{ config('app.name') }}</title>
		
		@vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/components/core.js'])
		
		@stack('styles')
    </head>
    <body class="theme-dark antialiased bg-theme-background-primary text-theme-foreground-primary">
		<header class="flex flex-col w-full p-0 m-0 relative">
			@include('components.navigation')
		</header>
        <main class="flex flex-col w-full max-w-[100%] relative py-8 min-height justify-center items-center">
            <div class="flex flex-col self-center items-center w-full max-w-[100%] container relative pt-[64px]">
                <div class="flex items-center justify-center">
                    <div class="px-4 border-r border-gray-400 leading-loose">
                        <span class="text-lg text-theme-foreground-primary whitespace-prewrap font-satoshi tracking-wider">@yield('code')</span>
                    </div>
					<div class="ml-4 leading-loose">
                        <span class="text-lg text-theme-foreground-primary uppercase font-satoshi whitespace-prewrap font-satoshi tracking-wider">@yield('message')</span>
                    </div>
                </div>
            </div>
		</main>
		@include('components.footer')
		@stack('scripts')
    </body>
</html>

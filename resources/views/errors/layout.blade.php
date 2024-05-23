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
		
		@vite(['resources/css/app.css', 'resources/js/app.js'])
		
		@stack('styles')
    </head>
    <body class="theme-dark antialiased bg-theme-background-primary text-theme-foreground-primary">
		<header class="flex flex-col w-full p-0 m-0 relative">
			@include('components.navigation')
		</header>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title">
                    @yield('message')
                </div>
            </div>
        </div>
		@include('components.footer')
		@stack('scripts')
    </body>
</html>

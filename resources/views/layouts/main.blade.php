<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	@stack('meta')

		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-title" content="{{ config('app.name') }}">
		<meta name="HandheldFriendly" content="true">
		<meta name="application-name" content="{{ config('app.name') }}">
		<meta name="format-detection" content="telephone=no">
		<meta name="theme-color" content="#404040">
		<meta name="author" content="{{ config('app.author') }}">
		<meta name="title" content="@yield('title')">
		<meta name="description" content="@yield('description')">
		<meta property="og:site_name" content="{{ config('app.name') }}">
		<meta property="og:type" content="website">
		<meta property="og:title" content="@yield('title')">
		<meta property="og:description" content="@yield('description')">
		<meta name="twitter:title" content="@yield('title')">
		<meta name="twitter:description" content="@yield('description')">
		
		<link rel="preconnect" href="https://fonts.googleapis.com" />
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="" />
		<link rel="preconnect" href="https://api.fontshare.com" />
		<link rel="preconnect" href="https://cdn.fontshare.com" crossorigin="" />

		<link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
		<link href="https://api.fontshare.com/v2/css?f[]=satoshi@900,700,500,300,400&display=swap" rel="stylesheet" />

		<title>@yield('title') &#x2d; {{ config('app.name') }}</title>
		
		@vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/components/core.js'])
@stack('styles')
	</head>
	<body class="theme-dark antialiased bg-theme-background-primary text-theme-foreground-primary">
		<header class="flex flex-col w-full p-0 m-0 relative">
			@include('components.navigation')
		</header>
		<main class="flex flex-col w-full max-w-[100%] relative py-8 min-height">
			@yield('content')
		</main>
		@include('components.footer')
		@stack('scripts')

	</body>
</html>

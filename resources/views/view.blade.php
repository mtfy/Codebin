@extends('layouts.main')

@section('title', $title)
@section('description', \sprintf('%s is a privacy focused text and code snippet sharing platform with many advanced features and utilities.', config('app.name')))

@php
	$codeMirrorOptions = '';
	if ( isset($syntax) && !\is_null($syntax) && \is_array($syntax) && \array_key_exists('language', $syntax) && !\is_null($syntax['language']) && \array_key_exists('codeMirror', $syntax) && !\is_null($syntax['codeMirror']['mode']) )
		$codeMirrorOptions = '<script>window.__szkfrm={\'language\':\'' . $syntax['language'] . '\',\'mode\':\'' . $syntax['codeMirror']['mode'] . '\'}</script>';
	
@endphp

@pushOnce('styles')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/codemirror.min.css" integrity="sha512-uf06llspW44/LZpHzHT6qBOIVODjWtv4MxCricRxkzvopAlSWnTf6hpZTFxuuZcuNE9CBQhqE0Seu1CoRk84nQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/addon/dialog/dialog.min.css" integrity="sha512-Vogm+Cii1SXP5oxWQyPdkA91rHB776209ZVvX4C/i4ypcfBlWVRXZGodoTDAyyZvO36JlTqDqkMhVKAYc7CMjQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endPushOnce

@pushOnce('scripts')
		<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/codemirror.min.js" integrity="sha512-8RnEqURPUc5aqFEN04aQEiPlSAdE0jlFS/9iGgUyNtwFnSKCXhmB6ZTNl7LnDtDWKabJIASzXrzD0K+LYexU9g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/addon/dialog/dialog.min.js" integrity="sha512-NAJeqwfpM7/nfX90EweQhjudb66diK3Y9mkBjb4xJ6wufuVqFVAjHd8mJW//CGHNR9cI8wUfDRJ0jtLzZ9v8Qg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/addon/comment/comment.min.js" integrity="sha512-UaJ8Lcadz5cc5mkWmdU8cJr0wMn7d8AZX5A24IqVGUd1MZzPJTq9dLLW6I102iljTcdB39YvVcCgBhM0raGAZQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/addon/comment/continuecomment.min.js" integrity="sha512-bPfnPUeDAbKU71b0+CKJBuYLXujAOrzS3bjB1GLr5lgmPEjvWYnmjOG8cioWf7YdSj/SaXMCnYr44C/E0XGzTw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/addon/search/search.min.js" integrity="sha512-Mw3RqCUHTyvN3iSp5TSs731TiLqnKrxzyy2UVZv3+tJa524Rj7pBC7Ivv3ka2oDnkQwLOMHNDKU5nMJ16YRgrA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/addon/search/searchcursor.min.js" integrity="sha512-+ZfZDC9gi1y9Xoxi9UUsSp+5k+AcFE0TRNjI0pfaAHQ7VZTaaoEpBZp9q9OvHdSomOze/7s5w27rcsYpT6xU6g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/addon/search/jump-to-line.min.js" integrity="sha512-cFdaiExVrVnsHaQhcn3wR9zyndnXI6w7diUSonYbGoV6v/PgBEGZevVC4gvg+Jz5yfO3K0/r1ZMk3+IcdEl+pQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	@php
		if ( isset($syntax) && !\is_null($syntax) && \is_array($syntax) && \array_key_exists('language', $syntax) && !\is_null($syntax['language']) && \array_key_exists('codeMirror', $syntax) )
		{
			foreach ( $syntax['codeMirror']['scripts'] as $script )
				echo "\n\t" . $script;
		}
	@endphp
@endPushOnce

@section('content')
	<div class="flex flex-col self-center items-center w-full max-w-[100%] container relative pt-[64px]">
		<div class="flex flex-col w-full max-w-[100%] lg:max-w-[1024px] 2xl:max-w-[1280px] relative p-4">
			@if (!$password_protected || $authorized)
				<x-paste.view id="viewPasteForm" token="{{ $token }}" content="{!! $content !!}" privacy="{{ $privacy }}" title="{{ $title }}" expireAt="{{ $expires_at }}" createdAt="{{ $created_at }}" fileSize="{{ $size }}" />
			@else
				<x-paste.auth id="authPasteForm" token="{{ $token }}" />
			@endif
		</div>
	</div>
	@if (!$password_protected)
		{!! $codeMirrorOptions !!}
	@endif
@endsection
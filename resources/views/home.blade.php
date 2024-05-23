@extends('layouts.main')

@section('title', 'Home')
@section('description', \sprintf('%s is a privacy focused text and code snippet sharing platform with many advanced features and utilities.', config('app.name')))

@section('content')
	<div class="flex flex-col self-center items-center w-full max-w-[100%] container relative pt-[64px]">
		<div class="flex flex-col w-full max-w-[100%] lg:max-w-[1024px] 2xl:max-w-[1280px] relative p-4">
			<x-paste.create id="createPasteForm" />
		</div>
	</div>
@endsection
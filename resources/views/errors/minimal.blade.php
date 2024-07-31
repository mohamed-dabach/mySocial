@extends('layouts.main')
@section('main')
    <div class="flex items-center justify-center h-[calc(100vh_-_100px)] text-gray-600 dark:text-gray-300 text-xl">
        <div>
            @yield('code')
            @yield('message')
        </div>
    </div>
@endsection

<!DOCTYPE html>
<html lang="en" data-mode="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <title>My App | @yield('title')</title>
</head>

<body class="dark:bg-gray-800">
    @include('partials.nav')
    <div class="max-w-[600px] m-auto">
        @auth
            @if (!Auth::user()->email_verified_at)
                <p class="text-yellow-600 my-2 rounded-lg bg-yellow-100 px-3 py-2 flex items-center justify-between"> Confirm
                    your email first can't create, update, delete any post<a href="#"
                        class="hover:text-yellow-800 ">Send</a></p>
            @endif
        @endauth

        @yield('main')
    </div>
</body>

</html>

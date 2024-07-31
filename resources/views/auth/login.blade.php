@extends('layouts.main')
@section('title', 'login')

@section('main')
    <section class="bg-gray-50   dark:text-gray-300">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0  dark:bg-gray-800">
            {{-- {{ dd($errors) }} --}}
            <div class="w-full bg-white rounded-lg shadow :mt-0 sm:max-w-md xl:p-0  dark:bg-gray-600">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl  dark:text-gray-300">
                        Sign in to your account
                    </h1>
                    @if ($errors->has('error'))
                        <div class="text-red-500">{{ $errors->first('error') }}</div>
                    @endif
                    @if (session('message'))
                        <div class="bg-green-100 text-green-700 py-2 px-3 rouned-lg" onclick="this.remove()">
                            {{ session('message') }}
                        </div>
                    @endif

                    <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('login.check') }}">
                        @csrf

                        <div>
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900  dark:text-gray-300">Your
                                email</label>
                            <input type="text" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:bg-gray-700 dark:text-gray-300 dark:border-none"
                                placeholder="name@company.com">
                            @if ($errors->has('email'))
                                <div class="text-red-500">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900  dark:text-gray-300">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:bg-gray-700 dark:text-gray-300 dark:border-none">
                            @if ($errors->has('password'))
                                <div class="text-red-500">{{ $errors->first('password') }}</div>
                            @endif

                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="remember" name="rememberMe" type="checkbox"
                                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 -700 -600 -primary-600 -gray-800">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="remember" class="text-gray-500 -300  dark:text-gray-400">Remember me</label>
                                </div>
                            </div>
                            <a href="{{ route('password.request') }}"
                                class="text-sm font-medium text-primary-600 hover:underline -500">Forgot
                                password?</a>
                        </div>
                        <button type="submit"
                            class="w-full text-white bg-blue-500 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center -600 -primary-700 -primary-800">Sign
                            in</button>
                        <p class="text-sm font-light text-gray-500  dark:text-gray-300">
                            Don’t have an account yet? <a href="{{ route('signup') }}"
                                class="font-medium text-primary-600 hover:underline ">Sign up</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

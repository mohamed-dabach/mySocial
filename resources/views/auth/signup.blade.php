@extends('layouts.main')

@section('title', 'signup')

@section('main')
    <section class="bg-gray-50 dark:bg-gray-800">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">

            <div class="w-full bg-white  rounded-lg shadow :mt-0 sm:max-w-md xl:p-0  dark:bg-gray-600 dark:text-gray-300">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-gray-300 ">
                        Sign in to your account
                    </h1>
                    <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('signup.save') }}">
                        @csrf
                        <div>
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900  dark:text-gray-300">Your
                                name</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:bg-gray-700 dark:text-gray-300 dark:border-none"
                                placeholder="name" value="{{ Str::random(3) }}">

                        </div>
                        <div>
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900  dark:text-gray-300">Your
                                email</label>
                            <input type="text" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:bg-gray-700 dark:text-gray-300 dark:border-none"
                                placeholder="email" value="{{ Str::random(10) . '@' . 'test.com' }}">
                        </div>
                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 ">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••" value="123"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5  dark:bg-gray-700 dark:text-gray-300 dark:border-none">
                        </div>

                        <button type="submit"
                            class="w-full text-white bg-blue-500 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center -600 -primary-700 -primary-800">Sign
                            in</button>
                        <p class="text-sm font-light text-gray-500  dark:text-gray-400">
                            Already have an accout? <a href="/login"
                                class="font-medium text-primary-600 hover:underline  dark:text-gray-300">Login</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

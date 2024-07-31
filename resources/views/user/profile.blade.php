@extends('layouts.main')
@section('title', 'Pofile')
@section('main')

    <div class="p-16 bg-gray-50 dark:bg-gray-600  dark:text-gray-300">

        <div class="container px-2 m-auto">
            <div class="flex flex-col justify-center items-center">
                <div class="">
                    <img style="width: 200px; height:200px"src="{{ $data->profile_img }}" alt="img"
                        class="w-full rounded-[50%] object-cover ">
                </div>
                <div>
                    <p class="font-bold mb-2 text-lg mt-3">{{ $data->name }}</p>
                </div>
                <div class="flex gap-3">
                    <div class="flex flex-col items-center">
                        <p class="font-bold text-gray-700 dark:text-gray-300 text-xl">0</p>
                        <p class="text-gray-400 ">Friends</p>
                    </div>

                    <div class="flex flex-col items-center">
                        <p class="font-bold text-gray-700 dark:text-gray-300 text-xl">{{ $data->posts_count }}</p>
                        <p class="text-gray-400 ">Posts</p>
                    </div>
                    <div class="flex flex-col items-center">
                        <p class="font-bold text-gray-700 dark:text-gray-300 text-xl">{{ $data->comments_count }}</p>
                        <p class="text-gray-400 ">Comments</p>
                    </div>
                </div>
            </div>
            @if (Auth::user()->id == $data->id)
                <section class=" dark:text-gray-300 text-gray-900 mt-4">
                    <div class="flex flex-col items-center justify-center px-6  py-8 mx-auto  lg:py-0 dark:text-gray-300">

                        <h1
                            class="text-xl font-bold leading-tight tracking-tight text-gray-900 dark:text-gray-300 md:text-2xl ">
                            Api Access Token </h1>
                        <form action="{{ route('tokens.store') }}" method="POST" class=" mt-3 w-full">
                            @csrf
                            <div class=" flex">
                                <input type="text" name="name" id="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 dark:text-gray-700 sm:text-sm rounded-lg  rounded-e-none focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                    placeholder="Token name">
                                <button type="submit"
                                    class=" text-white bg-blue-500 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg rounded-s-none text-sm px-3 py-2.5 text-center">Generate</button>
                            </div>
                            <div class="flex gap-2 mt-2">
                                <div>
                                    <input type="checkbox" id="view" checked name="view">
                                    <label for="view">View</label>
                                </div>
                                |
                                <div>
                                    <input type="checkbox" id="create" name="create">
                                    <label for="create">Create</label>
                                </div>
                                |
                                <div>
                                    <input type="checkbox" id="update" name="update">
                                    <label for="update">Update</label>
                                </div>
                                |
                                <div>
                                    <input type="checkbox" id="delete" name="delete">
                                    <label for="delete">Delete</label>
                                </div>


                            </div>
                        </form>
                        <div class=" my-4 w-full">
                            <ul class=" w-full">
                                @if (session('token'))
                                    <span class="text-red-500">Please copy your token, It will disapair after refresh</span>
                                    <br>
                                    <div class="flex mb-5">

                                        {{ Str::limit(session('token'), 10) }} <svg
                                            onclick="navigator.clipboard.writeText('{{ session('token') }}')" title="Copy"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            class="w-6 h-6 text-blue-500 cursor-pointer">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                                        </svg>


                                    </div>
                                @endif
                                @foreach (array_reverse($apiTokens) as $apiToken)
                                    @include('user.partials.apiTokenItem')
                                @endforeach


                            </ul>

                        </div>
                    </div>

                </section>
                <section class="">
                    <div class="flex flex-col items-center justify-center  py-8 mx-auto lg:py-0 dark:text-gray-300">

                        <div class="w-full   xl:p-0">
                            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                                @if (session('message'))
                                    <div class="bg-green-100 text-green-700 py-2 px-3 rouned-lg" onclick="this.remove()">
                                        {{ session('message') }}
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <ul class="bg-red-100 text-red-700 py-2 px-3 rouned-lg" onclick="this.remove()">
                                        @foreach ($errors->all() as $error)
                                            <li class="flex
                                    justify-between">
                                                {{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                                <h1
                                    class="text-xl text-center font-bold leading-tight tracking-tight text-gray-900 dark:text-gray-300 md:text-2xl ">
                                    Update Your Credentials
                                </h1>
                                <form class="space-y-4 md:space-y-6" method="POST" enctype="multipart/form-data"
                                    action="{{ route('user.update') }}">
                                    @method('PUT')
                                    @csrf
                                    <div>
                                        <label for="name"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 ">Your
                                            name</label>
                                        <input type="text" name="name" id="name"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 dark:text-gray-700 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 -700 -600 -400  -blue-500 -blue-500"
                                            placeholder="name" value="{{ Auth::user()->name }}">
                                    </div>
                                    <div>
                                        <label for="email"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 ">Your
                                            email</label>
                                        <input type="text" name="email" id="email"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 dark:text-gray-700 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 -700 -600 -400  -blue-500 -blue-500"
                                            placeholder="email" value="{{ Auth::user()->email }}">
                                    </div>
                                    <div>
                                        <label for="image"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 ">Your
                                            image</label>
                                        <input type="file" name="image" id="image"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 dark:text-gray-700 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 -700 -600 -400  -blue-500 -blue-500"
                                            placeholder="profile Image">
                                    </div>
                                    <div>
                                        <label for="password"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 ">Current
                                            Password</label>
                                        <input type="password" name="password" id="password" placeholder="••••••••"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 dark:text-gray-700 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 -700 -600 -400  -blue-500 -blue-500">
                                    </div>

                                    <button type="submit"
                                        class="w-full text-white bg-blue-500 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center -600 -primary-700 -primary-800">Update</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
        </div>
    </div>
@endsection

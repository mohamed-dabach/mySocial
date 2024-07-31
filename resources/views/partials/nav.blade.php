<nav class="bg-gray-50 dark:bg-gray-700 dark:text-gray-300 ">
    <div class="max-w-screen-xl px-4 py-5 mx-auto">
        <div class="flex items-center justify-between">
            @Auth
                <div>
                    <p>name: {{ Auth::user()->name }}</p>
                </div>
            @endAuth


            <ul class="flex flex-row  font-medium mt-0 space-x-8 rtl:space-x-reverse text-sm">
                <li>
                    <button class=""
                        onclick="if (document.documentElement.getAttribute('data-mode') === 'dark') { document.documentElement.removeAttribute('data-mode'); localStorage.setItem('theme', 'light'); ; } else { document.documentElement.setAttribute('data-mode', 'dark'); localStorage.setItem('theme', 'dark'); }">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 hidden dark:block">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 block dark:hidden">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                        </svg>


                    </button>
                </li>
                @Auth
                    <li>
                        <a href="{{ route('user.index', Auth::user()->id) }}" class=" hover:underline">
                            Profile</a>
                    </li>
                    <li>
                        <a href="{{ route('home') }}" class="  hover:underline">Home</a>
                    </li>

                    <li>
                        <a href="{{ route('user.posts', Auth::user()->id) }}" class=" hover:underline">My
                            Posts</a>
                    </li>
                    <li>
                        <a href="{{ route('posts.create') }}" class="  hover:underline">
                            New Post</a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}" class=" hover:underline">Logout</a>
                    </li>
                @endAuth


                @guest
                    <li>
                        <a href="{{ route('login') }}" class=" hover:underline">Login</a>
                    </li>
                    <li>
                        <a href="{{ route('signup') }}" class=" hover:underline">Sign up</a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

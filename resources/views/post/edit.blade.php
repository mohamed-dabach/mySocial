@extends('layouts.main')

@section('main')
    <div>
        <div class="container m-auto px-2">
            @if ($errors->any())
                <ul class=" bg-red-100 text-red-700 py-2 px-3 rouned-lg" onclick="this.remove()">
                    @foreach ($errors->all() as $error)
                        <li class="flex
                justify-between"> {{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <form action="{{ route('posts.update', $post->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div>
                    <label for="title" class="block mb-2  font-medium text-gray-900
                    ">Post
                        title</label>
                    <input type="text" id="title" name="title"
                        class=" bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:text-gray-300 dark:border-none"
                        placeholder="Your Post Title" value="{{ old('title', $post->title) }}" />
                    @if ($errors->has('title'))
                        <p class="text-red-500 text-sm mt-1 mb-2 italic">{{ $errors->first('title') }}</p>
                    @endIf
                </div>
                <div>

                    <label for="disc" class="block mb-2  font-medium text-gray-900 ">Post
                        description</label>
                    <textarea id="disc" rows="4" name="disc"
                        class="block p-2.5 w-full text-gray-900  bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500  dark:bg-gray-700 dark:text-gray-300 dark:border-none"
                        placeholder="Your Post Description">{{ old('disc', $post->disc) }}</textarea>
                    @if ($errors->has('disc'))
                        <p class="text-red-500 text-sm mt-1 mb-2 italic">{{ $errors->first('disc') }}</p>
                    @endIf
                </div>
                <div class="flex gap-3">

                    <button type="submit"
                        class=" block text-white mt-2  bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg  w-full sm:w-auto px-5 py-2.5 text-center">Post</button>
                    <a href="{{ route('user.posts', Auth::id()) }}"
                        class="block text-white mt-2  bg-gray-500 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg  w-full sm:w-auto px-5 py-2.5 text-center">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection

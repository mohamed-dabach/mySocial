@extends('layouts.main')

@section('main')
    <div>
        <div class="container m-auto px-2">
            <form action="{{ route('posts.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div>
                    <label for="title" class="block mb-2  font-medium text-gray-900
                    ">Post
                        title</label>
                    <input type="text" id="title" name="title"
                        class="bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:text-gray-300 dark:border-none"
                        placeholder="Your Post Title" value="{{ old('title') }}" />
                    @if ($errors->has('title'))
                        <p class="text-red-500 text-sm mt-1 mb-2 italic">{{ $errors->first('title') }}</p>
                    @endIf
                </div>
                <div>
                    <label for="image" class="block mb-2  font-medium text-gray-900
                    ">Post
                        image</label>
                    <input type="file" id="image" name="image"
                        class="bg-gray-50 border border-gray-300 text-gray-900  rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:text-gray-300 dark:border-none"
                        value="{{ old('image') }}" />
                    @if ($errors->has('image'))
                        <p class="text-red-500 text-sm mt-1 mb-2 italic">{{ $errors->first('image') }}</p>
                    @endIf
                </div>
                <div>

                    <label for="disc" class="block mb-2  font-medium text-gray-900 ">Post
                        description</label>
                    <textarea id="disc" rows="4" name="disc"
                        class="block p-2.5 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:text-gray-300 dark:border-none"
                        placeholder="Your Post Description">{{ old('disc') }}</textarea>
                    @if ($errors->has('disc'))
                        <p class="text-red-500 text-sm mt-1 mb-2 italic">{{ $errors->first('disc') }}</p>
                    @endIf
                </div>
                <button type="submit"
                    class=" block text-white mt-2 bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg  w-full sm:w-auto px-5 py-2.5 text-center">Post</button>
            </form>
        </div>
    </div>
@endsection

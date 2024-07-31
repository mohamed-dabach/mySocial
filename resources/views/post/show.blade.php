@extends('layouts.main')

@section('title', $post->title)
@section('main')
    <div class="py-4  m-auto dark:text-gray-300">
        <div class="container px-2 m-auto">
            @if (session('message'))
                <div class="bg-green-100 text-green-700 py-2 px-3 rouned-lg" onclick="this.remove()">
                    {{ session('message') }}
                </div>
            @endif


            @if ($errors->any())
                <ul class="bg-red-100 text-red-700 py-2 px-3 rouned-lg" onclick="this.remove()">
                    @foreach ($errors->all() as $error)
                        <li class="flex
                justify-between"> {{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <h3 class="text-2xl font-bold">
                {{ $post->title }}
            </h3>
            <div class="flex justify-between items-center">

                <p class="italic font-semibold mt-2">{{ $post->user->name }}</p>
                <p class="font-semibold">{{ $post->created_at->diffForHumans() }}</p>
            </div>
            <br>
            <p class="text-lg">
                {{ $post->disc }}
            </p>
            @if ($post->image)
                <div class="my-4">
                    <img src="{{ $post->image }}" class="object-cover rounded-lg" alt="image">
                </div>
            @endIf
            <br>
            <div class="flex items-center justify-start">

                <form action="{{ route('like.addOrRemoveLike') }}" method="POST">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            class="w-6 h-6 stroke-slate-600 {{ $post->like['userLiked'] ? 'fill-gray-700 dark:fill-white ' : 'fill-white dark:fill-gray-700' }} dark:stroke-slate-200 ">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </button>
                </form>

                <span>{{ $post->like['postLikeCount'] }}</span>
            </div>
            <br>
        </div>
        <div class="container px-2 m-auto">
            <form action="{{ route('comments.save') }}" method="POST" class="flex">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <input type="text" id="content" name="content"
                    class="w-full bg-gray-50 border border-gray-300 text-gray-900  rounded-lg rounded-e-none focus:ring-blue-500 focus:border-blue-500 block  p-2.5 dark:text-gray-300 dark:bg-gray-600 dark:border-none"
                    placeholder="Your comment" value="{{ old('content') }}" />
                <button class="bg-blue-500 text-white px-2 py-1 rounded-e-lg">Comment</button>
            </form>
        </div>
        <br>
        <div class="container px-2 m-auto">
            <h3 class="font-bold">Comments:</h3>
            <ul>
                @forelse ($post->comments as $comment)
                    <li class="border-b-[1px] border-b-slate-300  mb-2">
                        <div class="flex justify-between">

                            <h5 class="font-semibold">{{ $comment->user->name }}</h5>
                            <span>{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <span>{{ $comment->content }}</span>
                    </li>
                @empty
                    No comments yet
                @endforelse
            </ul>
        </div>
    </div>
@endsection

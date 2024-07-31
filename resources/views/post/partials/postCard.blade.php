<div class=" p-6 dark:bg-gray-700 border dark:text-gray-300 border-gray-200 dark:border-none rounded-lg shadow relative">

    @if (Auth::user()->id == $post->user_id)
        <div class="absolute top-2 right-2 flex gap-3">

            <a href="{{ route('posts.edit', $post->id) }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>

            </a>
            <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                onsubmit="event.preventDefault();window.confirm('Delete this post?')?this.submit():false">
                @csrf
                @method('DELETE')
                <button>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                </button>

            </form>
        </div>
    @endIf
    <br>
    <div class="flex justify-between">

        <h6 class="font-bold text-sm italic mb-3 flex items-center gap-3">
            <img src="{{ $post->user->profile_img }}" class="w-16 h-16 rounded-[50%] object-cover" alt=""> <a
                href="{{ route('user.index', $post->user->id) }}">
                {{ $post->user->name === Auth::user()->name ? 'You' : Str::upper($post->user->name) }}</a>
        </h6>
        <p class="font-bold text-sm italic mb-3">{{ $post->created_at->diffForHumans() }}</p>
    </div>
    <a href="{{ route('posts.show', $post->id) }}">
        <h5 class="mb-2 text-2xl font-bold tracking-tight   Noteworthy technology">
            {{ Str::limit($post->title, 40) }}
        </h5>
    </a>


    <p class="mb-3 font-normal ">{{ Str::limit($post->disc, 200) }}</p>
    @if ($post->image)
        <div>
            <img src="{{ $post->image }}" class="object-cover" alt="image">
        </div>
    @endIf
    <div class="flex justify-between mt-3">
        <div class="flex items-center justify-center">
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

        @if ($post->comments_count)
            <p>{{ $post->comments_count }} comments</p>
        @endIf
    </div>

</div>

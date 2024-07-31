<li class="grid md:grid-cols-[2fr_1.5fr_auto] items-center gap-2 my-2">
    <span class="">{{ $apiToken->name }}</span>
    <span class="text-sm text-green-400 flex items-center gap-1">
        {{ Str::limit($apiToken->token, 10) }}

    </span>

    <form action="{{ route('tokens.destroy', $apiToken->id) }}" method="POST">
        @method('DELETE')
        @csrf

        <button type="submit"
            class=" text-white bg-red-500 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg  text-sm px-3 py-2.5 text-center">Delete</button>
    </form>
    <hr class="w-full md:hidden">
</li>

@extends('layouts.main')
@section('title', 'Posts')

@section('main')
    <div class="py-4">
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

            <div class="  mt-3 grid  justify-center gap-2 sm:grid-cols-1 ">
                @foreach ($posts as $post)
                    @include('post.partials.postCard')
                @endforeach
            </div>
            <div class=" my-3 m-auto">

                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')
@section('content')
<div class="container">

    <h1 style="font-family:Comic Sans MS"><u>Posts</u></h1>
    <hr />

    <div id="pinBoot">
        @forelse($posts as $post)
            <div class="thumbnail white-panel">
                <a href="{{ route('posts.show',['post' => $post]) }}">{{ $post->title }} </a>
                 <hr>
                 <p class="post-body">{{ $post->excerpt }}</p> 
            </div>
         @empty
         <p>Blog posts coming soon.</p>
        @endforelse
    </div>
    @if(count($posts) >= 15)
        <div style="padding:80px">
            {{ $posts->links() }}
        </div>
    @endif
</div>
@endsection
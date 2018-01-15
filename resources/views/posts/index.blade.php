@extends('layouts.app')
@section('content')
<div class="container">
         <div id="pinBoot">
           @forelse($posts as $post)
                <div class="thumbnail white-panel">
                <a href="{{ route('posts.show',['post' => $post]) }}">{{ $post->title }} </a>
                    <hr>
                     <p class="post-body">{{ $post->body }}</p> 
                </div>
            @empty
            <p>Blog posts coming soon.</p>
            @endforelse
        </div>
    <div style="padding:80px">
        {{ $posts->links() }}
    </div>
 </div>
@endsection
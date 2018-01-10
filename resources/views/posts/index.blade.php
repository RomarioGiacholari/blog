@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
         <div id="pinBoot">
           @foreach($posts as $post)
                <div class="thumbnail white-panel post-item">
                    {{ $post->title }}
                    <hr>
                    <a href="posts/{{$post->id}}"> {{ $post->body }} </a>
                </div>
            @endforeach
        </div>
    </div>
    <div style="padding:80px">
        {{ $posts->links() }}
    </div>
 </div>
@endsection
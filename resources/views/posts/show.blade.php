@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
                <div> 
                  <h1> <strong> {{ $post->title }} </strong> </h1>
                    <hr>
                    <p class="post-show-body"> {{ $post->body }} </p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
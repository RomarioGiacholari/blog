@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
                @if ($viewModel !== null && $viewModel->post !== null)
                    <h1 style="font-family:Comic Sans MS;"> <u> {{ $viewModel->post->title }} </u> </h1> 

                    {{ $viewModel->post->created_at->diffForHumans() }}
                
                    <hr>
                    <p class="post-show-body"> {{ $viewModel->post->body }} </p>
                @else
                    <p>This post does not exist or it has been removed</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
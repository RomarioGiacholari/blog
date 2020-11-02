@extends('layouts.app')
@if($viewModel != null && $viewModel->pageTitle != null)
@section('title', $viewModel->pageTitle)
@endif
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0 ">
            @if($viewModel != null && $viewModel->post !== null)
            <h3>Update post</h3>
            <hr>
            <form action="{{ route('posts.update', ['slug' => $viewModel->post->slug]) }}" method="POST">
                {{csrf_field()}}
                {{method_field('PATCH')}}

                <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{$viewModel->post->title}}" required="">
                </div>

                <div class="form-group {{ $errors->has('body') ? ' has-error' : '' }}">
                    <label for="body">Body</label>
                    <trix name="body" value="{{ $viewModel->post->body }}"></trix>
                </div>

                <div class='form-group'>
                    <button type="submit" class="btn btn-primary btn-block ">update</button>
                </div>

            </form>

            @include('errors._errors')

            @else
            <p>The post does not exist or it has been removed</p>
            @endif
        </div>
    </div>
</div>
@endsection
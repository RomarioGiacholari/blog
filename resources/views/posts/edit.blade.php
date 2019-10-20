@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0 ">
                @if($viewModel !== null && $viewModel->post !== null)
                    <h3>Update post</h3>
                    <hr>
                        <form action="{{ route('posts.update', ['post' => $viewModel->post]) }}" method="POST">
                            {{csrf_field()}}
                            {{method_field('PATCH')}}

                            <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control" name="title" id="title" value ="{{$viewModel->post->title}}" required="">
                            </div>

                            <div class="form-group {{ $errors->has('body') ? ' has-error' : '' }}">
                            <label for="body">Body:</label>
                                <textarea  class="form-control" name="body" id="body" rows="8" required="">{{$viewModel->post->body}}</textarea>
                            </div>

                            <div class ='form-group'>
                            <button type="submit" class="btn btn-primary btn-block ">Update</button>
                            </div>
                        </form>
                        
                        <!-- errors -->
                        @if(count($errors))
                            <ol class ="text-center" >
                            @foreach($errors->all() as $error)
                                <p style='color:red'>{{$error}}</p>
                            @endforeach
                            </ol>
                        @endif
                @else
                    <p>The post does not exist or it has been removed</p>
                @endif
            </div>
        </div>
    </div>
@endsection
@extends('layouts.app')
@section('title', 'New post')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-0 ">
            <h3>New post</h3>
            <hr>
            <form action="/posts" method="POST">
                {{csrf_field()}}

                <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{old('title')}}" placeholder="Title" required="">
                </div>

                <div class="form-group {{ $errors->has('body') ? ' has-error' : '' }}">
                    <label for="title">Body</label>
                    <trix name="body"></trix>
                </div>

                <div class='form-group'>
                    <button type="submit" class="btn btn-primary btn-block ">publish</button>
                </div>

            </form>

            @include('errors._errors')
        </div>
    </div>
</div>

@endsection
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
                            <input type="text" class="form-control" name="title" id="title" value ="{{old('title')}}" placeholder="Title" required="">
                        </div>
                        
                        <div class="form-group {{ $errors->has('body') ? ' has-error' : '' }}">
                            <textarea  class="form-control" name="body" id="body" rows="8" placeholder="Body" required="">{{old('body')}}</textarea>
                        </div>

                        <div class ='form-group'>
                            <button type="submit" class="btn btn-primary btn-block ">Publish</button>
                        </div>

                     </form>

                     @if(count($errors))
                        <ol class ="text-center" >
                            @foreach($errors->all() as $error)
                                <p style='color:red'>{{ $error }}</p>
                            @endforeach
                        </ol>
                     @endif
            </div>
        </div>
    </div>

@endsection
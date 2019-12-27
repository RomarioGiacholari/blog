@extends('layouts.app')
@if($viewModel != null && $viewModel->pageTitle != null)
@section('title', $viewModel->pageTitle)
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-0">
            <h3>New episode</h3>
            <hr>
            <form action="{{ route('episodes.store') }}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}

                <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{old('title')}}" placeholder="Title" required="">
                </div>

                <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" id="description" rows="8" placeholder="Description" required="">{{old('description')}}</textarea>
                </div>

                <div class="form-group {{ $errors->has('audioBase64') ? ' has-error' : '' }}">
                    <label for="audioBase64">Audio file</label>
                    <input type="file" name="audioBase64" id="audioBase64" required=""  accept=".mp3,audio/*" />
                    <p class="help-block">the audio file must be of type mp3</p>
                </div>

                <div class='form-group'>
                    <button type="submit" class="btn btn-primary btn-block ">Upload</button>
                </div>

            </form>

            @include('errors._errors')
        </div>
    </div>
</div>
@endsection
@endif
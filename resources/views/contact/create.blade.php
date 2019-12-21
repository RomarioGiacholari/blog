@extends('layouts.app')
@section('title', $viewModel->pageTitle)
@section('content')
<div class="container">
    @if($viewModel != null && $viewModel->message !== null)
    <div class="alert alert-info alert-dismissible" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ $viewModel->message }}
    </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <h1 style="font-family:Comic Sans MS"><u>Contact me</u></h1>
            <hr>
            <form action="{{ route('contact.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="Your email" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="subject" id="subject" value="{{ old('subject') }}" placeholder="Subject" required>
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="message" id="message" rows="8" placeholder="Message" required>{{ old('message') }}</textarea>
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" name="answer" id="answer" value="{{ old('answer') }}" min="0" placeholder="3 + 1 =" required>
                </div>
                <div class='form-group'>
                    <button type="submit" class="btn btn-primary btn-block ">Send</button>
                </div>
            </form>
            @include('errors._errors')
        </div>
    </div>
</div>
@endsection
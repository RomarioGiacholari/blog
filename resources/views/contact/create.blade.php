@extends('layouts.app')
@section('title', $viewModel->pageTitle)
@section('content')
<div class="container">
    @if($viewModel != null && $viewModel->message !== null)
    <div style="color:white; background-color:#0099ff;" class="alert alert-dismissible" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ $viewModel->message }}
    </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <h1>Contact me</h1>
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
                    <button type="submit" class="btn btn-primary btn-block ">send</button>
                </div>
            </form>
            @include('errors._errors')
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h4>- Social links</h4>
            <ul class="font-size-16">
                <li><a href="https://github.com/RomarioGiacholari" target="_blank">Github</a></li>
                <li><a href="https://twitter.com/giacholari" target="_blank">Twitter</a></li>
                <li><a href="https://www.instagram.com/am.giacholari/" target="_blank">Instagram</a></li>
                <li><a href="https://www.linkedin.com/in/romario-giacholari-71130b11b?trk=hp-identity-name" target="_blank">Linkedin</a></li>
            </ul>
        </div>
    </div>
</div>
@endsection
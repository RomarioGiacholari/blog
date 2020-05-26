@extends('layouts.app')
@section('title', $viewModel->pageTitle)
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Contact me</h1>
            <hr>
            <p>Feel free to ask any questions. I would also appreciate feedback about the site - if you find any bugs please let me know.</p>
            <contact-form endpoint="{{ route('contact.store') }}"></contact-form>
        </div>
    </div>
</div>
@endsection
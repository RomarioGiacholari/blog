@extends('layouts.app')
@section('title', $viewModel->pageTitle)
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Privacy policy</h1>
            <hr />
            <div id="js-privacy-policy-content-placeholder">
                @include('components._spinner')
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://assets.giacholari.com/js/blog/privacy-policy/fetchContent.js" defer></script>
@endsection
@extends('layouts.app')
@section('meta-tags')
    <meta property="og:site_name" content="Romario Giacholari">
    @if($viewModel->post !== null)
    <meta property="og:title" content="{{ $viewModel->post->title }}">
    <meta property="og:description" content=" {{ $viewModel->post->excerpt }} ">
    @endif
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ sprintf("%s?refresh=%s", url()->current(), random_int(1, 1000000)) }}">
    <meta property="og:image" content="https://assets.giacholari.com/images/gallery/me-traxila-greece.jpg">
@endsection
@if($viewModel != null && $viewModel->pageTitle != null)
@section('title', $viewModel->pageTitle)
@endif
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if($viewModel != null && $viewModel->post !== null && $viewModel->author !== null)
                <h1>{{ $viewModel->post->title }}</h1>
                <div>{{ $viewModel->post->created_at->diffForHumans() }} by {{ $viewModel->author }}</div>
                <div style="margin-top:10px;">
                    <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-show-count="false">Tweet</a>
                </div>
                <div>
                    <script src="https://platform.linkedin.com/in.js" type="text/javascript" defer>lang: en_US</script>
                    <script type="IN/Share" data-url="{{ sprintf("%s?refresh=%s", url()->current(), random_int(1, 1000000)) }}" defer></script>
                </div>
                <hr>

                <div class="post-show-body">{!! $viewModel->post->body !!}</div>
            @else
                <p>The post does not exist or it has been removed</p>
            @endif
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://platform.twitter.com/widgets.js" charset="utf-8" defer></script>
@endsection
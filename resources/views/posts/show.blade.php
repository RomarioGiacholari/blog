@extends('layouts.app')
@section('title', $viewModel->pageTitle)
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
                    <script type="IN/Share" data-url="https://www.linkedin.com" defer></script>
                </div>
                <hr>
                {!! $viewModel->post->body !!}
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
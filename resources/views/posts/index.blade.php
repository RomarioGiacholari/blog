@extends('layouts.app')
@if($viewModel != null && $viewModel->pageTitle != null)
@section('title', $viewModel->pageTitle)
@endif
@if($viewModel != null && !empty($viewModel->posts))
@section('content')
<div class="container">
    <h1>Snippets</h1>
    <hr />
    @if($viewModel->orderBy !== '')
    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <select name="orderBy" id="orderBy">
                    <option {{ $viewModel->orderBy == 'created_at|desc'  ? 'selected' : '' }} value="created_at|desc">Newest first</option>
                    <option {{ $viewModel->orderBy == 'created_at|asc'   ? 'selected' : '' }} value="created_at|asc">Newest last</option>
                    <option {{ $viewModel->orderBy == 'views|desc'       ? 'selected' : '' }} value="views|desc">Top views</option>
                    <option {{ $viewModel->orderBy == 'views|asc'        ? 'selected' : '' }} value="views|asc">Least views</option>
                </select>
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        @foreach($viewModel->posts as $post)
        <div class="col-md-12">
            <div class="caption">
                <a href="{{ route('posts.show',['slug' => $post->slug]) }}">{{ $post->title }} </a> | posted: <span>{{ $post->created_at->diffForHumans() }}</span> | views: <span>{{ $post->views }}</span>
                <p class="post-body">{!! $post->excerpt !!}</p>
            </div>
            <hr />
        </div>
        @endforeach
    </div>
    @if ($viewModel->pagination !== null)
        @include('components._pagination')
    @endif
</div>
@endsection
@section('scripts')
<script defer src="https://assets.giacholari.com/js/blog/posts/order.js"></script>
@if ($viewModel->pagination !== null)
<script defer src="https://assets.giacholari.com/js/blog/pagination/pagination.js"></script>
@endif
@endsection
@else
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <p>There is nothing here...</p>
        </div>
    </div>
</div>
@endsection
@endif
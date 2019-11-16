@extends('layouts.app')
@section('title', $viewModel->pageTitle)
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if($viewModel !== null && $viewModel->photos !== null)
            @foreach($viewModel->photos as $photo)
            <div class="col-md-4">
                <div class="thumbnail ">
                    <img src="{{ asset($photo) }}" alt="" style="width:100%l; height:250px">
                </div>
            </div>
            @endforeach
            @else
            <p>Photos coming soon ...</p>
            @endif
        </div>
    </div>
</div>
@endsection
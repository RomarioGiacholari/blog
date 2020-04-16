@extends('layouts.app')
@if($viewModel != null && $viewModel->pageTitle != null)
@section('title', $viewModel->pageTitle)
@endif
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
        <h1>Dashboard</h1>
        <hr />
            @if($viewModel != null && !empty($viewModel->resources) && count($viewModel->resources) > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Resource</th>
                            <th>Endpoint</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($viewModel->resources as $title => $endpoint)
                        <tr>
                            <td>{{ $title }}</td>
                            <td><a href=" {{ $endpoint }}" class="btn btn-xs btn-success" role="button">see more</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p>There are no resources to display. <a href="{{ route('welcome') }}">Redirect to welcome page</a></p>
            @endif
        </div>
    </div>
</div>
@endsection
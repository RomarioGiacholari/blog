@extends('layouts.app')
@if($viewModel != null && $viewModel->pageTitle != null)
@section('title', $viewModel->pageTitle)
@endif
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
        <div><a href="{{ route('episodes.create') }}"><i class="fa fa-3x fa-plus-circle" title="New episode" aria-hidden="true"></i></a></div>
        <hr />
            @if($viewModel != null && $viewModel->episodes !== null && !$viewModel->episodes->isEmpty())
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($viewModel->episodes as $episode)
                        <tr>
                            <td><a href=" {{ route('episodes.show' , ['episode' => $episode] ) }}">{{ $episode->title }}</a></td>
                            <td> {{ $episode->created_at->diffForHumans() }}</td>
                            <td> {{ $episode->updated_at->diffForHumans() }} </td>
                            <td><a href=" {{ route('episodes.edit', ['episode' => $episode] ) }} " class="btn btn-xs btn-primary" role="button">edit</a></td>
                            <td>
                                <form onsubmit="event.preventDefault(); deleteEpisode(event);" action="{{ route('episodes.destroy', ['episode' => $episode] ) }}" method="POST">

                                    {{ method_field('DELETE') }}

                                    {{ csrf_field() }}

                                    <button class="btn btn-xs btn-danger" role="button">delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p>There are no episodes to display. <a href="{{ route('welcome') }}">Redirect to welcome page</a></p>
            @endif
        </div>
    </div>
</div>
@endsection
@if($viewModel != null && $viewModel->episodes !== null)
@section('scripts')
<script defer>
    function deleteEpisode(event) {
        var message = "Do you want to remove the episode?";
        var isSuccess = confirm(message);
        var form = event.target;

        if (isSuccess) {
            form.submit();
        }
    }
</script>
@endsection
@endif
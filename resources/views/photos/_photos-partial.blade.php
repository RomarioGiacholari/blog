@if($viewModel != null && $viewModel->photos != null && count($viewModel->photos) > 0)
@foreach($viewModel->photos as $photo)
<div class="thumbnail white-panel">
    <a href="{{ route('photos.show', ['identifier' => $photo]) }}">
        @if(app()->env = 'local')
        <img src="{{ asset($photo) }}" title="{{ $photo }}" alt="{{ $photo }}">
        @else
        <img src="{{ secure_asset($photo) }}" title="{{ $photo }}" alt="{{ $photo }}">
        @endif
    </a>
</div>
@endforeach
@endif
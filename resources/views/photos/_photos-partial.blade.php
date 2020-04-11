@if($viewModel != null && $viewModel->photos != null && count($viewModel->photos) > 0)
@foreach($viewModel->photos as $photo)
<div class="thumbnail white-panel">
    <a href="{{ route('photos.show', ['identifier' => $photo]) }}">
        <img src="{{ secure_asset($photo) }}" title="{{ $photo }}" alt="{{ $photo }}">
    </a>
</div>
@endforeach
@endif
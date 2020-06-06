@if($viewModel != null && $viewModel->photos != null && count($viewModel->photos) > 0)
@foreach($viewModel->photos as $name => $path)
<div class="thumbnail white-panel">
    <img src="{{ $path }}" title="{{ $name }}" alt="{{ $name }}" width="100%">
</div>
@endforeach
@endif
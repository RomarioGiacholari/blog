@if(isset($viewModel->projects) && !empty($viewModel->projects))
    @foreach($viewModel->projects as $project)
        <div class="thumbnail projects white-panel">
            <a href="{{ $project['link'] }}">
                <img src="{{ $project['image'] }}" alt="{{ $project['name'] }}" width="100%">
            </a>
            <div class="caption">
                <p>{{ $project['name'] }}</p>
            </div>
        </div>
    @endforeach
@endif
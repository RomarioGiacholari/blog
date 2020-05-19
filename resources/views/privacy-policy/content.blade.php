@if($viewModel != null && $viewModel->introduction != null && $viewModel->content != null && count($viewModel->content) > 0)
<section id="introduction">
    <p class="font-size-16"> {{ $viewModel->introduction }} </p>
</section>
@foreach($viewModel->content as $title => $text)
<section id="{{ strtolower($title) }}">
    <h3>{{ $title }}</h3>

    @if($title == 'Contact')
    <p class="font-size-16">
        {{ $text }} <a href="mailto:{{ $viewModel->contactEmail }}">{{ $viewModel->contactEmail }}</a>.
    </p>
    @else
    <p class="font-size-16">{{ $text }}</p>
    @endif
</section>
@endforeach
@endif
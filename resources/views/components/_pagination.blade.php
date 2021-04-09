@if ($viewModel->pagination)
    <div id="pagination" data-pagination="{{json_encode($viewModel->pagination)}}">
        <button id="previous">previous</button>
        <button id="next">next</button>
    </div>
@endif
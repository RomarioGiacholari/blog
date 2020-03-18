@extends('layouts.app')
@section('title', $viewModel->pageTitle)
@section('content')
<div class="container">
    <h1>Photos</h1>
    <hr />
    <div id="pinBoot" data-identifier="js-photos-partial">
        
    </div>
</div>
@endsection
@section('scripts')
<script defer>
    document.addEventListener("DOMContentLoaded", function() {
        var targetElement = document.getElementById('pinBoot');

        fetch('/all-photos/partial')
            .then(function (response) { 
                return response.text(); 
            })
            .then(function (html) {
                 targetElement.innerHTML = html; 
            })
            .catch (function (error) {
                console.log(error);
            });
    });
</script>
@endsection
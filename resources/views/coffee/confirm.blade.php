@extends('layouts.app')
@if($viewModel != null && $viewModel->pageTitle != null)
@section('title', $viewModel->pageTitle)
@endif
@if($viewModel != null && $viewModel->friendlyAmount != null && $viewModel->friendlyAmount > 0 && $viewModel->sessionId !== null && $viewModel->stripePublicKey !== null)
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Confirm payment of (£{{ $viewModel->friendlyAmount }})</h1>
            <hr>
            <p>Next, you will be redirected to the payment provider and they are going to handle the transaction.</p>
            <button id="proceedButton" class="btn btn-success btn-block">proceed</button>
            <a href="{{ route('coffee.index') }}" class="btn btn-default btn-block" role="button">cancel</a>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script defer src="https://js.stripe.com/v3/"></script>
<script defer>
    document.addEventListener("DOMContentLoaded", function () {
        var proceedButton = document.getElementById('proceedButton');
        if (proceedButton) {
            proceedButton.addEventListener('click', function () {
                var stripe = Stripe('{{ $viewModel->stripePublicKey }}');
                stripe.redirectToCheckout({sessionId:'{{ $viewModel->sessionId }}'}).then(function (result) {});
            });
        }
    });
</script>
@endsection
@endif
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
            <p>Next, you will be redirected to <a href="https://stripe.com/"><u>Stripe and they are going to handle the payment.</u></a></p>
            <button id="paymentButton" class="btn btn-success btn-block">pay</button>
            <a href="{{ route('coffee.index') }}" class="btn btn-default btn-block" role="button">cancel</a>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script defer src="https://js.stripe.com/v3/"></script>
<script defer>
    document.addEventListener("DOMContentLoaded", function () {
        var paymentButton = document.getElementById('paymentButton');
        var stripeHandler = function () {
            var stripe = Stripe('{{ $viewModel->stripePublicKey }}');
            stripe.redirectToCheckout({sessionId:'{{ $viewModel->sessionId }}'}).then(function (result) {});
        };

        paymentButton.addEventListener('click', stripeHandler);
    });
</script>
@endsection
@endif
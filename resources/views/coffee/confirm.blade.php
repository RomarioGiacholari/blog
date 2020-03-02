@extends('layouts.app')
@if($viewModel != null && $viewModel->pageTitle != null)
@section('title', $viewModel->pageTitle)
@endif
@if($viewModel != null && $viewModel->sessionId !== null && $viewModel->stripePublicKey !== null)
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Confirm payment</h1>
            <hr>
            <p>Next, you will be redirected to Stripe and they are going to handle the payment.</p>
            <button class="btn btn-success btn-block" onclick="pay()">pay</button>
            <a href="{{ route('coffee.index') }}" class="btn btn-default btn-block" role="button">cancel</a>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://js.stripe.com/v3/" defer></script>
<script defer>
    function pay() {
        var stripe = Stripe('{{ $viewModel->stripePublicKey }}');
        stripe.redirectToCheckout({sessionId:'{{ $viewModel->sessionId }}'}).then(function (result) {});
    }   
</script>
@endsection
@endif
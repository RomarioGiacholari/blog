@extends('layouts.app')
@section('title', $viewModel->pageTitle)
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Buy me a cup of coffee (finding a reason to test the Stripe API)</h1>
            <hr>
            <p>
                Select an amount to pay. 
                No charges will be incurred at this point. 
                Once you confirm the amount, you then have the option to cancel or continue with the payment.
            </p>
            <form action="{{ route('coffee.store') }}" method="POST">

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="amount">Amount in (£) <span id="currentAmount"></span></label>
                    <input class="form-control" type="number" name="amount" id="amount" value="{{ old('amount') }}" min="1" required>
                </div>
                
                <div class='form-group'>
                    <button type="submit" class="btn btn-primary btn-block">confirm amount</button>
                </div>

            </form>
            @include('errors._errors')
        </div>
    </div>
</div>
@endsection
@section('scripts')
@if(app()->env == 'local')
<script src="{{ asset('js/coffee/updateAmount.js') }}" defer></script>
@else
<script src="{{ secure_asset('js/coffee/updateAmount.js') }}" defer></script>
@endif
@endsection
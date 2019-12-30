@extends('layouts.app')
@section('title', $viewModel->pageTitle)
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 style="font-family:Comic Sans MS"><u>Buy me a cup of coffee (really testing the Stripe API)</u></h1>
            <hr>
            <form action="{{ route('coffee.store') }}" method="POST">

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="amount">Amount in (£) pounds</label>
                    <input type="number" class="form-control" name="amount" id="amount" value="{{ old('amount') }}" min="0" placeholder="amount in (£) pounds" required>
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
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                    @forelse($photos as $photo)
                    <div class="col-md-4">
                        <div class="thumbnail">
                            <img src="{{ asset($photo) }}" alt="" style="width:100%">
                        </div>
                    </div>
                    @empty
                        <p>Photos coming soon ..</p>
                    @endforelse
            </div>
        </div>
    </div>
@endsection
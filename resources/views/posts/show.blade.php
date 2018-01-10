@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
                <div> 
                  <h1> {{ $post->title }} </h1>
                    <p> {{ $post->body }} </p>
                </div>
            </a>
        </div>
    </div>
 </div>
@endsection
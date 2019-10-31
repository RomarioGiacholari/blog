@if($errors->any())
    <ol class="text-center">
        @foreach($errors->all() as $error)
            <p style='color:red'>{{$error}}</p>
        @endforeach
    </ol>
@endif
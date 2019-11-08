@if($errors->any())
<ol class="text-center">
    @foreach($errors->all() as $error)
    <div style='color:red; font-style: italic'>{{ $error }}</div>
    @endforeach
</ol>
@endif
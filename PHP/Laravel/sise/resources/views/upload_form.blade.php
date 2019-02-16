{{-- {{ dd($errors) }} --}}
{{-- {{ dd($errors->first('name')) }} --}}
@if (count($errors) > 0)
<ul>
    {{-- {{ $errors->first('name') }} --}}
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>
@endif

<form action="/upload" enctype="multipart/form-data" method="post">
    {{ csrf_field() }} Product name: <br>
    <input name="name" type="text">
    <br><br> Product photos (can attach more than one): <br>
    <input multiple="multiple" name="photos[]" type="file">
    {{-- <input multiple="multiple" name="photo" type="file"> --}}
    <br><br>
    <input type="submit" value="Upload">
</form>
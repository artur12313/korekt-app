@extends('layouts.app')

@section('content')
<script>
    var author_id = {!! auth()->user()->id !!};
    var order = false;
    var clients = {!! json_encode($klienci->toArray()) !!};
</script>
<div class="container">
    <div id="zamowienie"></div>
</div>
@endsection
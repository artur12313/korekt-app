@extends('layouts.app')

@section('content')
<script>    
    var order = {!! json_encode($zamowienia->toArray()) !!};
    var clients = {!! json_encode($klienci->toArray()) !!};
</script>
<div class="container">
    <div id="zamowienie"></div>
</div>
@endsection
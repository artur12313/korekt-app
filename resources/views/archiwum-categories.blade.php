@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <h1>Lista kategorii(archiwum)</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif
    <table class="table table-striped table-bordered" id="table">
        <thead class="thead-dark">
            <tr>
            <th scope="col">#</th>
            <th scope="col">Nazwa</th>
            <th scope="col" class="text-center">Narzędzia</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $cat)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$cat->name}}</td>
                <td class="d-flex justify-content-center">
                    <a href="{{url("/kategorie-archiwum/$cat->id")}}" class="btn btn-secondary btn-sm">Pokaż</a>
                    <form>
                    </form>
                    {!! Form::open(['action' => ['CategoryController@forceDelete', $cat->id], 'method' => 'DELETE', 'class' => 'd-inline-block']) !!}
                    {{Form::submit('Usuń', ['class' => 'btn btn-danger btn-sm ml-2'])}}
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>   
@endsection

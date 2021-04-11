@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if ($message = Session::get('success'))

                <div class="alert alert-success alert-block">

                    <button type="button" class="close" data-dismiss="alert">×</button>

                    <strong>{{ $message }}</strong>

                </div>

            @endif

            
        </div>
        <h3><span class="label label-default rank-label">Profil użytkownika: {{$user->name}}</span></h3>
            <div class="row justify-content-center">
            <div class="profile-header-container">
                <br><br><br>
                <div class="profile-header-img">
                    <img class="rounded-circle" src="{{ URL::to("/images/avatars/$user->avatar") }}" width="140px" height="140px"/>
                    <!-- badge -->
                    <br><br><br>
                    <div class="rank-label-container">
                    </div>
                </div>
            </div>

        </div>
        <div class="row justify-content-center">
            {!! Form::open(['action' => 'ProfilController@profile', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                @csrf
                <div class="form-group">
                    <input type="file" class="form-control-file" name="avatar" id="avatarFile" aria-describedby="fileHelp">
                    <small id="fileHelp" class="form-text text-muted">Prześlij prawidłowy plik obrazu. Rozmiar obrazu nie powinien przekraczać 2 MB.</small>
                </div>
                {{Form::submit('Wyślij', ['class'=>'btn btn-primary'])}}
                {!! Form::close() !!}
        </div><br><br>
        @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Ups!</strong> Wystąpił problem z wysyłaniem.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
    </div>
@endsection
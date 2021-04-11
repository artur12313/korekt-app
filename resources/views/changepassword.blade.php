@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="row">
        <div class="col col-md-6 offset-md-3">
                    <h1>Zmiana hasła</h1>
 
                <div class="panel-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        {!! Form::open(['action' => 'ProfilController@changePassword', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
                        {{ csrf_field() }}
 
                        <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                            <label for="new-password" class="col-md-4 control-label">Hasło:</label>
 
                            <div class="col-md-8">
                                <input id="current-password" type="password" class="form-control" name="current-password" required>
 
                                @if ($errors->has('current-password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('current-password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
 
                        <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                            <label for="new-password" class="col-md-4 control-label">Nowe hasło</label>
 
                            <div class="col-md-8">
                                <input id="new-password" type="password" class="form-control" name="new-password" required>
 
                                @if ($errors->has('new-password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('new-password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
 
                        <div class="form-group">
                            <label for="new-password-confirm" class="col-md-4 control-label">Potwierdź nowe hasło</label>
 
                            <div class="col-md-8">
                                <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                            </div>
                        </div>
 
                        <div class="form-group">
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">
                                    Zapisz zmiany
                                </button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                </div>
        </div>
    </div>
</div>
@endsection
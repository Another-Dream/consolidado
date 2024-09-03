@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Creando Usuario Nuevo')

@section('content')
<div class="row">
  @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($error->all() as $error )
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
  @endif
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Creando un Usuario Nuevo</h5> 
            </div>
            <div class="card-body">
              <form method="POST" action="{{ route('pages-users-update') }}">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Nombre Completo</label>
                  <input type="text" name="name" value="{{ $user->name }}" class="form-control" id="basic-default-fullname" placeholder="Ingresa un Nombre" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-company">Email</label>
                    <input type="text" name="email" value="{{ $user->email }}" class="form-control" id="basic-default-company" placeholder="Correo@correo.com" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-company">Password Nuevo</label>
                    <input type="password" name="new_password" class="form-control" id="basic-default-company" placeholder="Contraseña" />
                  </div>
                
                <button type="submit" class="btn btn-primary">Send</button>
              </form>
            </div>
          </div>
    </div>
</div>
@endsection

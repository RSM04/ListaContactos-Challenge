@extends('layouts.app')
@section('content')
    <h1 class="h1-responsive">Lista de contactos</h1>
    <hr>
    <button type="button" class="btn btn-primary " id="añadir">Añadir Contacto</button>
    <a href="{{route('excel')}}" class="btn btn-success" id="excel">Exportar contactos a excel</a>
    <div class="col-md-10" id="tabladecontactos"></div>
    <div id="dialog-confirm" title="Eliminar contacto">
    </div>
    <div id="dialog-edit" title="Editar contacto">
    </div>
    <div id="dialog-add" title="Añadir contacto">
    </div>
    <span id="success_message"></span>
@endsection


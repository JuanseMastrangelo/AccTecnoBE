@extends('layouts.app')

@section('content')
<div class="container">
    <div class="position-absolute col-12 p-0" style="height: 200px;top:0;left:0;background: rgba(36, 34, 89,.8)"></div>
    <table-component :data="{{ $users }}" :title="'Transacciones'"
    :columns="[{ label: 'ID Producto', field: 'idProduct', }, { label: 'Descripción', field: 'descripcion', }, { label: 'Realizado', field: 'created_at', }, { label: 'Estado', field: 'status', }]"
    ></table-component>
</div>
@endsection

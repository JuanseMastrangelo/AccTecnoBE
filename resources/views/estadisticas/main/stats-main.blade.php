@extends('layouts.app')

@section('content')
<div class="container">
    <div class="position-absolute col-12 p-0" style="height: 200px;top:0;left:0;background: rgba(36, 34, 89,.8)"></div>
    <estadisticas-main-component transacciones-route="{{ route('getAllCompras') }}"></estadisticas-main-component>
</div>
@endsection


@extends('layouts.app')

@section('content')
<div class="container">
    <estadisticas-main-component transacciones-route="{{ route('getAllCompras') }}"></estadisticas-main-component>
</div>
@endsection


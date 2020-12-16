@extends('layouts.app')

@section('content')
<div>
    <estadisticas-main-component transacciones-route="{{ route('getAllCompras') }}"></estadisticas-main-component>
</div>
@endsection


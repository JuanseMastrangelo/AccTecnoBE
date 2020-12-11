@extends('layouts.app')

@section('content')
<div class="container">
    <compras-table-component :data="{{ $users }}"></compras-table-component>
</div>
@endsection

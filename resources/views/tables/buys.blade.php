@extends('layouts.app')

@section('content')
<div>
    <compras-table-component :data="{{ $users }}"></compras-table-component>
</div>
@endsection

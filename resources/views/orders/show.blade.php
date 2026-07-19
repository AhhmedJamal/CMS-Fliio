@extends('layouts.admin')
@section('content')
    @foreach ($order->items as $item)
        <h1>{{ $item->product->name }}</h1>
    @endforeach
@endsection

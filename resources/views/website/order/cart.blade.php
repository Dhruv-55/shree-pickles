@extends('website.template.layout')

@section('content')
<livewire:website.order.cart :cart="$cart"/>
@endsection
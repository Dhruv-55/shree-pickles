@extends('website.template.layout')
@section('content')
<livewire:website.product.detail :product="$product" :related_products="$related_products"/>
@stop
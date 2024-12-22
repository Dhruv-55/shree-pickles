@extends('website.template.layout')
@section('content')
<livewire:website.product.index :products="$products" :categories="$categories" :brands="$brands" :categorySlug="$categorySlug"/>
@stop
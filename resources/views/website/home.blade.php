@extends('website.template.layout')

@section('content')
<livewire:website.home :categories="$categories" :products="$products" :latest_products="$latest_products" :trending_products="$trending_products" :best_seller="$best_seller" :new_arrivals="$new_arrivals" :sliders="$sliders" >
@stop

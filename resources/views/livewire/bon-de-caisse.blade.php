@extends('layouts.page-table', ['title'=>'Liste des bons de caisse'])
@section('create-button')
    @can('Créer bons de caisse')
        <button wire:click="$dispatch('openModal', {component: '{{$create_modal}}'})" class="btn btn-primary mb-4"> {{$button_title}}</button>
    @endcan
@endsection
@section('table')
    @include('partials.bon-table')
@endsection
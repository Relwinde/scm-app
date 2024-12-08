@extends('layouts.page-table', ['title'=>'Liste des véhicules'])
@section('create-button')
        <button wire:click="$dispatch('openModal', {component: '{{$create_modal}}'})" class="btn btn-primary mb-4"> {{$button_title}}</button>
@endsection
@section('table')
    @include('partials.outils.vehicules-table')
@endsection

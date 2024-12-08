@extends('layouts.page-table', ['title'=>'Liste des profiles'])
@section('create-button')
    @can('Créer profile')
        <button wire:click="$dispatch('openModal', {component: '{{$create_modal}}'})" class="btn btn-primary mb-4"> {{$button_title}}</button>
    @endcan  
@endsection
@section('table')
    @include('partials.outils.profiles-table')
@endsection

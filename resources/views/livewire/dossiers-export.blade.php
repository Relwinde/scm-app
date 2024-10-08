@extends('layouts.page-table', ['title'=>'Liste des dossier'])
@section('create-button')
    @can('Créer dossier')
    <button wire:click="$dispatch('openModal', {component: '{{$create_modal}}'})" class="btn btn-primary mb-4"> {{$button_title}}</button>
    @endcan
@endsection
@section('table')
    @include('partials.dossier-table')
@endsection

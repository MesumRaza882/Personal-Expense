@extends('layouts.app')

@push('style')
    <style>
        .nav-tabs .nav-link.active {
            color: #000000 !important;
        }
    </style>
@endpush

@section('content')
    <livewire:category.category-form />
@endsection


@extends('layouts.app')

@section('content')
    <livewire:category.category-edit :categoryId="$category->id" />
@endsection

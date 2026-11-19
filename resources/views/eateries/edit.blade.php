@extends('layouts.app')

@section('title', 'Edit ' . $eatery->name)

@section('content')
<div class="mx-auto max-w-3xl">
    <h1 class="mb-6 text-3xl font-bold">Edit {{ $eatery->name }}</h1>

    <form method="POST" action="{{ route('eateries.update', $eatery) }}"
        class="rounded-xl bg-white p-6 shadow">
        @csrf
        @method('PUT')
        @include('eateries._form')
    </form>
</div>
@endsection
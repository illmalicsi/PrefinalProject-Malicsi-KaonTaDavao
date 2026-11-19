@extends('layouts.app')

@section('title', 'Add Eatery')

@section('content')
<div class="mx-auto max-w-3xl">
    <h1 class="mb-2 text-3xl font-bold">Add an Eatery</h1>
    <p class="mb-6 text-gray-600">Share another local food spot with the community.</p>

    <form method="POST" action="{{ route('eateries.store') }}"
        class="rounded-xl bg-white p-6 shadow">
        @csrf
        @include('eateries._form')
    </form>
</div>
@endsection
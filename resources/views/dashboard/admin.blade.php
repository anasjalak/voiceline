<x-app-layout>
    <x-slot name="header">
        <h2>Dashbaord {{ ucwords(auth()->user()->role) }}</h2>
    </x-slot>
    <div class="p-6">
        welcomr {{ auth()->user()->name }}!
        my Dashbaord {{ auth()->user()->role }}.
    </div>
</x-app-layout>
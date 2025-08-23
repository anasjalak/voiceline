<x-app-layout>
    <x-slot name="header">
        <h2>Dashbaord {{ ucwords(auth()->user()->role) }}</h2>
    </x-slot>
    <div class="p-6">
        welcome {{ auth()->user()->name }}!
         Mr. {{ auth()->user()->role }}.
    </div>
</x-app-layout>
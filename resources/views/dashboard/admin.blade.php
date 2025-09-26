
@extends('layouts.app')
  
@section('title', 'Home Page')
 
@section('content')
  <div class="choices">
        
<a class="choice" href="{{ route('calls.create') }}">
        <span>Reports</span>
    </a>
    <!-- Optional additional nav items -->
    <a class="choice" href="{{ url('reports/calls-per-user') }}">
        <span>Reports</span>
    </a>
    <a class="choice" href="{{ route('student') }}">
        <span>Direct</span>
    </a>
    
</div>

@endsection

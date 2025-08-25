
@extends('layouts.app')
  
@section('title', 'Home Page')
 
@section('content')
  <div class="choices">
    <!-- Start a call with dropdown -->
    <div class="dropdownchoices">
        <a class="choice" href="javascript:void(0);">
            <span>Start a call</span>
        </a>
         
         
    </div>

    <!-- Optional additional nav items -->
    <a class="choice" href="{{ url('reports') }}">
        <span>Reports</span>
    </a>
    <a class="choice" href="{{ route('student') }}">
        <span>Direct</span>
    </a>
</div>

@endsection

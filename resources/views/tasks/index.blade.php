@extends('layouts.app')

@section('content')

    @if (isset($tasks))
        
                @foreach ($tasks as $task)
               
                @endforeach
           
    @endif
   
@endsection
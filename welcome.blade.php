@extends('layouts.guest')
@section('content')<h1>Tasks for Today</h1><p>A simple task management system built with Laravel.</p><p><a class="button" href="{{ route('tasks.index') }}">View task list</a> <a href="{{ route('about') }}">About</a> <a href="{{ route('profile') }}">Profile</a></p>@endsection

@extends('layouts.app')
@section('content')<h1>Edit task</h1><form method="POST" action="{{ route('tasks.update', $task) }}">@csrf @method('PUT')@include('tasks.form')<button>Save changes</button></form>@endsection

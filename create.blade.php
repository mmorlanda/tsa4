@extends('layouts.app')
@section('content')<h1>Create task</h1><form method="POST" action="{{ route('tasks.store') }}">@csrf@include('tasks.form')<button>Save task</button></form>@endsection

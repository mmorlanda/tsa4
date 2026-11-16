<!doctype html>
<html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>{{ config('app.name', 'Tasks for Today') }}</title>@vite('resources/css/app.css')</head><body>
<nav class="nav"><a href="{{ route('welcome') }}">Home</a><a href="{{ route('tasks.index') }}">Tasks</a><a href="{{ route('about') }}">About</a><span class="grow"></span>@auth<span>{{ auth()->user()->name }}</span><form method="POST" action="{{ route('logout') }}">@csrf<button class="link-button">Log out</button></form>@else<a href="{{ route('login') }}">Log in</a>@endauth</nav>
<main class="container">@if(session('status'))<div class="alert">{{ session('status') }}</div>@endif @if($errors->any())<div class="errors"><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif @yield('content')</main>
</body></html>

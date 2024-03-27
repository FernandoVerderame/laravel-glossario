@extends('layouts.app')

@section('title', 'Word Edit')

@section('content')
<header>
    <h1 class="my-2">Edit word</h1>
</header> 

<hr>

@include('includes.words.form')
@endsection
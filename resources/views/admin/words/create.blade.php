@extends('layouts.app')

@section('title', 'Word Edit')

@section('content')
<header>
    <h1 class="my-2">Create term</h1>
</header> 

<hr>

@include('includes.words.form')
@endsection
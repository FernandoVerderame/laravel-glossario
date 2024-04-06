@extends('layouts.app')
@section('content')

@foreach ($words as $word)
<div>
    {{$word->term}}
</div>
@endforeach
@endsection
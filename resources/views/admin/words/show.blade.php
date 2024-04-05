@extends('layouts.app')

@section('title', $word->term)

@section('content')
<div class="card mt-5">

  <!-- Card header -->
  <div class="card-header bg-white">
    <h4 class="card-title">{{$word->term}}</h4>
    <h6 class="card-subtitle mb-2 text-body-secondary">{{$word->technology}}</h6>
  </div>

  <!-- Card body -->
  <div class="card-body">
    <p class="card-text">{{$word->definition}}</p>
    @if(Auth::user())
    <div>
      <div><strong>Data Creazione:</strong> {{$word->getFormattedDate('created_at')}}</div>
      <div><strong>Ultima Modifca:</strong> {{$word->getFormattedDate('updated_at')}}</div>
      <div class="card-text"><strong>Pubblicato:</strong>
        @if($word->is_published) <i class="fa-solid fa-circle-check text-success"></i>
        @else <i class="fa-solid fa-circle-xmark text-danger"></i> 
        @endif
      </div>
      <div><strong>Link</strong>Link</div>
      <div><strong>Tag</strong> Tag 1, Tag 2, Tag 3</div>
    </div>
  </div>

  <!-- Card footer -->
  <div class="card-footer bg-white d-flex justify-content-between">
    <a href="{{route('admin.words.index')}}" class="btn btn-primary">Torna Indietro</a>
    <div class="d-flex gap-1">
      <a href="{{ route('admin.words.edit', $word->id) }}" class="btn btn-warning"><i class="fa-solid fa-pencil me-1"></i>Modifica</a>
      <form action="{{ route('admin.words.destroy', $word->id) }}" method="POST" class="delete-form" data-bs-toggle="modal" data-bs-target="#modal" data-word="{{ $word->term }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger"><i class="fa-regular fa-trash-can me-1"></i>Elimina</button>
      </form>
    </div>
  </div>
</div>
@endif
@endsection
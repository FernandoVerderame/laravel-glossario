@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container mt-5">
    <div class="row">
        @foreach ($words as $word)
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div id="left-header-card">
                        <h5 class="card-title">{{$word->term}}</h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary">{{$word->technology}}</h6>
                    </div>
                        <div id="right-header-card" class="d-flex justify-content-end gap-2">
                        @auth   
                            {{-- Word show button --}}
                            <a href="{{ route('admin.words.show', $word->id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-eye me-1"></i>
                                Vedi nel dettaglio
                            </a>

                            {{-- Word edit button --}}
                            <a href="{{ route('admin.words.edit', $word->id) }}" class="btn btn-sm btn-warning"><i
                                    class="fa-solid fa-pencil me-1"></i>
                                   Modifica
                                </a>

                            {{-- Word delete button --}}
                            <form action="{{ route('admin.words.destroy', $word->id) }}" method="POST" class="delete-form"
                                data-bs-toggle="modal" data-bs-target="#modal" data-word="{{ $word->term }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i
                                        class="fa-regular fa-trash-can me-1"></i>
                                    Elimina
                                </button>
                            </form>
                            @else
                            {{-- Word show button --}}
                            <a href="{{ route('admin.words.show', $word->id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-eye me-1"></i>
                                Vedi nel dettaglo
                            </a>
                            @endauth
                        </div>
                </div>
                <div class="card-body">
                    <p class="card-text">{{$word->definition}}</p>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <div id="left-footer">
                        <p class="card-text"><small class="text-muted">Technology: {{$word->technology}}</small></p>
                    </div>
                    <div id="right-footer">
                            <strong>Data Creazione:</strong> {{$word->getFormattedDate('created_at')}}<br/>
                            <strong>Ultima Modifca:</strong> {{$word->getFormattedDate('updated_at')}}
                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

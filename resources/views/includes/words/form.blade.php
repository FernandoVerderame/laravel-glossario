@if($word->exists)
<form action="{{ route('admin.words.update', $word)}}" method="POST" enctype="multipart/form-data" novalidate>
    @method('PUT')
    
    @else
    <form action="{{ route('admin.words.store')}}" method="POST" enctype="multipart/form-data" novalidate>
    
@endif

    @csrf
    
    <div class="row">
        <div class="col-12">
            <div class="mb-3">
                <label for="term" class="form-label">Termine</label>
                <input type="text" name="term" class="form-control @error('term') is-invalid @elseif(old('term', '')) is-valid @enderror" id="term" placeholder="Termine..." value="{{old('term', $word->term)}}" required>
                {{-- @error('term')
                <div class="invalid-feedback">
                    {{ $message}}
                </div>
                @enderror --}}
              </div>
        </div>
        {{-- <div class="col-6">
            <div class="mb-3">
                <label for="tag_id" class="form-label">Seleziona Tecnologia </label>
                <select name="tag_id" id="tag_id" class="form-select @error('tag_id') is-invalid @elseif(old('tag_id', '')) is-valid @enderror">
                    <option value="">Nessuna</option>
                    @foreach ( $tags as $tag )
                        <option value="{{ $tag->id }}" @if(old('tag_id', $word->tag?->id) == $tag->id) selected  @endif> {{ $tag->label }}</option>
                    @endforeach
                </select>
            </div>
        </div> --}}
        <div class="col-12">
            <div class="mb-3">
                <label for="definition" class="form-label">Definizione del termine</label>
                <textarea name="definition" class="form-control @error('definition') is-invalid @elseif(old('definition', '')) is-valid @enderror" id="definition" rows="10" required>
                    {{old('definition', $word->definition)}}
                </textarea>
                {{-- @error('definition')
                <div class="invalid-feedback">
                    {{ $message}}
                </div>
                @enderror --}}
              </div>
        </div>
        <div class="col-12 d-flex justify-content-end">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="is_published" name="is_published" @if(old('is_published', $word->is_published)) checked @endif>
                <label class="form-check-label" for="is_published">
                  Pubblicato
                </label>
              </div>
              
        </div>
    </div>
    <hr>
    
    <div class="d-flex align-items-start justify-content-between">
        <div class="w-50">
            <button class="btn btn-primary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                Aggiungi Link
            </button>
            <div class="collapse" id="collapseExample">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="term" class="form-label h5">SRC</label>
                            <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                        </div>

                        <div>
                            <button class="btn btn-sm btn-primary" type="button">
                                <i class="fa-solid fa-plus"></i>  
                            </button>
                        </div>
                    </div> 
                </div>                                  
            </div>
        </div>
        
        <div class="d-flex gap-2 align-items-start">
            <a href="{{ route('admin.words.index')}}" class="btn btn-primary">Torna al glossario</a>
            <button type="reset" class="btn btn-secondary"><i class="fas fa-eraser me-2"></i>Svuota i campi</button>
            <button type="submit" class="btn btn-success"><i class="fas fa-floppy-disk me-2"></i> Salva</button>
        </div>
    </div>
    
    </form>
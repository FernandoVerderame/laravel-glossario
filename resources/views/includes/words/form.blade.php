@if ($word->exists)
    <form action="{{ route('admin.words.update', $word) }}" method="POST" enctype="multipart/form-data" novalidate>
        @method('PUT')
    @else
        <form action="{{ route('admin.words.store') }}" method="POST" enctype="multipart/form-data" novalidate>
@endif

@csrf

<div class="row ">
    <div class="col-12">
        <div class="mb-3">
            <label for="term" class="form-label">Termine</label>
            <input type="text" name="term"
                class="form-control @error('term') is-invalid @elseif(old('term', '')) is-valid @enderror"
                id="term" placeholder="Termine..." value="{{ old('term', $word->term) }}" required>
        </div>
    </div>
    <div class="col-12">
        <div class="mb-3">
            <label for="definition" class="form-label">Definizione del termine</label>
            <textarea name="definition"
                class="form-control @error('definition') is-invalid @elseif(old('definition', '')) is-valid @enderror"
                id="definition" rows="10" required>
                    {{ old('definition', $word->definition) }}
                </textarea>
        </div>
    </div>

    <div class="col-10">
        @foreach ($tags as $tag)
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="tags[]" id="{{ "tag-$tag->id" }}"
                    value="{{ $tag->id }}" @if (in_array($tag->id, old('tags', $prev_tags ?? []))) checked @endif>
                <label class="form-check-label" for="{{ "tag-$tag->id" }}"> {{ $tag->label }}</label>
            </div>
        @endforeach
    </div>
    <div class="col-2 d-flex justify-content-between">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="is_published" name="is_published"
                @if (old('is_published', $word->is_published)) checked @endif>
            <label class="form-check-label" for="is_published">
                Pubblicato
            </label>
        </div>
    </div>
    
    {{-- Modificare grafica --}}
    <div class="d-flex align-items-start justify-content-between my-4">
        <div class="w-50">
            <a class="btn btn-primary mb-3" role="button" data-bs-toggle="collapse" href="#collapseLink" aria-expanded="false" aria-controls="collapseLink">
                Aggiungi Link
            </a>
            <div class="row">
                <div class="col-12">
                    
                    <div class="collapse" id="collapseLink">
                        <div class="mb-3">
                            <label for="term" class="form-label h5">SRC</label>
                            <input type="url" class="form-control" placeholder="Ex.: https://laravel.com/" name="links[0][src]" value="{{ old('links.0.src', '') }}">
                        </div>
                        
                        <div>
                            <a class="btn btn-primary mb-3" role="button" data-bs-toggle="collapse" href="#collapseLink2" aria-expanded="false" aria-controls="collapseLink">
                                <i class="fas fa-plus"></i>
                            </a>                
                        </div>
                    </div>
                    
                    <div class="collapse" id="collapseLink2">
                        <div class="mb-3">
                            <label for="term" class="form-label h5">SRC</label>
                            <input type="url" class="form-control" placeholder="Ex.: https://bootstrap.com/" name="links[1][src]" value="{{ old('links.1.src', '') }}">
                        </div>
                        
                        <div>
                            <a class="btn btn-primary mb-3" role="button" data-bs-toggle="collapse" href="#collapseLink3" aria-expanded="false" aria-controls="collapseLink">
                                <i class="fas fa-plus"></i>
                            </a>                
                        </div>
                    </div> 

                    <div class="collapse" id="collapseLink3">
                        <div class="mb-3">
                            <label for="term" class="form-label h5">SRC</label>
                            <input type="url" class="form-control" placeholder="Ex.: https://fontawesome.com/" name="links[2][src]" value="{{ old('links.2.src', '') }}">
                        </div>                        
                    </div> 

                </div>
            </div>                                      
        </div>
    </div>
    <hr>
    <div class="d-flex justify-content-end align-items-center gap-2">
        <a href="{{ route('admin.words.index') }}" class="btn btn-primary"><i class="fa-solid fa-arrow-left me-2"></i>Torna al glossario</a>
        <button type="reset" class="btn btn-secondary"><i class="fas fa-eraser me-2"></i>Svuota i campi</button>
        <button type="submit" class="btn btn-success"><i class="fas fa-floppy-disk me-2"></i> Salva</button>
    </div>
</div>

</form>

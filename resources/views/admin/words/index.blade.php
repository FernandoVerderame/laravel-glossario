@extends('layouts.app')

@section('title', 'Words')

@section('content')

    {{-- Header --}}
    <header class="d-flex align-items-center justify-content-between pb-4 mb-4 mt-3 border-bottom">
        <h1>Words</h1>
    </header>

    {{-- Words table --}}
    <table class="table table-hover table-secondary table-striped border mb-4">

        {{-- Words table head --}}
        <thead class="table-dark">
            <tr class="align-middle">
                <th scope="col">#</th>
                <th scope="col">Term</th>
                <th scope="col">Slug</th>
                <th scope="col">Technology</th>
                <th scope="col">Status</th>
                <th scope="col">Link</th>
                <th scope="col">Tags</th>
                <th scope="col">Created</th>
                <th scope="col">Updated</th>
                <th>
                    <div class="d-flex justify-content-end gap-2">

                        {{-- Trash button --}}
                        <a href="{{ route('admin.words.trash') }}" class="btn btn-sm btn-secondary"><i
                                class="fa-solid fa-trash me-2"></i>Show trash</a>

                        {{-- Create new word button --}}
                        <a href="{{ route('admin.words.create') }}" class="btn btn-sm btn-success"><i
                                class="fa-solid fa-plus me-2"></i>New Word</a>
                    </div>
                </th>
            </tr>
        </thead>

        {{-- Words table body --}}
        <tbody>

            @forelse($words as $word)
                <tr class="align-middle">
                    <th scope="row">{{ $word->id }}</th>
                    <td>{{ $word->term }}</td>
                    <td>{{ $word->slug }}</td>
                    <td>{{ $word->technology }}</td>
                    <td>
                        <div class="card-text">
                            @if ($word->is_published)
                                <i class="fa-solid fa-circle-check text-success"></i>
                            @else
                                <i class="fa-solid fa-circle-xmark text-danger"></i>
                            @endif
                        </div>
                    </td>
                    <td>
                        @forelse ($links as $link)
                            <p>{{$link->src}}</p>
                        @empty
                            <p>no</p>
                        @endforelse
                    </td>
                    <td>
                        @forelse ($word->tags as $tag)
                            <span class="badge text-bg-{{ $tag->color }}">{{ $tag->label }}</span>
                        @empty
                            Nessuno
                        @endforelse
                    </td>
                    <td>{{ $word->getFormattedDate('created_at') }}</td>
                    <td>{{ $word->getFormattedDate('updated_at') }}</td>
                    <td>
                        <div class="d-flex justify-content-end gap-2">

                            {{-- Word show button --}}
                            <a href="{{ route('admin.words.show', $word->id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-eye"></i>
                            </a>

                            {{-- Word edit button --}}
                            <a href="{{ route('admin.words.edit', $word->id) }}" class="btn btn-sm btn-warning"><i
                                    class="fa-solid fa-pencil"></i></a>

                            {{-- Word delete button --}}
                            <form action="{{ route('admin.words.destroy', $word->id) }}" method="POST" class="delete-form"
                                data-bs-toggle="modal" data-bs-target="#modal" data-word="{{ $word->term }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i
                                        class="fa-regular fa-trash-can"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="8">
                        <h3 class="text-center">There aren't any words.</h3>
                    </td>
                </tr>
            @endforelse

        </tbody>
    </table>


    {{-- @if ($words->hasPages())
    {{ $words->links() }}
@endif --}}


@endsection

@section('scripts')

    {{-- Delete confirmation --}}
    @vite('resources/js/delete_confirmation.js')

@endsection

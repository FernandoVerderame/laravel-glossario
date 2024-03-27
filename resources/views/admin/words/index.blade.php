@extends('layouts.app')

@section('title', 'Words')

@section('content')

<header class="d-flex align-items-center justify-content-between pb-4 mb-4 mt-3 border-bottom">
    <h1>Words</h1>
</header>

<table class="table table-hover table-secondary table-striped border mb-4">
    <thead class="table-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Term</th>
            <th scope="col">Slug</th>
            <th scope="col">Technology</th>
            <th scope="col">Status</th>
            <th scope="col">Created</th>
            <th scope="col">Updated</th>
            <th>
                <div class="d-flex justify-content-end gap-2">
                    <a href="" class="btn btn-sm btn-secondary"><i class="fa-solid fa-trash me-2"></i>Show trash</a>

                    <a href="{{ route('admin.words.create')}}" class="btn btn-sm btn-success"><i class="fa-solid fa-plus me-2"></i>New Word</a>
                </div>
            </th>
        </tr>
    </thead>
    <tbody>

        @forelse($words as $word)
        <tr>
            <th scope="row">{{ $word->id }}</th>
            <td>{{ $word->term }}</td>
            <td>{{ $word->slug }}</td>
            <td>{{ $word->technology }}</td>
            <td>{{ $word->is_published }}</td>
            <td>{{ $word->getFormattedDate('created_at') }}</td>
            <td>{{ $word->getFormattedDate('updated_at') }}</td>
            <td>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.words.show', $word->id) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('admin.words.edit', $word->id) }}" class="btn btn-sm btn-warning"><i class="fa-solid fa-pencil"></i></a>

                    <form action="{{ route('admin.words.destroy', $word->id) }}" method="POST" class="delete-form" data-bs-toggle="modal" data-bs-target="#modal" data-word="{{ $word->term }}">
                        @csrf
                        @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa-regular fa-trash-can"></i></button>
                    </form>
                </div>
            </td>
        </tr>

        @empty 
            <tr>
                <td colspan="8">
                    <h3 class="text-center">There aren't any projects.</h3>
                </td>
            </tr>
        @endforelse

    </tbody>
</table>


{{-- @if($words->hasPages())
    {{ $words->links() }}
@endif --}}


@endsection

@section('scripts')

    @vite('resources/js/delete_confirmation.js')

@endsection
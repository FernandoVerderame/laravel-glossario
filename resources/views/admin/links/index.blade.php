@extends('layouts.app')

@section('title', 'Links')

@section('content')

{{-- Header --}}
<header class="d-flex align-items-center justify-content-between pb-4 mb-4 mt-3 border-bottom">
    <h1>Links</h1>
</header>

{{-- Words table --}}
<table class="table table-hover table-secondary table-striped border mb-4">

    {{-- Words table head --}}
    <thead class="table-dark">
        <tr class="align-middle">
            <th scope="col">#</th>
            <th scope="col">SRC</th>
            <th scope="col">Word</th>
            <th scope="col">Created</th>
            <th scope="col">Updated</th>
            <th>
                <div class="d-flex justify-content-end gap-2">

                    {{-- Trash button --}}
                    <a href="" class="btn btn-sm btn-secondary"><i class="fa-solid fa-trash me-2"></i>Show trash</a>

                    {{-- Create new word button --}}
                    <a href="{{ route('admin.links.create')}}" class="btn btn-sm btn-success"><i class="fa-solid fa-plus me-2"></i>New Link</a>
                </div>
            </th>
        </tr>
    </thead>

    {{-- Words table body --}}
    <tbody>

        @forelse($links as $link)
        <tr class="align-middle">
            <th scope="row">{{ $link->id }}</th>
            <td>{{ $link->src }}</td>
            <td>{{ $link->word->term }}</td>
            <td>{{ $link->getFormattedDate('created_at') }}</td>
            <td>{{ $link->getFormattedDate('updated_at') }}</td>
            <td>
                <div class="d-flex justify-content-end gap-2">

                    {{-- Word show button --}}
                    <a href="{{ route('admin.links.show', $link->id) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-eye"></i>
                    </a>

                    {{-- Word edit button --}}
                    <a href="{{ route('admin.links.edit', $link->id) }}" class="btn btn-sm btn-warning"><i class="fa-solid fa-pencil"></i></a>

                    {{-- Word delete button --}}
                    <form action="{{ route('admin.links.destroy', $link->id) }}" method="POST" class="delete-form" data-bs-toggle="modal" data-bs-target="#modal" data-word="{{ $link->term }}">
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
                    <h3 class="text-center">There aren't any links.</h3>
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

    {{-- Delete confirmation --}}
    @vite('resources/js/delete_confirmation.js')

@endsection
@extends('admin.layout')

@section('title', 'Category')

@section('content')

    <div class="row justify-content-center">
        <div class="col-lg-8">

            {{-- Page Header --}}
            <div class="mb-4 d-flex justify-content-between align-items-start">
                <div>
                    <h3 class="fw-bold mb-1">Category Details</h3>
                    <p class="text-muted mb-0">
                        View category information
                    </p>
                </div>

                <a href="{{ route('admin.categories.index') }}" class="btn btn-light">
                    ← Back
                </a>
            </div>

            {{-- Card --}}
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">

                    {{-- Category Name --}}
                    <div class="mb-4">
                        <label class="text-muted small fw-semibold">
                            Category Name
                        </label>
                        <div class="fs-5 fw-bold">
                            {{ $category->name }}
                        </div>
                    </div>

                    {{-- Restaurant --}}
                    <div class="mb-4">
                        <label class="text-muted small fw-semibold">
                            Restaurant
                        </label>
                        <div class="fs-6">
                            {{ $category->restaurant?->name ?? '—' }}
                        </div>
                    </div>

                    {{-- Divider --}}
                    <hr class="my-4">

                    {{-- Actions --}}
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted small">
                            Category ID #{{ $category->id }}
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-outline-secondary">
                                Edit
                            </a>

                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                onsubmit="return confirm('Delete this category?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection

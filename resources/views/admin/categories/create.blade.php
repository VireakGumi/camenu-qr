@extends('admin.layout')

@section('title', 'Create Category')

@section('content')

    <div class="row justify-content-center">
        <div class="col-lg-8">

            {{-- Page Header --}}
            <div class="mb-4">
                <h3 class="fw-bold mb-1">Create Category</h3>
                <p class="text-muted mb-0">
                    Add a new category for restaurant menu items
                </p>
            </div>

            {{-- Card --}}
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">

                    <form action="{{ route('admin.categories.store') }}" method="POST">
                        @csrf

                        {{-- Category Name --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Category Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="name" class="form-control" placeholder="e.g. Drinks, Main Course"
                                value="{{ old('name') }}" required>
                        </div>

                        {{-- Restaurant --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Restaurant <span class="text-danger">*</span>
                            </label>
                            <select name="restaurant_id" class="form-select" required>
                                <option value="">— Select Restaurant —</option>
                                @foreach ($restaurants as $r)
                                    <option value="{{ $r->id }}"
                                        {{ old('restaurant_id') == $r->id ? 'selected' : '' }}>
                                        {{ $r->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="form-text">
                                This category will be available only for the selected restaurant
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-light">
                                ← Back
                            </a>

                            <button class="btn btn-primary px-4">
                                Create Category
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

@endsection

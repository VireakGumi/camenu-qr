@extends('admin.layout')

@section('title', 'Edit Category')

@section('content')

    <div class="row justify-content-center">
        <div class="col-lg-8">

            {{-- ================= PAGE HEADER ================= --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold mb-1">Edit Category</h3>
                    <p class="text-muted mb-0">
                        Update category information
                    </p>
                </div>

                <a href="{{ route('admin.categories.index') }}" class="btn btn-light">
                    ← Back
                </a>
            </div>

            {{-- ================= ERRORS ================= --}}
            @if ($errors->any())
                <div class="alert alert-danger shadow-sm">
                    <div class="fw-semibold mb-2">
                        <i class="bi bi-exclamation-triangle-fill me-1"></i>
                        Please fix the following issues:
                    </div>
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- ================= CARD ================= --}}
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">

                    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- CATEGORY NAME --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Category Name <span class="text-danger">*</span>
                            </label>

                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $category->name) }}" placeholder="e.g. Drinks, Main Course" required>

                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- RESTAURANT --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Restaurant <span class="text-danger">*</span>
                            </label>

                            <select name="restaurant_id" class="form-select @error('restaurant_id') is-invalid @enderror"
                                required>
                                <option value="">— Select Restaurant —</option>

                                @foreach ($restaurants as $r)
                                    <option value="{{ $r->id }}"
                                        {{ old('restaurant_id', $category->restaurant_id) == $r->id ? 'selected' : '' }}>
                                        {{ $r->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('restaurant_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <div class="form-text">
                                Changing the restaurant will move this category to another restaurant
                            </div>
                        </div>

                        {{-- DIVIDER --}}
                        <hr class="my-4">

                        {{-- ACTIONS --}}
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-muted small">
                                Category ID #{{ $category->id }}
                            </div>

                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.categories.index') }}" class="btn btn-light">
                                    Cancel
                                </a>

                                <button class="btn btn-outline-warning px-4">
                                    <i class="bi bi-save"></i>
                                    Save Changes
                                </button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

@endsection

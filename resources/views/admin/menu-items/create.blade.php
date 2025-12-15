@extends('admin.layout')

@section('title', 'Create Menu Item')

@section('content')

    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">

                    {{-- Header --}}
                    <div class="mb-4">
                        <h3 class="fw-bold mb-1">Create Menu Item</h3>
                        <p class="text-muted mb-0">
                            Add a new item to your restaurant menu
                        </p>
                    </div>

                    {{-- 🔴 Subscription / Limit Error --}}
                    @if ($errors->has('limit'))
                        <div class="alert alert-danger d-flex align-items-center mb-4">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <div>
                                {{ $errors->first('limit') }}
                            </div>
                        </div>
                    @endif

                    {{-- 🔴 Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger mb-4">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Context --}}
                    <div class="alert alert-light border d-flex align-items-center gap-3 mb-4">
                        @if ($restaurant->logo)
                            <img src="{{ asset('storage/logos/' . $restaurant->logo) }}" class="rounded"
                                style="width:48px;height:48px;object-fit:cover;">
                        @endif

                        <div>
                            <div class="fw-semibold">{{ $restaurant->name }}</div>
                            <div class="small text-muted">Menu ID #{{ $menu->id }}</div>
                        </div>
                    </div>

                    <form action="{{ route('admin.menu-items.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">

                        {{-- Item Name --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Item Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="name" class="form-control" placeholder="e.g. Grilled Chicken"
                                value="{{ old('name') }}" required>
                        </div>

                        {{-- Description --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Description</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Short description for customers">{{ old('description') }}</textarea>
                        </div>

                        {{-- Price & Category --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    Price <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" name="price" step="0.01" min="0" class="form-control"
                                        value="{{ old('price') }}" required>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Category</label>
                                <select name="category_id" class="form-select">
                                    <option value="">— No Category —</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Image --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Item Image</label>
                            <input type="file" name="image" class="form-control">
                            <div class="form-text">
                                JPG / PNG • Max 2MB • Recommended square image
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                            <a href="{{ route('admin.restaurants.show', $restaurant->id) }}" class="btn btn-light">
                                ← Cancel
                            </a>

                            <button class="btn btn-primary px-4">
                                Create Item
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

@endsection

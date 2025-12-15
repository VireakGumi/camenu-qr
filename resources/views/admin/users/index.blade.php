@extends('admin.layout')

@section('title', 'Users')

@section('content')

    {{-- ================= PAGE HEADER ================= --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Users</h3>
            <p class="text-muted mb-0">
                Manage system users and permissions
            </p>
        </div>

        <a href="{{ route('admin.users.create') }}" class="btn btn-outline-warning">
            <i class="bi bi-plus-circle"></i> New User
        </a>
    </div>

    {{-- ================= CARD ================= --}}
    <div class="card">
        <div class="card-body p-4">

            {{-- Search --}}
            <form class="row g-2 align-items-center mb-4" method="GET" action="{{ route('admin.users.index') }}">
                <div class="col-md-10">
                    <input type="text" name="q" value="{{ request('q') }}" class="form-control"
                        placeholder="Search by name or email">
                </div>
                <div class="col-md-2 d-grid">
                    <button class="btn btn-outline-warning">
                        <i class="bi bi-search"></i> Search
                    </button>
                </div>
            </form>

            {{-- Table --}}
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th style="width:60px;">#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Created</th>
                            <th class="text-end" style="width:160px;">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td class="text-muted">{{ $user->id }}</td>

                                <td>
                                    <div class="fw-semibold">{{ $user->name }}</div>
                                </td>

                                <td class="text-muted">
                                    {{ $user->email }}
                                </td>

                                <td>
                                    <span class="badge bg-secondary-subtle text-secondary">
                                        {{ $user->role?->name ?? '—' }}
                                    </span>
                                </td>

                                <td class="text-muted">
                                    {{ $user->created_at?->format('Y-m-d') ?? '—' }}
                                </td>

                                {{-- Actions --}}
                                <td class="text-end">
                                    <div class="d-inline-flex gap-1">
                                        <a href="{{ route('admin.users.show', $user->id) }}"
                                            class="btn btn-sm btn-outline-warning" title="View">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                            class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                            onsubmit="return confirm('Delete this user?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-warning btn-delete" title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    No users found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Footer --}}
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted small">
                    Showing {{ $users->firstItem() ?? 0 }}
                    – {{ $users->lastItem() ?? 0 }}
                    of {{ $users->total() ?? 0 }}
                </div>

                <div>
                    {{ $users->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            </div>

        </div>
    </div>

@endsection

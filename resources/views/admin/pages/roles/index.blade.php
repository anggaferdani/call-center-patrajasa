@extends('admin.templates.pages')
@section('title')
@section('content')
<div class="page-header d-print-none">
  <div class="container-xl">
    <div class="row g-2 align-items-center">
      <div class="col">
        <h2 class="page-title">Role</h2>
      </div>
    </div>
  </div>
</div>
<div class="page-body">
  <div class="container-xl">
    <div class="row row-cards">
      <div class="col-12">
        <div class="card">
          <div class="card-body border-bottom py-3">
            <div class="d-flex flex-column flex-md-row align-items-center gap-2 gap-md-0 justify-content-between">
              <div class="btn-list w-100">
                @can('role-create')
                  <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">Create</a>
                @endcan
              </div>
              <div class="d-flex w-100 flex-md-row flex-column justify-content-end">
                <div class="col-md-4">
                  <input type="text" class="form-control" placeholder="Search">
                </div>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-vcenter card-table datatable">
              <thead>
                <tr>
                  <th>No.</th>
                  @can('role-show', 'role-edit', 'role-delete')
                    <th>Action</th>
                  @endcan
                  <th>Name</th>
                </tr>
              </thead>
              <tbody>
                @forelse($roles as $role)
                  <tr>
                    <td>{{ $roles->firstItem() + $loop->index }}</td>
                    @can('role-show', 'role-edit', 'role-delete')
                      <td>
                        <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" class="btn-list flex-nowrap mb-0" enctype="multipart/form-data">
                          @csrf
                          @method('DELETE')
                          @can('role-show')
                            <a href="{{ route('admin.roles.show', $role->id) }}" class="btn">Show</a>
                          @endcan
                          @can('role-edit')
                            <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn">Edit</a>
                          @endcan
                          @can('role-delete')
                            <button type="button" class="btn delete">Delete</button>
                          @endcan
                        </form>
                      </td>
                    @endcan
                    <td class="small">{{ $role->name }}</td>
                  </tr>
                @empty
                @php
                  $permissions = ['role-show', 'role-edit', 'role-delete'];
                  $permissionCount = collect($permissions)->filter(fn ($permission) => auth()->user()->can($permission))->count();
                @endphp
                <tr>
                  <td class="text-center" colspan="{{ $permissionCount }}">No records found</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
          <div class="card-footer d-flex align-items-center">
            <ul class="pagination m-0 ms-auto">
              @if($roles->hasPages())
                {{ $roles->links('pagination::bootstrap-4') }}
              @else
                <li class="page-item">No more records</li>
              @endif
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
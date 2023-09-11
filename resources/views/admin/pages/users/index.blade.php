@extends('admin.templates.pages')
@section('title')
@section('content')
<div class="page-header d-print-none">
  <div class="container-xl">
    <div class="row g-2 align-items-center">
      <div class="col">
        <h2 class="page-title">User</h2>
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
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Create</a>
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
                  <th>Action</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Roles</th>
                </tr>
              </thead>
              <tbody>
                @forelse($users as $user)
                  <tr>
                    <td>{{ $users->firstItem() + $loop->index }}</td>
                    <td>
                      <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="btn-list flex-nowrap mb-0" enctype="multipart/form-data">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('admin.users.show', $user->id) }}" class="btn">Show</a>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn">Edit</a>
                        <button type="button" class="btn delete">Delete</button>
                      </form>
                    </td>
                    <td class="small">{{ $user->name }}</td>
                    <td class="small">{{ $user->email }}</td>
                    <td>
                      @if(!empty($user->getRoleNames()))
                        @foreach($user->getRoleNames() as $role)
                           {{ $role }}
                        @endforeach
                      @endif
                    </td>
                  </tr>
                @empty
                <tr>
                  <td class="text-center" colspan="5">No records found</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
          <div class="card-footer d-flex align-items-center">
            <ul class="pagination m-0 ms-auto">
              @if($users->hasPages())
                {{ $users->links('pagination::bootstrap-4') }}
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
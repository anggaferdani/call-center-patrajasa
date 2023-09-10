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
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="card" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="card-header">
            <h4 class="card-title">Edit</h4>
          </div>
          <div class="card-body">
            <div class="mb-3">
              <label class="form-label required">Name</label>
              <input type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="">
              @error('name')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
              <label class="form-label required">Email</label>
              <input type="email" class="form-control" name="email" value="{{ $user->email }}" placeholder="">
              @error('email')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
              <label class="form-label required">Password</label>
              <input type="text" class="form-control" name="password" placeholder="">
              @error('password')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
              <label class="form-label required">Roles</label>
              <select name="roles[]" class="form-select" multiple>
                @foreach($roles as $role)
                  <option value="{{ $role->id }}" {{ in_array($role->id, old('roles', [])) ? 'selected' : '' }}>{{ $role->name }}</option>
                @endforeach
              </select>
              @error('roles')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
          </div>
          <div class="card-footer text-end">
            <div class="d-flex">
              <a href="{{ route('admin.users.index') }}" class="btn">Cancel</a>
              <button type="submit" class="btn btn-primary ms-auto">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
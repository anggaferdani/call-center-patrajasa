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
        <form action="{{ route('admin.roles.store') }}" method="POST" class="card" enctype="multipart/form-data">
          @csrf
          <div class="card-header">
            <h4 class="card-title">Create</h4>
          </div>
          <div class="card-body">
            <div class="mb-3">
              <label class="form-label required">Name</label>
              <input type="text" class="form-control" name="name" placeholder="">
              @error('name')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
              <label class="form-label required">Permission</label>
              <select name="permission[]" class="form-select" multiple>
                @foreach($permission as $permission2)
                  <option value="{{ $permission2->id }}">{{ $permission2->name }}</option>
                @endforeach
              </select>
              @error('permission')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
          </div>
          <div class="card-footer text-end">
            <div class="d-flex">
              <a href="{{ route('admin.roles.index') }}" class="btn">Cancel</a>
              <button type="submit" class="btn btn-primary ms-auto">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
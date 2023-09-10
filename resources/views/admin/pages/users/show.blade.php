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
        <form action="" method="POST" class="card" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="card-header">
            <h4 class="card-title">Show</h4>
          </div>
          <table class="table table-vcenter table-bordered table-nowrap card-table">
            <tbody>
              <tr>
                <td>Name</td>
                <td>{{ $user->name }}</td>
              </tr>
              <tr>
                <td>Email</td>
                <td>{{ $user->email }}</td>
              </tr>
            </tbody>
          </table>
          <div class="card-footer text-end border-0">
            <div class="d-flex">
              <a href="{{ route('admin.users.index') }}" class="btn">Cancel</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
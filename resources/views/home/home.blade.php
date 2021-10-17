@extends('layouts.app')

@section('content')
    <!-- ========== title-wrapper start ========== -->
<div class="title-wrapper pt-30">
  <div class="row align-items-center">
    <div class="col-md-6">
      <div class="titlemb-30">
        <h2>Home</h2>
      </div>
    </div>
    <!-- end col -->
    <div class="col-md-6">
      <div class="breadcrumb-wrapper mb-30">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#0">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
              Page
            </li>
          </ol>
        </nav>
      </div>
    </div>
    <!-- end col -->
  </div>
  <!-- end row -->
</div>
<div class="body-wrapper">
  @include('layouts.alerts')
  <div class="row">
    <div class="col-12 col-sm-6 mt-2">
      <div class="card">
        <div class="card-header">
          Migrated Files
        </div>
        <div class="card-body">
          <h2 class="text-success">
            {{ count($migrationFiles['migrated']) }}
          </h2>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-6 mt-2">
      <div class="card">
        <div class="card-header">
          Pending
        </div>
        <div class="card-body">
          <h2 class="text-danger">
            {{ count($migrationFiles['pending_migrations']) }}
          </h2>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- ========== title-wrapper end ========== -->
@endsection
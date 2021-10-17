@extends('layouts.app')

@section('content')
    <!-- ========== title-wrapper start ========== -->
<div class="title-wrapper pt-30">
  <div class="row align-items-center">
    <div class="col-md-6">
      <div class="titlemb-30">
        <h2>Status Migrate</h2>
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
              Status Migrate
            </li>
          </ol>
        </nav>
      </div>
    </div>
    <!-- end col -->
  </div>
  <!-- end row -->
</div>
<!-- ========== title-wrapper end ========== -->
<div class="body-wrapper">
  <div class="row">
    <div class="col-12">
      @include('layouts.alerts')
    </div>
  </div>
  <div class="row">
    <div class="col-12 col-sm-6">
      <div class="card">
        <div class="card-header">
          <h6>
            Migrated Files
          </h6>
        </div>
        <div class="card-body">
          <div class="table-wrapper table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>
                    #
                  </th>
                  <th>
                    Files
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($migrationFiles['migrated'] as $item)
                    <tr>
                      <td class="min-width text-success">
                        {{ $loop->iteration }}
                      </td>
                      <td class="min-width">
                        <a href="{{ route('status_migrate.show_file', ['file_name' => $item]) }}" class="text-success">
                          {{ $item }}
                        </a>
                      </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-6">
      <div class="card">
        <div class="card-header">
          <h6>
            Pending Migrate
          </h6>
        </div>
        <div class="card-body">
          <div class="table-wrapper table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>
                    #
                  </th>
                  <th>
                    Files
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($migrationFiles['pending_migrations'] as $item)
                    <tr>
                      <td class="min-width text-danger">
                        {{ $loop->iteration }}
                      </td>
                      <td class="min-width text-danger">
                        <a href="{{ route('status_migrate.show_file', ['file_name' => $item]) }}" class="text-danger">
                          {{ $item }}
                        </a>
                      </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
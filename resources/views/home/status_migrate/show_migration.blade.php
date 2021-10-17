@extends('layouts.app')

@section('content')
    <!-- ========== title-wrapper start ========== -->
<div class="title-wrapper pt-30">
  <div class="row align-items-center">
    <div class="col-md-4">
      <div class="titlemb-30">
        <h2>Show File</h2>
      </div>
    </div>
    <!-- end col -->
    <div class="col-md-8">
      <div class="breadcrumb-wrapper mb-30">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#0">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
              <a href="{{ url('/status_migrate') }}">Status Migrate</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
              {{ $file_name }}
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
<div class="body-wrapper pt-30">
  <div class="row">
      <div class="col-12 mb-2">
          <a href="{{ url('/status_migrate') }}" class="btn btn-dark">
            <i class="lni lni-chevron-left me-2"></i>
            Back
          </a>
      </div>
      <div class="col-12">
          <div class="card">
              <div class="card-body">
                @php
                    $file_content = htmlspecialchars($file_content);
                    $file_content = str_replace('&lt;?php', '', $file_content);
                @endphp
                <pre>{{ "<" }}{{ "?php" }}{!! $file_content !!}
                </pre>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
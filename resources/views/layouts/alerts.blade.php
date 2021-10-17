@if (session('alert-type'))
<div class="alert alert-{{ session('alert-type') }}">
    {{ session('message') }}
</div>
@endif
@extends('admin.layouts.admin')

@section('content')
    <script>
        window.location.href = "{{ route('tiketmasuks.index') }}?openCreateModal=true";
    </script>
@endsection
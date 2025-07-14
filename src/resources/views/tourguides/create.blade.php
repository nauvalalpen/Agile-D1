@extends('admin.layouts.admin')

@section('content')
    <script>
        window.location.href = "{{ route('tourguides.index') }}?openCreateModal=true";
    </script>
@endsection

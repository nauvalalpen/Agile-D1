@extends('admin.layouts.admin')

@section('content')
    <script>
        window.location.href = "{{ route('tiketmasuks.index') }}?openEditModal={{ $tourguides->id }}";
    </script>
@endsection

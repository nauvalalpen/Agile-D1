@extends('admin.layouts.admin')

@section('content')
    <script>
        window.location.href = "{{ route('tourguides.index') }}?openEditModal={{ $tourguides->id }}";
    </script>
@endsection

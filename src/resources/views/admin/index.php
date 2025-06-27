@extends('layouts.admin')
@section('content')
<div class="container">
    <h2>Manajemen Wisatawan</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>KTP / ID</th>
                <th>Tanggal Masuk</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tourists as $tourist)
                <tr>
                    <td>{{ $tourist->name }}</td>
                    <td>{{ $tourist->id_card }}</td>
                    <td>{{ $tourist->entry_date }}</td>
                    <td>
                        <button class="btn btn-primary">Checkout</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

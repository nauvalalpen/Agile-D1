@extends('layouts.admin')
@section('content')
<div class="container">
    <h2>Tourist Management</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>ID Card</th>
                <th>Entry Date</th>
                <th>Actions</th>
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

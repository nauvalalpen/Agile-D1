@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>{{ __('Process Tour Guide Order') }}</span>
                            <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-secondary">Back to Orders</a>
                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="mb-4">
                            <h5>Order Information</h5>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Order ID</th>
                                        <td>{{ $order->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>User</th>
                                        <td>{{ $order->user_name }} ({{ $order->user_email }})</td>
                                    </tr>
                                    <tr>
                                        <th>Tour Guide</th>
                                        <td>{{ $order->tourguide_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tour Guide Phone</th>
                                        <td>{{ $order->tourguide_nohp }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tour Date</th>
                                        <td>{{ date('d M Y', strtotime($order->tanggal_order)) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Number of People</th>
                                        <td>{{ $order->jumlah_orang }}</td>
                                    </tr>
                                    <tr>
                                        <th>Price Range</th>
                                        <td>{{ $order->price_range }}</td>
                                    </tr>
                                    <tr>
                                        <th>Current Status</th>
                                        <td>
                                            @if ($order->status == 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                            @elseif($order->status == 'accepted')
                                                <span class="badge bg-success">Accepted</span>
                                            @elseif($order->status == 'rejected')
                                                <span class="badge bg-danger">Rejected</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <form method="POST" action="{{ route('admin.orders.update', $order->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group row mb-3">
                                <label for="final_price"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Final Price (Rp)') }}</label>
                                <div class="col-md-6">
                                    <input id="final_price" type="number" min="0"
                                        class="form-control @error('final_price') is-invalid @enderror" name="final_price"
                                        value="{{ old('final_price', $order->final_price) }}">
                                    <small class="form-text text-muted">Required if accepting the order</small>
                                    @error('final_price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="admin_notes"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Admin Notes') }}</label>
                                <div class="col-md-6">
                                    <textarea id="admin_notes" class="form-control @error('admin_notes') is-invalid @enderror" name="admin_notes"
                                        rows="3">{{ old('admin_notes', $order->admin_notes) }}</textarea>
                                    <small class="form-text text-muted">Optional notes to the customer</small>
                                    @error('admin_notes')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-4 col-form-label text-md-right">{{ __('Decision') }}</label>
                                <div class="col-md-6">
                                    <div class="d-flex gap-2">
                                        <button type="submit" name="status" value="accepted" class="btn btn-success">
                                            {{ __('Accept Order') }}
                                        </button>
                                        <button type="submit" name="status" value="rejected" class="btn btn-danger">
                                            {{ __('Reject Order') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .gap-2 {
            gap: 0.5rem;
        }

        .d-flex {
            display: flex;
        }
    </style>
@endsection

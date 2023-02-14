@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="card-title">Data Pelanggan</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {!! session('success') !!}
                            </div>
                        @endif
                        <div class="col-md-6">
                                <a href="{{ route('createCustomers') }}" class="btn btn-outline-success">Tambah Data</a>
                            </div>
                            <br>
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Tujuan</th>
                                    <th>Alamat</th>
                                    <th>Subject</th>
                                    <th>Tanggal Pembuatan</th>
                                    <th>Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse($customers as $customer)
                                <tr>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->address }}</td>
                                    <td>{{ $customer->subject }}</td>
                                    <td>{{ $customer->created_at->format('d-m-Y') }}</td>
                                    <td>
                                    <a href="{{url('editCustomer/'.$customer->id) }}" class="btn btn-outline-primary">Edit</a>
                                    <a href="{{url('deleteCustomer/'.$customer->id) }}" class="btn btn-outline-danger" onclick="return confirm('yakin ?')">Delete</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="5">Tidak ada data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="float-right">
                            {{ $customers->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
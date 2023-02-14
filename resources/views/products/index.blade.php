@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="card-title">Data Products</h3>
                            </div>
                           
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {!! session('success') !!}
                            </div>
                        @endif
                        <div class="col-md-8">
                                <a href="{{ route('createProducts') }}" class="btn btn-outline-success">Tambah Data</a>
                            </div>
                            <br>
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Jenis Item</th>
                                    <th>Deskripsi</th>
                                    <th>Harga</th>
                                    <th style="width: 20%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            @forelse($products as $product)
                                <tr>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>Rp {{ number_format($product->price) }}</td>
                                    <td>
                                   
                                    <a href="{{url('editProduct/'.$product->id) }}" class="btn btn-outline-primary">Edit</a>
                                    <a href="{{url('deleteProduct/'.$product->id) }}" class="btn btn-outline-danger" onclick="return confirm('yakin ?')">Delete</a>
          
                                </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="6">Tidak ada data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection
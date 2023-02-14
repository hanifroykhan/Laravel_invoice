@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Data Produk</h3>
                    </div>
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
					
                        <form action="{{ url('updateProduct/'.$editProduct->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="_method" value="PUT" class="form-control">
                            <div class="form-group">
                                <label for="">Jenis Item</label>
                                <input type="text" name="title" class="form-control" value="{{ $editProduct->title }}" placeholder="Masukkan Jenis Produk">
                            </div>
                            <div class="form-group">
                                <label for="">Deskripsi</label>
                                <input type="text" name="description" class="form-control" value="{{ $editProduct->description }}" placeholder="Masukkan Deskripsi Produk">
                            </div>
                            <div class="form-group">
                                <label for="">Harga</label>
                                <input type="number" name="price" class="form-control" value="{{ $editProduct->price }}" placeholder="Masukkan Harga Produk">
                            </div>
                            <br>
                            <div class="form-group mb-3">
                            <button type="submit" class="btn btn-danger btn-sm">Update Data</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
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
						
                        <form action="{{ url('updateCustomer/'.$editCustomer->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="_method" value="PUT" class="form-control">
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" name="name" class="form-control" value="{{ $editCustomer->name }}" placeholder="Masukkan Tujuan">
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <input type="text" name="address" class="form-control" value="{{ $editCustomer->address }}" placeholder="Masukkan Alamat">
                            </div>
                            <div class="form-group">
                                <label for="">Subject</label>
                                <input type="text" name="subject" class="form-control" value="{{ $editCustomer->subject }}" placeholder="Masukkan Subject">
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
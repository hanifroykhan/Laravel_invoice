@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="row">
                            
                            <div class="col-md-6">
                                <table>
                                    <tr>
                                        <td width="45%">Invoice ID</td>
                                        <td>: </td>
                                        <td>{{ $invoice->id }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Pembuatan</td>
                                        <td>: </td>
                                        <td>{{ $invoice->customer->created_at->format('d-m-Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Berakhir</td>
                                        <td>: </td>
                                        <td>{{ $invoice->customer->created_at->format('d-m-Y') }} (upon receipt)</td>
                                    </tr>
                                    <tr>
                                        <td>Subject</td>
                                        <td>: </td>
                                        <td>{{ $invoice->customer->subject }}</td>
                                    </tr>

                                </table>
                            </div>
                            <div class="col-md-6">
                                <table>
                                    <tr>
                                        <td width="20%">Pengirim</td>
                                        <td>: </td>
                                        <td>Discovery Designs</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>: </td>
                                        <td>41 St Vincent Place Glasgow G1 2ER Scotland</td>
                                    </tr>
                                    <tr>
                                        <td>Tujuan</td>
                                        <td>: </td>
                                        <td>{{ $invoice->customer->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>: </td>
                                        <td>{{ $invoice->customer->address }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-12 mt-3">
                                <form action="{{ route('updateInvoice', ['id' => $invoice->id]) }}" method="post">
                                @csrf
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>Jenis Item</td>
                                            <td>Descripsi</td>
                                            <td>Kuantitas</td>
                                            <td>Harga</td>
                                            <td>Subtotal</td>
                            
                                        </tr>
                                    </thead>
                                      <tbody>
                                        @php $no = 1 @endphp
                                        @foreach ($invoice->detail as $detail)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $detail->product->title }}</td>
                                            <td>{{ $detail->product->description }}</td>
                                            <td>{{ $detail->qty }}</td>
                                            <td>Rp {{ number_format($detail->price) }}</td>
                                            <td>Rp {{ $detail->subtotal }}</td>
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                    <tfoot>
                                    
                                        <tr>
                                            <td></td>
                                            <td>
                                                <input type="hidden" name="_method" value="PUT" class="form-control">
                                                <select name="product_id" class="form-control">
                                                    <option value="">Pilih Produk</option>
                                                    @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->description }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" min="1" value="1" name="qty" class="form-control" required>
                                            </td>
                                            <td colspan="3">
                                                <button class="btn btn-primary btn-sm">Tambahkan</button>
                                               
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                                </form>
                                </div>
                      
                            <div class="row">
                            <div class="col-md-12">
                                <table>
                                    <tr>
                                        <td>
                                            <a href="{{ route('indexInvoice') }}" class="btn btn-success btn-sm">Simpan</a>
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#paymentModal">
                                            Pembayaran
                                            </button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            </div>
                            <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                <div class="modal-body">
                                    <form action="{{ route('payInvoice',$invoice->id) }}" method="PUT">
                                        @csrf
                                        <input type="hidden" name="_method" value="PUT" class="form-control">
                                        <div class="form-group">
                                            <label for="">Nominal Pembayaran</label>
                                            <input type="text" name="total_paid" class="form-control" value="{{ $invoice->total_paid }}" placeholder="Masukkan Tujuan">
                                        </div>       
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 offset-lg-9">
                            <font size="4" >
                            <table>
                                    <tr>
                                        <td <span style="font-weight:bold" width="50%">Sub Total</span></td>
                                        <td></td>
                                        <td>Rp {{ number_format($invoice->total) }}</td>
                                    </tr>
                                    <tr>
                                        <td <span style="font-weight:bold">Pajak</span></td>
                                        <td></td>
                                        <td>10% (Rp {{ number_format($invoice->tax) }})</td>
                                    </tr>
                                    <tr>
                                        <td <span style="font-weight:bold">Total</span></td>
                                        <td></td>
                                        <td>Rp {{ number_format($invoice->total_price) }}</td>
                                    </tr>
                                    <tr>
                                        <td <span style="font-weight:bold">Bayar</span></td>
                                        <td></td>
                                        <td>Rp {{ number_format($invoice->total_paid) }}</td>
                                    </tr>
                                    <tr>
                                        <td <span style="font-weight:bold">Sisa</span></td>
                                        <td></td>
                                        <td>Rp {{ number_format($invoice->amount_due) }}</td>
                                    </tr>
                            </table>
                            </font>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        </div>
@endsection



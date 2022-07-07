@extends('layout.admin.template')


@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Order</h3>
            </div>
            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="text-align: center">Nama Supplier</th>
                            <th style="text-align: center">Nama Produk</th>
                            <th style="text-align: center">Qty</th>
                            <th style="text-align: center">Harga</th>
                            <th style="text-align: center">Tanggal Order</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $purchase_orders as $row )
                            <tr>
                                <td style="text-align: center">{{ $row->nama_supplier }}</td>
                                <td style="text-align: center">{{ $row->nama_produk }}</td>
                                <td style="text-align: center">{{ $row->qty }}</td>
                                <td style="text-align: center">{{ $total }}</td>
                                <td style="text-align: center">{{ $row->tanggal_pembelian }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
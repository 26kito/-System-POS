@extends('layout.admin.template')


@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Products List</h3>
            </div>
            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="text-align: center">No.</th>
                            <th style="text-align: center">Nama Produk</th>
                            <th style="text-align: center">Stok</th>
                            <th style="text-align: center">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; $i < count($products) ?>
                        @foreach( $products as $row )
                            <tr>
                                <td style="text-align: center">{{ $i++ }}</td>
                                <td style="text-align: center">{{ $row->nama_produk }}</td>
                                <td style="text-align: center">{{ $row->stok }}</td>
                                <td style="text-align: center">{{ $row->harga }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
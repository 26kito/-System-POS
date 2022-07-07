@extends('layout.admin.template')

@section('title')
    {{$title}}
@endsection

@section('content-header')
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Sales Order Page</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('admin/') }}" class="text-white">Home</a></li>
                <li class="breadcrumb-item active">Sales Order Page</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')
    @if (session()->has('message'))
    <div class="alert alert-success">
        <p>{{session()->get('message')}}</p>
        <a href="{{ url('admin/pesanan/sales/report') }}">Lihat laporan penjualan</a>
    </div>
    @endif
    {{-- Modal --}}
    <div class="modal" id="modalInsert" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Sales</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form id="form" action="{{ url('admin/pesanan/sales/insert') }}" method="POST">
                    @csrf
                    <div class="card-body"> <!-- Card Body -->
                        <div class="form-group"> <!-- Nama Customer -->
                            <label for="id_customer">Nama Customer:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                    <i class="fas fa-user-alt"></i>
                                    </span>
                                </div>
                                <select name="id_customer" id="id_customer" class="form-control">
                                    @foreach( $customers as $row )
                                        <option value="{{ $row->id }}">{{ $row->nama_customer }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> <!-- End of Nama Customer -->
                        <div class="form-group"> <!-- Nama Produk -->
                            <label for="produk">Nama Produk:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                    <i class="fa fa-shopping-bag"></i>
                                    </span>
                                </div>
                                <select name="produk" id="id_produk" class="form-control">
                                    @foreach( $products as $row )
                                        <option value="{{ $row->id }}">{{ $row->nama_produk }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> <!-- End of Nama Produk -->
                        <div class="form-group"> <!-- Qty -->
                            <label for="qty">Qty:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                    <i class="fa fa-sort"></i>
                                    </span>
                                </div>
                                <input type="number" class="form-control" name="qty" id="qty" min="0" value="0">
                            </div>
                        </div> <!-- End of Qty -->
                        <div class="form-group"> <!-- Tanggal Order -->
                            <label for="tanggal_order">Tanggal Order:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input type="date" name="tanggal_order" class="form-control" id="tanggal_order">
                            </div>
                        </div> <!-- End of Tanggal Order -->
                    </div>
                    <div class="card-footer">
                        <button type="submit" id="submitBtn" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
    {{-- End of Modal --}}
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Order</h3>
                </div>
                <div class="card-body">
                    <button class="btn btn-success" id="insert">Insert</button>
                    {{-- <a href="{{ url('admin/pesanan/sales/insert') }}" class="btn btn-success" id="insert">Insert</a> --}}
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="text-align: center">No.</th>
                                <th style="text-align: center">Nama Pelanggan</th>
                                <th style="text-align: center">Nama Produk</th>
                                <th style="text-align: center">Qty</th>
                                <th style="text-align: center">Tanggal Order</th>
                                <th style="text-align: center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; $i < count($sales_orders) ?>
                            @foreach( $sales_orders as $row )
                                <tr>
                                    <td style="text-align: center">{{ $i++ }}</td>
                                    <td style="text-align: center">{{ $row->nama_customer }}</td>
                                    <td style="text-align: center">{{ $row->nama_produk }}</td>
                                    <td style="text-align: center">{{ $row->qty }}</td>
                                    <td style="text-align: center">{{ $row->tanggal_penjualan }}</td>
                                    <td style="text-align: center"><a href="{{ url('admin/pesanan/sales/report/'.$row->id) }}" class="btn btn-light btn-outline-primary">Lihat Pesanan</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- DataTables  & Plugins -->
    <script src="{{asset('asset/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('asset/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('asset/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('asset/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>

    <!-- Page specific script -->
    <script>
        $(function () {
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "order": [[ 1, "asc" ]],
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
        $('#insert').on('click', () => {
            $('#modalInsert').modal('show');
        });
        $('#btn-detail-order').on('click', () => {
            $('#detailOrder').modal('show');
        });
    </script>
@endpush
<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\SalesOrder;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SalesOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Sales Order Page';
        $data['customers'] = Customer::get();
        $data['products'] = Product::get();
        $data['sales_orders'] = DB::table( 'sales_orders' )
                                ->join( 'customers', 'sales_orders.id_customer', '=', 'customers.id' )
                                ->join( 'products', 'sales_orders.id_produk', '=', 'products.id' )
                                ->select( 'sales_orders.id' ,'customers.nama_customer', 'products.nama_produk', 'qty', 'tanggal_penjualan' )
                                ->orderBy('id', 'ASC')
                                ->get();
        // return $data['sales_orders'];
        return view('admin.sales.index', $data);
    }

    public function insertAction(Request $request) {
        $salesOrder = new SalesOrder;
        $salesOrder->id_customer = $request->input('id_customer');
        $salesOrder->id_produk = $request->input('produk');
        $salesOrder->qty = $request->input('qty');
        $salesOrder->tanggal_penjualan = $request->input('tanggal_order');
        // return $salesOrder;
        $salesOrder->save();
        
        return back()->with('message', 'Berhasil');
    }

    public function report(Request $request, $id) {
        $data['sales_orders'] = DB::table( 'sales_orders' )
                                ->join( 'customers', 'sales_orders.id_customer', '=', 'customers.id' )
                                ->join( 'products', 'sales_orders.id_produk', '=', 'products.id' )
                                ->select( 'sales_orders.id' ,'customers.nama_customer', 'products.nama_produk', 'sales_orders.qty', 'products.harga', 'sales_orders.tanggal_penjualan' )
                                ->orderBy('id', 'ASC')
                                ->where('sales_orders.id', '=', $id)
                                ->get();
        $data['total'] = 0;
        foreach ( $data['sales_orders'] as $row ) {
            $data['total'] = $data['total'] + ( $row->harga*$row->qty );
        };
        return view('admin.sales.salesreport', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SalesOrder  $salesOrder
     * @return \Illuminate\Http\Response
     */
    public function show(SalesOrder $salesOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SalesOrder  $salesOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(SalesOrder $salesOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SalesOrder  $salesOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SalesOrder $salesOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SalesOrder  $salesOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalesOrder $salesOrder)
    {
        //
    }
}

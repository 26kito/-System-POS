<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Purchase Order Page';
        $data['suppliers'] = Supplier::get();
        $data['products'] = Product::get();
        $data['purchase_orders'] = DB::table( 'purchase_orders' )
                                    ->join( 'suppliers', 'purchase_orders.id_supplier', '=', 'suppliers.id' )
                                    ->join( 'products', 'purchase_orders.id_produk', '=', 'products.id' )
                                    ->select( 'purchase_orders.id', 'suppliers.nama_supplier', 'products.nama_produk', 'qty', 'tanggal_pembelian' )
                                    ->orderBy('id', 'ASC')
                                    ->get();
        // return $data;
        return view('admin.purchase.index', $data);
    }

    public function insertAction(Request $request) {
        $purchaseOrder = new PurchaseOrder();
        $purchaseOrder->id_supplier = $request->input('id_supplier');
        $purchaseOrder->id_produk = $request->input('produk');
        $purchaseOrder->qty = $request->input('qty');
        $purchaseOrder->tanggal_pembelian = $request->input('tanggal_order');
        // return $purchaseOrder;
        $purchaseOrder->save();

        return back()->with('message', 'ashiap');
    }

    public function report(Request $request, $id) {
        $data['purchase_orders'] = DB::table( 'purchase_orders' )
                                ->join( 'suppliers', 'purchase_orders.id_supplier', '=', 'suppliers.id' )
                                ->join( 'products', 'purchase_orders.id_produk', '=', 'products.id' )
                                ->select( 'purchase_orders.id' ,'suppliers.nama_supplier', 'products.nama_produk', 'purchase_orders.qty', 'products.harga', 'purchase_orders.tanggal_pembelian' )
                                ->orderBy('id', 'ASC')
                                ->where('purchase_orders.id', '=', $id)
                                ->get();
        $data['total'] = 0;
        foreach ( $data['purchase_orders'] as $row ) {
            $data['total'] = $data['total'] + ( $row->harga*$row->qty );
        };
        return view('admin.purchase.purchasereport', $data);
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
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseOrder $purchaseOrder)
    {
        //
    }
}

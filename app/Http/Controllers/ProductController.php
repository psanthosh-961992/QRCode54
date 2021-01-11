<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Products;

use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    /* 
         * Product Listing Page
         * @author P.Santhosh <<  psanthosh.961992@outlook.in  >> 
         * 12-10-2020
    */
    public function index()
    {
        $rawdata['list'] = Products::list();
        return view('product.index',compact('rawdata'));
    }

    /* 
         * Store Product Value
         * @author P.Santhosh <<  psanthosh.961992@outlook.in  >> 
         * 12-10-2020
    */
    public function store(Request $request)
    {
        $status = Products::store($request->all());
        switch($status){
            case 1:
                return redirect()->route('product.index')->with('success','Product Added Successfully');
            break;
            case 2:
                return redirect()->route('product.index')->with('error','Product Added Failed !!!');
            break;
            case 3:
                return redirect()->route('product.index')->with('success','Product Already Existed, Item Quantity Increased By 1');
            break;
            case 4:
                return redirect()->route('product.index')->with('error','Product Update Failed !!!');
            break;
        }
    }

    /* 
         * Get Maximum Count Value in Product Table
         * @author P.Santhosh <<  psanthosh.961992@outlook.in  >> 
         * 12-10-2020
    */
    public function getmaxcount($id){
        $response = ['maxcount'=>Products::increaseQtyById(['id'=>$id]) , 'products'=>Products::list(['id'=>$id])];
        return json_encode($response);
    }

     /* 
         * Webcam with QR Code
         * @author P.Santhosh <<  psanthosh.961992@outlook.in  >> 
         * 13-10-2020
    */
    public function qrcode()
    {
        return view('product.qrcode');
    }

    /* 
         * Webcam with QR Code
         * @author P.Santhosh <<  psanthosh.961992@outlook.in  >> 
         * 13-10-2020
    */
    public function addqtybyqrcode(Request $request){
        $request = $request->all();
        if(!empty($request) && isset($request['qtycode']) && $request['qtycode']!='' ){
            $response = Products::increaseQtyByCode( ['code'=>$request['qtycode']]);
            return 1;
        }
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

use Illuminate\Support\Facades\Log;

class Products extends Model
{
    protected $table = "products";
    public $timestamps = false;

    /* 
         * Get all records from products
         * @author P.Santhosh <<  psanthosh.961992@outlook.in  >> 
         * 12-10-2020
    */
    public static function list($PK_array=[]){
        return DB::table('products')->where($PK_array)->get()->toArray();
    }

    /* 
         * Get Maximum value of products count column
         * @author P.Santhosh <<  psanthosh.961992@outlook.in  >> 
         * 12-10-2020
    */
    public static function increaseQtyById($PK_array=[]){
        try{
            $is_prod_existed = Products::where($PK_array)->get()->toArray();
            
            if(!empty($is_prod_existed)){
                $response = DB::table('products')
                            ->where($PK_array)
                            ->update([ 'count'=> $is_prod_existed[0]['count'] + 1, 'updated_on'=> date("Y-m-d H:i:s") ]);
                return $is_prod_existed[0]['count'] + 1;
            } else {
                return 0;
            }
        } catch(\Exception $e){
            \Log::error($e->getMessage());
            return 0;
        }
    }

    /* 
         * Get Maximum value of products count column
         * @author P.Santhosh <<  psanthosh.961992@outlook.in  >> 
         * 12-10-2020
    */
    public static function store($input){
        $is_prod_existed = Products::where([ 'name'=> $input['prod_name'], 'code'=> $input['prod_code'] ])->get()->toArray();
        if(empty($is_prod_existed)){
            $product = new Products;
            $product->name = $input['prod_name'];
            $product->code = $input['prod_code'];
            $product->count = 0;
            $product->added_on = date("Y-m-d H:i:s");
            $product->updated_on = date("Y-m-d H:i:s");
            if($product->save()){
                return 1;
            } else {
                return 2;
            }
        } else {
            $product = DB::table('products')
                        ->where([ 'name'=> $input['prod_name'], 'code'=> $input['prod_code'] ])
                        ->update([ 'count'=> $is_prod_existed[0]['count'] + 1, 'updated_on'=> date("Y-m-d H:i:s") ]);
            if($product){
                return 3;
            } else {
                return 4;
            }
        } 
    }

    /* 
         * Increase Qty by Iteam Code
         * @author P.Santhosh <<  psanthosh.961992@outlook.in  >> 
         * 13-10-2020
    */
    public static function increaseQtyByCode($code_array=[]){
        try{
            $is_prod_existed = Products::where($code_array)->get()->toArray();
            if(!empty($is_prod_existed)){
                $response = DB::table('products')
                            ->where($code_array)
                            ->update([ 'count'=> $is_prod_existed[0]['count'] + 1, 'updated_on'=> date("Y-m-d H:i:s") ]);
                return $is_prod_existed[0]['count'] + 1;
            } else {
                return 0;
            }
        } catch(\Exception $e){
            \Log::error($e->getMessage());
            return 0;
        }
    }
}

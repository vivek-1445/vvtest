<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Model\Product;
use App\Model\User;
use Illuminate\Support\Facades\Log;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $token = $request->header('token');
        $user = User::where('token', $token)->first();
        $products = Product::with(['category', 'creator'])->where('created_by', $user->id)->get();
        return $this->sendResponse($products, 'response returned');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $token = $request->header('token');
        $user = User::where('token', $token)->first();

        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required',
            'quantity' => 'required'
        ]);

        try {
            $product = Product::create([
                'name' => $request->name,
                'category_id' => $request->category,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'created_by' => $user->id
            ]);
            if ($product){
                return $this->sendResponse($product, 'Product Created Successfully');                  
            }else{
                return $this->sendError('Product wasn\'t Created Successfully');
            }
        } catch (\Throwable $th) {
            Log::debug(__('Exception occured'. $th->getMessage()));
            return $this->sendError('Something went wrong, Product wasn\'t Created Successfully', ['message' => $th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $token = $request->header('token');
        $user = User::where('token', $token)->first();
        $product = Product::with(['category', 'creator'])->where(['created_by' =>  $user->id, 'id' => $id])->get();
        return $this->sendResponse($product, 'response returned');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required',
            'quantity' => 'required'
        ]);

        try {
            $data = [
                'name' => $request->name,
                'category_id' => $request->category,
                'price' => $request->price,
                'quantity' => $request->quantity,
            ];
            $product = Product::find($id);
            $product->fill($data);
            if ($product->save()){
                return $this->sendResponse($product, 'Product updated Successfully');
            }else{
                return $this->sendError('Product wasn\'t uopdated Successfully');
            }
        } catch (\Throwable $th) {
            Log::debug(__('Exception occured'. $th->getMessage()));
            return $this->sendError('Something went wrong, Product wasn\'t Created Successfully', ['message' => $th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {
            $product = Product::find($id);
            if ($product->delete()){
                return $this->sendResponse([], 'Product has been deleted');
            }else {
                return $this->sendResponse([], 'Product hasn\'t been deleted');
            }
        } catch (\Throwable $th) {
            Log::debug(__('Exception occured'. $th->getMessage()));
            return $this->sendError('Something went wrong!', ['message' => $th->getMessage()]);
        }   
    }
}

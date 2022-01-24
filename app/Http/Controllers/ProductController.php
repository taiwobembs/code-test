<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\UserProducts;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;

class ProductController extends Controller
{
    public function getProducts()
    {
        $products = Product::orderBy('name', 'ASC')->get();
        $products->makeHidden(['id','image']);
        return response(['data' => $products, 'message' => 'products data', 'status' => true, 'statusCode' => env('HTTP_SERVER_CODE_OK')]);
    }

    public function getProduct($id)
    {
        $product = Product::findOrFail($id);
        
        return response(['data' => $product, 'message' => 'get product by id!', 'status' => true, 'statusCode' => env('HTTP_SERVER_CODE_OK')]);
    }

    public function addProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required'
        ]);

        if ($validator->fails()) {
            return response(['message' => 'Validation errors', 'errors' => $validator->errors(), 'status' => false], 422);
        }

        $input = $request->all();
        $name = $input['name'];
        $description = $input['description'];
        $price = $input['price'];

        $productObj = Product::create([
            'name'      => $name,
            'description'   => $description,
            'price'  => $price,
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now()
        ]);

        $saved = $productObj->save();

        if ($saved) {
            return response(['data' => [
                'name' => $name,
                'description' => $description,
                'price' => $price,
            ], 'message' => 'Product created!', 'status' => true, 'statusCode' => env('HTTP_SERVER_CODE_CREATED')]);
        } else {
            return response(['data' => [
                'name' => $name,
                'description' => $description,
                'price' => $price,
            ], 'message' => "unable to create Product, something went wrong.", 'status' => false, 'statusCode' => env('HTTP_SERVER_CODE_BAD_REQUEST')]);
        }
    }

    public function updateProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return response(['message' => 'Validation errors', 'errors' => $validator->errors(), 'status' => false], env('HTTP_SERVER_CODE_UNPROCESSABLE_ENTITY') );
        }

        $input = $request->all();
        $id = $input['id'];
        $name = $input['name'];
        $description = $input['description'];
        $price = $input['price'];

        $productObj = Product::findOrFail($id);
        $productObj->name = $name;
        $productObj->description = $description;
        $productObj->price= $price;
        $productObj->updated_at = Carbon::now();
        $saved = $productObj->save();

        if ($saved) {
            return response(['data' => [
                'name' => $name,
                'description' => $description,
                'price' => $price,
            ], 'message' => 'Product updated!', 'status' => true, 'statusCode' => env('HTTP_SERVER_CODE_CREATED')]);
        } else {
            return response(['data' => [
                'name' => $name,
                'description' => $description,
                'price' => $price,
            ], 'message' => "unable to update Product, something went wrong.", 'status' => false, 'statusCode' => env('HTTP_SERVER_CODE_BAD_REQUEST')]);
        }
    }

    public function uploadProductImage(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id'    => 'required'
        ]);

        if ($validator->fails()) {
            return response(['message' => 'Validation errors', 'errors' => $validator->errors(), 'status' => false], 422);
        }

        $validator = Validator::make($request->file(), [
            'image' => 'required'
        ]);

        if ($validator->fails()) {
            return response(['message' => 'Validation errors', 'errors' => $validator->errors(), 'status' => false], 422);
        }

        $image = $request->file('image');
        $extension = $image->extension();
        $name = time() . "." . $extension;

        $image->storeAs('public', $name);
        $name = URL::asset('storage/'.$name); 

        $input = $request->all();
        $id = $input['id'];

        $productObj = Product::findOrFail($id);
        $productObj->image = $name;
        $productObj->updated_at = Carbon::now();
        $saved = $productObj->save();

        if ($saved) {
            return response(['data' => [
                'image' => $name,
            ], 'message' => 'Product updated!', 'status' => true, 'statusCode' => env('HTTP_SERVER_CODE_CREATED')]);
        } else {
            return response(['data' => [
                'image' => $name,
            ], 'message' => "unable to update Product, something went wrong.", 'status' => false, 'statusCode' => env('HTTP_SERVER_CODE_BAD_REQUEST')]);
        }
    }

    public function deleteProduct($id)
    {
        $resultSet = Product::find($id);
        if(!empty($resultSet)){
            Product::findOrFail($id)->delete();
            return response(['data' => [], 'message' => 'Deleted Successfully', 'status' => true, 'statusCode' => env('HTTP_SERVER_CODE_OK')]);
        }else{
            return response(['data' => [], 'message' => 'ID does not exit', 'status' => true, 'statusCode' => env('HTTP_SERVER_CODE_BAD_REQUEST')]);
        }
    }

    public function addProductToUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'product_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response(['message' => 'Validation errors', 'errors' => $validator->errors(), 'status' => false], 422);
        }

        $input = $request->all();
        $user_id = $input['user_id'];
        $product_id = $input['product_id'];


        $userObj = User::findOrFail($user_id);

        $userProductsObj = UserProducts::create([
            'user_id'      => $userObj->id,
            'product_id'   => $product_id,
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now()
        ]);

        $saved = $userProductsObj->save();

        if ($saved) {
            return response(['data' => [
                'user_id'      => $user_id,
                'product_id'   => $product_id,
            ], 'message' => 'Product are been added to user!', 'status' => true, 'statusCode' => env('HTTP_SERVER_CODE_CREATED')]);
        } else {
            return response(['data' => [
                'user_id'      => $user_id,
                'product_id'   => $product_id,
            ], 'message' => "unable to add product to user Product, something went wrong.", 'status' => false, 'statusCode' => env('HTTP_SERVER_CODE_BAD_REQUEST')]);
        }
    }

    public function removeProductToUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'product_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response(['message' => 'Validation errors', 'errors' => $validator->errors(), 'status' => false], 422);
        }

        $input = $request->all();
        $user_id = $input['user_id'];
        $product_id = $input['product_id'];


        $userObj = User::find($user_id);
        $productObj = Product::find($product_id);

        if(!empty($userObj) && !empty($productObj)){
            $status = Product::findOrFail($product_id)->delete();
            return response(['data' => [], 'message' => 'Product has been removed Successfull', 'status' => true, 'statusCode' => env('HTTP_SERVER_CODE_OK')]);
        }else{
            return response(['data' => [], 'message' => 'UserID or ProductID does not exit', 'status' => true, 'statusCode' => env('HTTP_SERVER_CODE_BAD_REQUEST')]);
        }
    }

    public function getProductsForUser($id)
    {
        $user = User::find($id);

        if(!empty($user)){
            $userProducts = UserProducts::where('user_id', $id)
                ->orderBy('product_id')
                ->get();
            
            $userProductArray = [];
            $productsArray = [];
            foreach($userProducts as $userProduct){
                array_push($userProductArray,$userProduct->product_id);

                $products = Product::where('id',$userProductArray)->orderBy('name', 'ASC')->get();
                $products->makeHidden(['id','image']);
                array_push($productsArray,$products);
            }

            return response(['data' => $productsArray, 'message' => 'products data', 'status' => true, 'statusCode' => env('HTTP_SERVER_CODE_OK')]);    
        }else{
            return response(['data' => [], 'message' => 'UserID does not exit', 'status' => true, 'statusCode' => env('HTTP_SERVER_CODE_BAD_REQUEST')]);
        }   
    }
}

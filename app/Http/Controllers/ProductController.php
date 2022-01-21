<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;

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

    public function createAccount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'telephone' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return response(['message' => 'Validation errors', 'errors' => $validator->errors(), 'status' => false], 422);
        }

        $input = $request->all();
        $status = $input['status'];
        $telephone = $input['telephone'];
        $first_name = $input['first_name'];
        $last_name = $input['last_name'];
        $email = $input['email'];

        $accountManagerObj = AccountManager::create([
            'status'      => $status,
            'telephone'   => $telephone,
            'first_name'  => $first_name,
            'last_name'  => $last_name,
            'email' => $email,
            'created_at'  => Carbon::now(),
            'updated_at'  => Carbon::now()
        ]);

        $saved = $accountManagerObj->save();

        if ($saved) {
            return response(['data' => [
                'status' => $status,
                'first_name' => $first_name,
                'email' => $email,
            ], 'message' => 'Account Manager created!', 'status' => true, 'statusCode' => env('HTTP_SERVER_CODE_CREATED')]);
        } else {
            return response(['data' => [
                'status' => $status,
                'first_name' => $first_name,
                'email' => $email,
            ], 'message' => "unable to create Account Manager, something went wrong.", 'status' => false, 'statusCode' => env('HTTP_SERVER_CODE_BAD_REQUEST')]);
        }
    }

    public function updateAccount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'telephone' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'status' => 'required',
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return response(['message' => 'Validation errors', 'errors' => $validator->errors(), 'status' => false], env('HTTP_SERVER_CODE_UNPROCESSABLE_ENTITY') );
        }

        $input = $request->all();
        $id = $input['id'];
        $status = $input['status'];
        $telephone = $input['telephone'];
        $first_name = $input['first_name'];
        $last_name = $input['last_name'];
        $email = $input['email'];

        $accountManagerObj = AccountManager::findOrFail($id);
        $accountManagerObj->telephone = $telephone;
        $bankObj->first_name = $first_name;
        $bankObj->status = $status;
        $bankObj->last_name = $last_name;
        $bankObj->email = $email;
        $bankObj->updated_at = Carbon::now();
        $saved = $bankObj->save();

        if ($saved) {
            return response(['data' => [
                'first_name' => $first_name,
                'email' => $email,
                'status' => $status,
            ], 'message' => 'AccountManager updated!', 'status' => true, 'statusCode' => env('HTTP_SERVER_CODE_CREATED')]);
        } else {
            return response(['data' => [
                'name' => $name,
                'status' => $status,
                'status' => $status,
            ], 'message' => "unable to update AccountManager, something went wrong.", 'status' => false, 'statusCode' => env('HTTP_SERVER_CODE_BAD_REQUEST')]);
        }
        $tagsObj->update($request->all());

        return response()->json($tagsObj, 200);
    }

    public function deleteAccount($id)
    {
        $resultSet = Product::find($id);
        if(!empty($resultSet)){
            Product::findOrFail($id)->delete();
            return response('Deleted Successfully', env('HTTP_SERVER_CODE_OK'));
        }else{
            return response('ID does not exit', env('HTTP_SERVER_CODE_BAD_REQUEST'));
        }
    }
}

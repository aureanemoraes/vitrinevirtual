<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\Product as ProductResource;
use Validator;

class ProductController extends BaseController

{
    public function index()
    {
        $products = Product::all();

        return $this->sendResponse(ProductResource::collection($products), 'Products retrieved successfully.');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        //return $this->sendResponse($request->all(), 'Product created successfully.');

        $validator = Validator::make($input, [
            'main_name' => 'required|max:255',
            'description' => 'max:2048',
            'price' => 'required|float',
            'payment_methods' => 'array',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input['user_id'] = auth()->user->id;

        $product = Product::create($input);

        // imagem
        $i = 0;
        if($request->hasFile('image')) {
            $images = $request->file('image');
            foreach($images as $image) {
                $input['imagename'] = time().'.'.$image->extension();
                $destinationPath = public_path('/produtos');
                $img = Image::make($image->path());
                $img->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$input['imagename']);
                $product->images()->save(new Image([
                    'path' => $input['imagename'] = time().'.'.$image->extension(),
                    'order' => $i
                ]));
                $i++;
            }
        }

        return $this->sendResponse(new ProductResource($product), 'Product created successfully.');
    }

    public function show($id)
    {
        $product = Product::find($id);

        if (is_null($product)) {
            return $this->sendError('Product not found.');
        }

        return $this->sendResponse(new ProductResource($product), 'Product retrieved successfully.');
    }

    public function update(Request $request, Product $product)
    {
        $input = $request->all();

        if(!isset($input['description'])) {
            $input['description'] = $product->description;
        }

        $validator = Validator::make($input, [
            'main_name' => 'required|max:255',
            'description' => 'max:2048',
            'price' => 'required|float',
            'payment_methods' => 'array',
        ]);


        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $product->fill($input);
        $product->save();

        return $this->sendResponse(new ProductResource($product), 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return $this->sendResponse([], 'Product deleted successfully.');
    }
}

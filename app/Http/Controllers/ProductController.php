<?php

namespace App\Http\Controllers;

use App\Models\ModelsCategory;
use App\Models\ModelsChildCategory;
use App\Models\ModelsSubCategory;
use App\ModelsProducts;
use Illuminate\Http\Request;
use Validator;
//use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
//use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function __construct()
    {

        $this->product_image_path = base_path() . '/public' . config('app.project.img_path.product_pic');
    }

    public function editProduct($id, Request $request) {

        $product = ModelsProducts::where('id', $id)->first();

        $categories = ModelsCategory::all();
        $subCategories = ModelsSubCategory::all();
        $childCategories = ModelsChildCategory::all();

        $data['product'] = $product;
        $data['categories'] = $categories;
        $data['sub_categories'] = $subCategories;
        $data['child_categories'] = $childCategories;

        return view('products.edit-product', $data);
    }

    public function deleteProduct(Request $request){
        return ModelsProducts::where('id', $request->input('id'))
            ->delete();
    }

    public function index(){
        $products = ModelsProducts::all();

        return view('products.manage-products')->with([
            'products'  => $products,
        ]);
    }

    public function manageProducts()
    {
        $products = ModelsProducts::with(['categoryDetails', 'subCategoryDetails', 'childCategoryDetails'])->get();
        $data['image_path'] = $this->product_image_path;
        $data['products'] = $products;

        $categories = ModelsCategory::all();
        $subCategories = ModelsSubCategory::all();
        $childCategories = ModelsChildCategory::all();

        $data['categories'] = $categories;
        $data['sub_categories'] = $subCategories;
        $data['child_categories'] = $childCategories;
        return view('products.manage-products', $data);
    }

    public function create()
    {
        $categories = ModelsCategory::all();
        $subCategories = ModelsSubCategory::all();
        $childCategories = ModelsChildCategory::all();

        $data['categories'] = $categories;
        $data['sub_categories'] = $subCategories;
        $data['child_categories'] = $childCategories;
        return view('products.create-product', $data);
    }

    public function storeProduct(Request $request)
    {

        try{
            $rulesArr = array();
            $rulesArr['name'] = 'required';
            $rulesArr['category'] = 'required';
            $rulesArr['sub_category'] = 'required';
            $rulesArr['child_category'] = 'required';
            $rulesArr['actual_price'] = 'required';
            $rulesArr['discounted_price'] = 'required';
            $rulesArr['color'] = 'required';
            $rulesArr['description'] = 'required';
            $rulesArr['image'] = 'required';

            $validator = Validator::make($request->all(), $rulesArr);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                $productID = $request->input('product_id');
                if ($productID != '') {
                    $product = ModelsProducts::find($request->input('product_id'));
                } else {
                    $product = new ModelsProducts();
                }

                $product->name = $request->input('name');
                $product->category = $request->input('category');
                $product->sub_category = $request->input('sub_category');
                $product->child_category = $request->input('child_category');
                $product->actual_price = $request->input('actual_price');
                $product->discounted_price = $request->input('discounted_price');
                $product->color = $request->input('color');
                $product->description = $request->input('description');

                $productPicValiator = Validator::make(array('image' => request()->image), array(
                    'image' => 'mimes:jpg,jpeg,png'
                ));

                if ($productPicValiator->passes()) {
                    $image_extension = $request->file('image')->getClientOriginalExtension();
                    $imageName = sha1(uniqid() . md5(rand()) . uniqid()) . '.' . $image_extension;
                    request()->image->move($this->product_image_path, $imageName);
                    $product->image = $imageName;


                    if($product->save()){
                        $productID != '' ? Session::flash('success', 'Product Updated successfully!') : Session::flash('success', 'Product Updated successfully!');
                        return redirect('/products');
                    } else {
                        Session::flash('error', 'Something went wrong');
                        return redirect()->back()->withErrors();
                    }
                }
            }
        } catch(\Exception $e) {
            dd($e);
        }
    }

    public function delete($id)
    {
        $res = ModelsProducts::where('id', $id)->delete();

        if($res){
            Session::flash('success', 'Product Deleted successfully!');
            return redirect('/products');
        } else {
            Session::flash('error', 'Something went wrong');
            return redirect()->back()->withErrors('products', 'df');
        }
    }

}

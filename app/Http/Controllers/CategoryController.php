<?php

namespace App\Http\Controllers;

use App\Models\ModelsCategory;
use App\Models\ModelsChildCategory;
use App\Models\ModelsSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{

    /**
     * @param Request $request
     */
    public function addCategory(Request $request){
        ModelsCategory::create([
            'name' => $request->input('name'),
            'description' => $request->input('name'),
        ]);
        Session::flash('success', 'Category created successfully!');
        return redirect()->back();
    }

    public function editCategory($id, Request $request){
        ModelsCategory::where('id', $id)
            ->update([
                'name' => $request->input('name'),
                'description' => $request->input('name'),
            ]);

        Session::flash('success', 'Category updated successfully!');
        return redirect()->back();
    }

    public function deleteCategory($id, Request $request){
        ModelsCategory::where('id', $id)
            ->delete();
        ModelsSubCategory::where('parent_id', $id)
            ->delete();

        Session::flash('success', 'Category deleted successfully!');
        return redirect()->back();
    }

    public function addSubCategory(Request $request){

        $res = ModelsSubCategory::create([
            'parent_id' => $request->input('parent_id'),
            'name' => $request->input('name'),
            'description' => $request->input('name'),
        ]);
        Session::flash('success', 'Category created successfully!');
        return redirect()->back();
    }

    public function editSubCategory($id, Request $request){
        ModelsSubCategory::where('id', $id)
            ->update([
                'name' => $request->input('name'),
                'parent_id' => $request->input('parent_id'),
                'description' => $request->input('description'),
            ]);

        Session::flash('success', 'Category updated successfully!');
        return redirect()->back();
    }

    public function deleteSubCategory($id, Request $request){

        ModelsSubCategory::where('id', $id)
            ->delete();

        Session::flash('success', 'Sub Category deleted successfully!');
        return redirect()->back();
    }

    public function addChildCategory(Request $request){
        ModelsChildCategory::create([
            'name' => $request->input('name'),
            'parent_id' => $request->input('parent_id'),
            'description' => $request->input('description'),
        ]);

        Session::flash('success', 'Child Category created successfully!');
        return redirect()->back();
    }

    public function editChildCategory($id, Request $request){
        ModelsChildCategory::where('id', $id)
            ->update([
                'name' => $request->input('name'),
                'parent_id' => $request->input('parent_id'),
                'description' => $request->input('description'),
            ]);

        Session::flash('success', 'Child Category updated successfully!');
        return redirect()->back();
    }

    public function deleteChildCategory($id, Request $request){

        ModelsChildCategory::where('id', $id)
            ->delete();

        Session::flash('success', 'Child Category deleted successfully!');
        return redirect()->back();
    }

    public function manageCategories(){
        $categories = ModelsCategory::all();

        $subcategories = ModelsSubCategory::all();
        $childcategories = ModelsChildCategory::all();
        return view('category.manage-category')->with([
            'categories'  => $categories,
            'subcategories'  => $subcategories,
            'childcategories'  => $childcategories,
        ]);
    }

    public function getSubCategoryByParentId($parentId){

        $subCategories = ModelsSubCategory::where('parent_id', $parentId)->get();
        return [
            'categories'  => $subCategories,
        ];
    }

    public function getChildCategoryByParentId($parentId){
        $childCategories = ModelsChildCategory::where('parent_id', $parentId)->get();
        return [
            'categories'  => $childCategories,
        ];
    }

}

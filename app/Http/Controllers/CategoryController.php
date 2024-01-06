<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('category');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "title" => 'required'
        ]);

        if ($validate->passes()) {
            $category = new Category();
            $category->title = $request->title;
            $category->status = $request->status;
            $category->save();

            $data = array(
                "message" => "Category created successfully",
                "status" => true
            );

            return response()->json($data);
        }

        $data = array(
            "error" => $validate->errors(),
            "status" => false
        );

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::where('id', $id)->first();
        $data = array(
            "data" => $category
        );
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = Validator::make($request->all(), [
            "title" => 'required'
        ]);

        if ($validate->passes()) {
            $category = Category::where('id', $id)->first();
            $category->title = $request->title;
            $category->status = $request->status;
            $category->save();

            $data = array(
                "message" => "Category updated successfully",
                "status" => true
            );

            return response()->json($data);
        }

        $data = array(
            "error" => $validate->errors(),
            "status" => false
        );

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $category = Category::where('id', $id)->first();
        $category->delete();
        $data = array(
            "message" => "Category deleted successfully",
        );
        return response()->json($data);
    }

    public function fetchAllCategory()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        $data = array(
            "data" => $categories
        );
        return response()->json($data);
    }
}

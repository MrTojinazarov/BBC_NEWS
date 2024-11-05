<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all = Category::orderBy('id', 'desc')->paginate(10);
        return view('admin.category', ['categories' => $all]);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(CategoryRequest $request)
    {
        // Ma'lumotlarni saqlash
        $category = new Category();
        $category->name = $request->name;
        $category->is_active = $request->is_active ?? 0;
        $category->save();

        // Muvaffaqiyatli xabar
        return redirect()->route('category.index')->with('success', 'Category created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(CategoryRequest $request, Category $category)
    {
        $category->name = $request->name;
        $category->is_active = $request->is_active ?? 0;
        $category->save();

        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */

    public function delete(Category $category)
    {
        $category->delete();
        return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
    }
}

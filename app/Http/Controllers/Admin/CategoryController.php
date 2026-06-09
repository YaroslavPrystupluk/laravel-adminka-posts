<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::query()->paginate();

        return view('admin.category.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'max:255'],
            'meta_desc' => ['max:255'],
        ]);

        Category::query()->create($validated);
        return redirect()->route('categories.index')->with('success', 'Create category is successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::query()->findOrFail($id);
        return view('admin.category.create', ['categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $categories = Category::query()->findOrFail($id);
        $validated = $request->validate([
            'title' => ['required', 'max:255'],
            'meta_desc' => ['max:255'],
        ]);

        $categories->update($validated);

        return redirect()->route('categories.index')->with('success', 'Update category is successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categories = Category::query()->findOrFail($id);
        $categories->delete();
        return redirect()->route('categories.index')->with('success', 'Delete category is successfully');
    }
}

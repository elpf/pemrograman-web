<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category; // Import Category model
use Illuminate\Support\Facades\Validator; // Import Validator
use App\Http\Resources\CategoryResource; // Resource untuk response

class CategoryController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        // Get all categories with pagination
        $categories = Category::latest()->paginate(5);

        // Return collection of categories as a resource
        return new CategoryResource(true, 'List Data Categories', $categories);
    }

    /**
     * store
     *
     * @param  Request $request
     * @return void
     */
    public function store(Request $request)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:categories',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create category
        $category = Category::create([
            'name' => $request->name,
        ]);

        // Return response
        return new CategoryResource(true, 'Data Category Berhasil Ditambahkan!', $category);
    }

    /**
     * show
     *
     * @param  int $id
     * @return void
     */
    public function show($id)
    {
        // Find category by ID
        $category = Category::find($id);

        // Check if category exists
        if (!$category) {
            return response()->json(['message' => 'Data Category Tidak Ditemukan'], 404);
        }

        // Return single category as a resource
        return new CategoryResource(true, 'Detail Data Category!', $category);
    }

    /**
     * update
     *
     * @param  Request $request
     * @param  int $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Find category by ID
        $category = Category::find($id);

        // Check if category exists
        if (!$category) {
            return response()->json(['message' => 'Data Category Tidak Ditemukan'], 404);
        }

        // Update category
        $category->update([
            'name' => $request->name,
        ]);

        // Return response
        return new CategoryResource(true, 'Data Category Berhasil Diubah!', $category);
    }

    /**
     * destroy
     *
     * @param  int $id
     * @return void
     */
    public function destroy($id)
    {
        // Find category by ID
        $category = Category::find($id);

        // Check if category exists
        if (!$category) {
            return response()->json(['message' => 'Data Category Tidak Ditemukan'], 404);
        }

        // Delete category
        $category->delete();

        // Return response
        return new CategoryResource(true, 'Data Category Berhasil Dihapus!', null);
    }
}

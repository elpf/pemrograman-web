<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimoni; // Import Testimoni model
use Illuminate\Support\Facades\Validator; // Import Validator
use App\Http\Resources\TestimoniResource; // Resource untuk response

class TestimoniController extends Controller
{
    /**
     * index
     */
    public function index()
    {
        $testimonies = Testimoni::latest()->paginate(5);
        return new TestimoniResource(true, 'List Data Testimonies', $testimonies);
    }

    /**
     * store
     */
    public function store(Request $request)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id', // Pastikan category_id valid
            'user_id'     => 'required|exists:users,id', // Pastikan user_id valid
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create testimony
        $testimony = Testimoni::create([
            'name'        => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'user_id'     => $request->user_id,
        ]);

        return new TestimoniResource(true, 'Data Testimony Berhasil Ditambahkan!', $testimony);
    }

    /**
     * show
     */
    public function show($id)
    {
        $testimony = Testimoni::find($id);

        if (!$testimony) {
            return response()->json(['message' => 'Data Testimony Tidak Ditemukan'], 404);
        }

        return new TestimoniResource(true, 'Detail Data Testimony!', $testimony);
    }

    /**
     * update
     */
    public function update(Request $request, $id)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id', // Pastikan category_id valid
            'user_id'     => 'required|exists:users,id', // Pastikan user_id valid
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $testimony = Testimoni::find($id);

        if (!$testimony) {
            return response()->json(['message' => 'Data Testimony Tidak Ditemukan'], 404);
        }

        $testimony->update([
            'name'        => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'user_id'     => $request->user_id,
        ]);

        return new TestimoniResource(true, 'Data Testimony Berhasil Diubah!', $testimony);
    }

    /**
     * destroy
     */
    public function destroy($id)
    {
        $testimony = Testimoni::find($id);

        if (!$testimony) {
            return response()->json(['message' => 'Data Testimony Tidak Ditemukan'], 404);
        }

        $testimony->delete();

        return new TestimoniResource(true, 'Data Testimony Berhasil Dihapus!', null);
    }
}

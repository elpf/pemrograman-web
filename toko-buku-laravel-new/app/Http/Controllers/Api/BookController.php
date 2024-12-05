<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * index
     */
    public function index()
    {
        $books = Book::latest()->paginate(5);
        return new BookResource(true, 'List Data Books', $books);
    }

    /**
     * store
     */
    public function store(Request $request)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title'       => 'required',
            'author'      => 'required',
            'description' => 'required',
            'genre'       => 'required',
            'price'       => 'required|numeric',
            'category_id' => 'required|exists:categories,id', // Ensure category exists
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Upload image
        $image = $request->file('image');
        $image->storeAs('public/books', $image->hashName());

        // Create book
        $book = Book::create([
            'image'       => $image->hashName(),
            'title'       => $request->title,
            'author'      => $request->author,
            'description' => $request->description,
            'genre'       => $request->genre,
            'price'       => $request->price,
            'category_id' => $request->category_id,
        ]);

        return new BookResource(true, 'Data Book Berhasil Ditambahkan!', $book);
    }

    /**
     * update
     */
    public function update(Request $request, $id)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'title'       => 'required',
            'author'      => 'required',
            'description' => 'required',
            'genre'       => 'required',
            'price'       => 'required|numeric',
            'category_id' => 'required|exists:categories,id', // Ensure category exists
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Find book by ID
        $book = Book::find($id);

        // Check if image is not empty
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/books', $image->hashName());

            // Delete old image
            Storage::delete('public/books/' . basename($book->image));

            // Update book with new image
            $book->update([
                'image'       => $image->hashName(),
                'title'       => $request->title,
                'author'      => $request->author,
                'description' => $request->description,
                'genre'       => $request->genre,
                'price'       => $request->price,
                'category_id' => $request->category_id,
            ]);
        } else {
            // Update book without image
            $book->update([
                'title'       => $request->title,
                'author'      => $request->author,
                'description' => $request->description,
                'genre'       => $request->genre,
                'price'       => $request->price,
                'category_id' => $request->category_id,
            ]);
        }

        return new BookResource(true, 'Data Book Berhasil Diubah!', $book);
    }

    /**
     * destroy
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        Storage::delete('public/books/' . basename($book->image));
        $book->delete();
        return new BookResource(true, 'Data Book Berhasil Dihapus!', null);
    }
}

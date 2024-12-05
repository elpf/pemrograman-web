<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User; // Import User model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Import Validator
use Illuminate\Support\Facades\Hash; // Import Hash for password handling

class UserController extends Controller
{
    /**
     * index
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all users with pagination
        $users = User::latest()->paginate(5);

        // Return response
        return response()->json([
            'success' => true,
            'message' => 'List Data Users',
            'data'    => $users,
        ], 200);
    }

    /**
     * store
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors'  => $validator->errors(),
            ], 422);
        }

        // Create user
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password), // Encrypt password
        ]);

        // Return response
        return response()->json([
            'success' => true,
            'message' => 'User Created Successfully',
            'data'    => $user,
        ], 201);
    }

    /**
     * show
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Find user by ID
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User Not Found',
            ], 404);
        }

        // Return response
        return response()->json([
            'success' => true,
            'message' => 'User Details',
            'data'    => $user,
        ], 200);
    }

    /**
     * update
     *
     * @param  Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Find user by ID
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User Not Found',
            ], 404);
        }

        // Define validation rules
        $validator = Validator::make($request->all(), [
            'name'     => 'sometimes|string|max:255',
            'email'    => 'sometimes|email|unique:users,email,' . $user->id,
            'password' => 'sometimes|string|min:6|confirmed',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors'  => $validator->errors(),
            ], 422);
        }

        // Update user
        $user->update([
            'name'     => $request->name ?? $user->name,
            'email'    => $request->email ?? $user->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        // Return response
        return response()->json([
            'success' => true,
            'message' => 'User Updated Successfully',
            'data'    => $user,
        ], 200);
    }

    /**
     * destroy
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find user by ID
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User Not Found',
            ], 404);
        }

        // Delete user
        $user->delete();

        // Return response
        return response()->json([
            'success' => true,
            'message' => 'User Deleted Successfully',
        ], 200);
    }
}

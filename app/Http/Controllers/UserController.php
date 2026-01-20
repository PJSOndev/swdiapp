<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\City;

class UserController extends Controller
{
    /**
     * Display all users
     */
    public function index()
    {
        $users = User::all(); // Or ->paginate(10) for pagination
        $cities = City::where('psgc', 'like', '11%')->get(); // for dropdowns

        // Pass both users and cities to the view
        return view('pages.laravel-examples.user-management', compact('users', 'cities'));
    }

    /**
     * Show edit form (for AJAX/modal)
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        // Get cities for Area Assigned dropdown
        $cities = City::where('psgc', 'like', '11%')->get();

        return view('users.edit', [
            'user' => $user,
            'cities' => $cities,
        ]);
    }

    /**
     * Update user
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'role' => 'required|string',
            'area_assigned_id' => 'nullable|exists:cities,id',
        ]);

        $user = User::findOrFail($request->id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'area_assigned_id' => $request->area_assigned_id,
        ]);

        return redirect()->route('user-management')->with('success', 'User updated successfully.');
    }

    /**
     * Delete user
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user-management')->with('success', 'User deleted successfully.');
    }
}

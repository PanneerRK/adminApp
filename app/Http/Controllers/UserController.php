<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index() {
        $user = Auth::user();        
        return view('pages.edit_profile', compact('user'));
    }

    public function update(Request $request, $id) {
        $userid = $id;
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'numeric', 'digits:10'],
        ]);

        $user = User::find($userid);
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->save();
        
        return redirect()->back()->with('success', 'Profile updated successfully');   
    }
}

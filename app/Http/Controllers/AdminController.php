<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SupabaseService;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    protected $supabase;

    public function __construct(SupabaseService $supabase)
    {
        $this->supabase = $supabase;
    }

    public function dashboard()
    {
        // Simple stats for now
        return view('dashboard');
    }

    public function users()
    {
        $token = session('supabase_access_token');
        $response = $this->supabase->from('profiles', $token)->select('*')->get();
        $users = $response->successful() ? $response->json() : [];

        return view('admin.users.index', compact('users'));
    }

    public function createUser()
    {
        return view('admin.users.create');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
            'full_name' => 'required|string|max:255',
            'role' => 'required|in:user,agent,admin',
        ]);

        $authResponse = $this->supabase->auth()->signUp($request->email, $request->password, [
            'full_name' => $request->full_name,
            'role' => $request->role,
        ]);

        if (!$authResponse->successful()) {
            return back()->withErrors(['error' => 'Failed to create auth user: ' . ($authResponse->json()['msg'] ?? 'Unknown error')]);
        }

        $userData = $authResponse->json();
        $userId = $userData['id'] ?? null;

        if ($userId) {
            // Supabase Auth trigger usually handles profile, but we'll ensure it exists with correct role
            $token = session('supabase_access_token');
            $this->supabase->from('profiles', $token)->insert([
                'id' => $userId,
                'full_name' => $request->full_name,
                'role' => $request->role,
            ]);
        }

        return redirect()->route('admin.users')->with('success', 'User created successfully.');
    }

    public function editUser($id)
    {
        $token = session('supabase_access_token');
        $response = $this->supabase->from('profiles', $token)->eq('id', $id)->select('*')->get();

        if (!$response->successful() || empty($response->json())) {
            return redirect()->route('admin.users')->with('error', 'User not found.');
        }

        $user = $response->json()[0];
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'role' => 'required|in:user,agent,admin',
        ]);

        $token = session('supabase_access_token');
        $response = $this->supabase->from('profiles', $token)
            ->eq('id', $id)
            ->update([
                'full_name' => $request->full_name,
                'role' => $request->role,
            ]);

        if ($response->successful()) {
            return redirect()->route('admin.users')->with('success', 'User updated successfully.');
        }

        return back()->with('error', 'Failed to update user.');
    }

    public function deleteUser($id)
    {
        // Safety: Don't let users delete themselves
        if ($id === Auth::user()->id) {
            return back()->with('error', 'You cannot delete yourself.');
        }

        $token = session('supabase_access_token');
        $response = $this->supabase->from('profiles', $token)->eq('id', $id)->delete();

        if ($response->successful()) {
            return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
        }

        return back()->with('error', 'Failed to delete user.');
    }

    public function properties()
    {
        $token = session('supabase_access_token');
        // Fetch properties, optionally filter by status if needed
        $response = $this->supabase->from('properties', $token)->select('*, profiles:agent_id(full_name, email)')->get();
        // Note: Supabase join syntax might differ, doing simple fetch for now and we can refine based on response
        // For simplicity, let's just fetch properties. Join support in simple REST service depends on key constraints.

        $response = $this->supabase->from('properties', $token)->select('*')->get();
        $properties = $response->successful() ? $response->json() : [];

        return view('admin.properties.index', compact('properties'));
    }

    public function approveProperty($id)
    {
        $token = session('supabase_access_token');
        $this->supabase->from('properties', $token)
            ->eq('id', $id)
            ->update(['status' => 'available']); // or 'approved' depending on enum

        return back()->with('success', 'Property approved.');
    }

    public function rejectProperty($id)
    {
        $token = session('supabase_access_token');
        $this->supabase->from('properties', $token)
            ->eq('id', $id)
            ->update(['status' => 'rejected']);

        return back()->with('success', 'Property rejected.');
    }

    public function deleteProperty($id)
    {
        $token = session('supabase_access_token');
        $this->supabase->from('properties', $token)
            ->eq('id', $id)
            ->delete();

        return back()->with('success', 'Property deleted.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SupabaseService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PropertyController extends Controller
{
    protected $supabase;

    public function __construct(SupabaseService $supabase)
    {
        $this->supabase = $supabase;
    }

    public function index()
    {
        // Fetch properties from Supabase
        $response = $this->supabase->from('properties')->select('*')->get();
        $properties = $response->json();

        if (!$response->successful()) {
            $properties = [];
            Log::error('Failed to fetch properties', ['error' => $response->body()]);
        }

        return view('properties.index', compact('properties'));
    }

    public function create()
    {
        return view('properties.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'location' => 'required|string',
            'property_type' => 'required|string',
            'status' => 'required|in:available,rented,sold',
            'image' => 'nullable|image|max:2048', // 2MB Max
        ]);

        $imageUrl = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->getRealPath();

            // Upload to Supabase Storage
            // Note: SupabaseService needs a method for storage upload
            // For now, we'll try to add a storage method to the service or use raw HTTP
            $imageUrl = $this->uploadImage($file, $filename);
        }

        $data = [
            'title' => $validated['title'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'location' => $validated['location'],
            'property_type' => $validated['property_type'],
            'status' => $validated['status'],
            'agent_id' => Auth::id(), // Ensure user is logged in
            'images' => $imageUrl ? [$imageUrl] : [],
        ];

        $token = session('supabase_access_token');
        $response = $this->supabase->from('properties', $token)->insert($data);

        if ($response->successful()) {
            return redirect()->route('dashboard')->with('success', 'Property listed successfully!');
        }

        return back()->with('error', 'Failed to create listing: ' . $response->body());
    }

    public function show($id)
    {
        $response = $this->supabase->from('properties')
            ->select('*')
            ->eq('id', $id)
            ->get();

        $property = collect($response->json())->first();

        if (!$property) {
            abort(404);
        }

        return view('properties.show', compact('property'));
    }

    protected function uploadImage($file, $filename)
    {
        // Simple implementation for Storage upload using the Service key
        // POST /storage/v1/object/{bucket}/{path}
        $url = $this->supabase->url . '/storage/v1/object/property-images/' . $filename;

        $token = session('supabase_access_token');

        $response = \Illuminate\Support\Facades\Http::withHeaders([
            'Authorization' => 'Bearer ' . ($token ?? $this->supabase->key),
            'Content-Type' => $file->getMimeType(),
        ])->withBody(
                file_get_contents($file->getRealPath()),
                $file->getMimeType()
            )->post($url);

        if ($response->successful()) {
            // Return public URL
            return $this->supabase->url . '/storage/v1/object/public/property-images/' . $filename;
        }

        Log::error('Image upload failed', ['error' => $response->body()]);
        return null;
    }
}

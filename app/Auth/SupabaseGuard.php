<?php

namespace App\Auth;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Session;
use App\Services\SupabaseService;
use App\Models\SupabaseUser;

class SupabaseGuard implements Guard
{
    protected $service;
    protected $user;

    public function __construct(SupabaseService $service)
    {
        $this->service = $service;
    }

    public function check()
    {
        return !is_null($this->user());
    }

    public function guest()
    {
        return !$this->check();
    }

    public function user()
    {
        if ($this->user) {
            return $this->user;
        }

        $token = Session::get('supabase_access_token');
        if (!$token) {
            return null;
        }

        $response = $this->service->auth()->getUser($token);

        if ($response->successful()) {
            $data = $response->json();

            // Fetch Profile for Role
            $profileResponse = $this->service->from('profiles', $token)->select('*')->eq('id', $data['id'])->get();

            if ($profileResponse->successful()) {
                $profiles = $profileResponse->json();
                $profile = is_array($profiles) ? collect($profiles)->first() : null;

                if ($profile && is_array($profile)) {
                    $data = array_merge($data, $profile);
                }
            }

            $this->user = new SupabaseUser($data);
            return $this->user;
        }

        return null;
    }

    public function id()
    {
        return $this->user() ? $this->user()->getAuthIdentifier() : null;
    }

    public function validate(array $credentials = [])
    {
        $email = $credentials['email'] ?? '';
        $password = $credentials['password'] ?? '';

        $response = $this->service->auth()->signIn($email, $password);

        if ($response->successful()) {
            $data = $response->json();
            Session::put('supabase_access_token', $data['access_token']);
            Session::put('supabase_refresh_token', $data['refresh_token']);
            $this->user = $this->user();
            return true;
        }

        return false;
    }

    public function hasUser()
    {
        return !is_null($this->user);
    }

    public function setUser(Authenticatable $user)
    {
        $this->user = $user;
        return $this;
    }

    // Logout
    public function logout()
    {
        Session::forget('supabase_access_token');
        Session::forget('supabase_refresh_token');
        $this->user = null;
    }
}

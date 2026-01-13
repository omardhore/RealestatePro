<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SupabaseService
{
    public $url;
    public $key;

    public function __construct()
    {
        $this->url = rtrim(config('supabase.url'), '/');
        $this->key = config('supabase.key');
    }

    public function headers($token = null)
    {
        $headers = [
            'apikey' => $this->key,
            'Authorization' => 'Bearer ' . ($token ?? $this->key),
            'Content-Type' => 'application/json',
            'Prefer' => 'return=representation',
        ];
        return $headers;
    }

    public function auth()
    {
        return new class ($this) {
            protected $service;
            public function __construct($service)
            {
                $this->service = $service;
            }

            public function signUp($email, $password, $data = [])
            {
                return Http::withHeaders($this->service->headers())
                    ->post($this->service->url . '/auth/v1/signup', [
                        'email' => $email,
                        'password' => $password,
                        'data' => $data,
                    ]);
            }

            public function signIn($email, $password)
            {
                return Http::withHeaders($this->service->headers())
                    ->post($this->service->url . '/auth/v1/token?grant_type=password', [
                        'email' => $email,
                        'password' => $password,
                    ]);
            }

            public function getUser($token)
            {
                return Http::withHeaders($this->service->headers($token))
                    ->get($this->service->url . '/auth/v1/user');
            }
        };
    }

    public function from($table, $token = null)
    {
        return new class ($this, $table, $token) {
            protected $service;
            protected $table;
            protected $token;
            protected $query = [];

            public function __construct($service, $table, $token)
            {
                $this->service = $service;
                $this->table = $table;
                $this->token = $token;
            }

            public function select($columns = '*')
            {
                $this->query['select'] = $columns;
                return $this;
            }

            public function eq($column, $value)
            {
                $this->query[$column] = 'eq.' . $value;
                return $this;
            }

            public function get()
            {
                $queryString = http_build_query($this->query);
                return Http::withHeaders($this->service->headers($this->token))
                    ->get($this->service->url . '/rest/v1/' . $this->table . '?' . $queryString);
            }

            public function insert($data)
            {
                return Http::withHeaders($this->service->headers($this->token))
                    ->post($this->service->url . '/rest/v1/' . $this->table, $data);
            }

            public function update($data)
            {
                $queryString = http_build_query($this->query);
                return Http::withHeaders($this->service->headers($this->token))
                    ->patch($this->service->url . '/rest/v1/' . $this->table . '?' . $queryString, $data);
            }

            public function delete()
            {
                $queryString = http_build_query($this->query);
                return Http::withHeaders($this->service->headers($this->token))
                    ->delete($this->service->url . '/rest/v1/' . $this->table . '?' . $queryString);
            }
        };
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SupabaseService;

class KnowledgeBaseController extends Controller
{
    protected $supabase;

    public function __construct(SupabaseService $supabase)
    {
        $this->supabase = $supabase;
    }

    public function index()
    {
        $response = $this->supabase->from('kb_articles')->select('*')->get();
        $articles = $response->successful() ? $response->json() : [];

        return view('kb.index', compact('articles'));
    }

    public function show($id)
    {
        $response = $this->supabase->from('kb_articles')
            ->select('*')
            ->eq('id', $id)
            ->get();

        $article = collect($response->json())->first();

        if (!$article) {
            abort(404);
        }

        return view('kb.show', compact('article'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.form', ['article' => new Article]);
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        $data['author_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')
                                     ->store('articles','public');
        }

        Article::create($data);
        return redirect()->route('articles.index')
                         ->with('status','Artikel berhasil ditambahkan.');
    }

    public function edit(Article $article)
    {
        return view('admin.articles.form', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $data = $this->validatedData($request,$article->id);

        if ($request->hasFile('image')) {
            if ($article->image) Storage::disk('public')->delete($article->image);
            $data['image'] = $request->file('image')
                                     ->store('articles','public');
        }

        $article->update($data);
        return back()->with('status','Artikel diperbarui.');
    }

    public function destroy(Article $article)
    {
        if ($article->image) Storage::disk('public')->delete($article->image);
        $article->delete();
        return back()->with('status','Artikel dihapus.');
    }

    /** helper */
    private function validatedData(Request $request, $ignore=null)
    {
        $data = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'category' => 'required|string',
            'image' => 'nullable|image',
            'published_at' => 'nullable|date',
        ]);

        /* slug unik */
        $slug = Str::slug($data['title']);
        $exists = Article::where('slug',$slug)
                         ->when($ignore, fn($q)=>$q->where('id','!=',$ignore))
                         ->exists();
        if ($exists) $slug .= '-'.uniqid();
        $data['slug'] = $slug;

        return $data;
    }
}

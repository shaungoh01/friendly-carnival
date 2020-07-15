<?php

namespace App\Http\Controllers;

use App\Article;
use App\User;
use Illuminate\Http\Request;
use App\Facades\Article as ArticleFacade;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Article::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $articles = Article::query();
        if($request->has("title")){
            $articles->where("title","LIKE","%".$request->title."%");
        }
        $articles = $articles->paginate(20);
        if($request->has("format") && $request->format=="array"){
            $articles = $articles->pluck("title");
            return response($articles,200);
        }
        return view("articles.index",compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("articles.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate
        $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);
        //save article
        $article = new Article;
        $article->title = $request->title;
        $article->body = $request->body;
        $article->creator_id = \Auth::id();
        $article->save();
        // attach article to users and admin
        $admin_id = User::where("name","admin")->firstOrFail()->id;
        $article->users()->attach([
            $admin_id => ["status"=>"approved"],
            \Auth::id() => ["status"=>"approved"]
        ]);

        return redirect("/home");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view("articles.show",compact("article"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('articles.edit',compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $article->title = $request->title;
        $article->body = $request->body;
        $article->creator_id = \Auth::id();
        $article->save();
        return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect("/home");
    }

    public function requestCollab(Article $article)
    {
        ArticleFacade::requestCollaborate($article,\Auth::id());
        return back();
    }

    public function approveCollab(Article $article)
    {
        ArticleFacade::approveCollaborate($article,request()->user_id);
        return back();
    }
}

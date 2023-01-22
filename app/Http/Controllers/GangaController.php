<?php

namespace App\Http\Controllers;

use App\Http\Requests\GangaRequest;
use App\Models\Category;
use App\Models\Ganga;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GangaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $gangas = Ganga::orderBy('title','ASC')->paginate(4);
        return view('gangas.index',compact('gangas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Category::get();
        return view('gangas.create',compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GangaRequest $request)
    {
        $ganga = new Ganga();
        $ganga->title = $request->title;
        $ganga->description = $request->descripcion;
        $ganga->url = $request->url;
        $ganga->category = $request->categorias;
        $ganga->price = $request->precio;
        $ganga->price_sale = $request->precio_salida;
        $ganga->likes = 0;
        $ganga->unlikes = 0;
        $ganga->available = $request->disponible ? 1 : 0;
        $ganga->user_id = Auth::id();
        $ganga->save();
        $idGanga = $ganga->id;
        if ($request->imagen) {
            $request->imagen->storeAs('public/img', $idGanga.'-ganga-severa.jpg');
        }
        return redirect()->route('gangas.show',$idGanga);
    }

    /**
     * Display the specified resource.
     *
     * @param    $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $ganga = Ganga::findOrFail($id);
        return view('gangas.show',compact('ganga'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ganga  $ganga
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ganga = Ganga::findOrFail($id);
        $categorias = Category::get();
        return view('gangas.edit',compact('ganga','categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ganga  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GangaRequest $request,$id)
    {
        $ganga = Ganga::findOrFail($id);
        $ganga->title = $request->title;
        $ganga->description = $request->descripcion;
        $ganga->url = $request->url;
        $ganga->category = $request->categorias;
        $ganga->price = $request->precio;
        $ganga->price_sale = $request->precio_salida;
        $ganga->available = $request->disponible ? 1 : 0;
        if ($request->imagen) {
            $request->imagen->storeAs('public/img', $id.'-ganga-severa.jpg');
        }
        $ganga->save();
        return redirect()->route('gangas.show',$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $ganga = Ganga::findOrFail($id);
        $ganga->likesTable->each->delete();
        $ganga->delete();
        return redirect()->route('gangas.index');
    }

    public function doLike($id) {
        $ganga = Ganga::findOrFail($id);
        $like = Like::where([['user_id', Auth::user()->id],['ganga_id',$ganga->id]])->first();
        if ($like) {
            if ($like->like >= 1) {
                return redirect()->route('gangas.show',$id);
            }else if ($like->dislike === 1) {
                $like->dislike = 0;
                $like->like = 1;
                $ganga->likes += 1;
                $ganga->unlikes -= 1;
                $ganga->save();
                $like->save();
                return redirect()->route('gangas.show',$id);
            }
        }
        $like = new Like();
        $like->like = 1;
        $ganga->likes += 1;
        $like->user_id = Auth::id();
        $like->ganga_id = $ganga->id;
        $like->save();
        $ganga->save();
        return redirect()->route('gangas.show',$id);
    }

    public function doUnlike($id) {
        $ganga = Ganga::findOrFail($id);
        $like = Like::where([['user_id', Auth::user()->id],['ganga_id',$ganga->id]])->first();
        if ($like) {
            if ($like->dislike >= 1) {
                return redirect()->route('gangas.show',$id);
            }else if ($like->like === 1) {
                $like->like = 0;
                $like->dislike = 1;
                $ganga->unlikes += 1;
                $ganga->likes -= 1;
                $ganga->save();
                $like->save();
                return redirect()->route('gangas.show',$id);
            }
        }
        $like = new Like();
        $ganga->unlikes += 1;
        $like->dislike = 1;
        $like->user_id = Auth::id();
        $like->ganga_id = $ganga->id;
        $ganga->save();
        $like->save();
        return redirect()->route('gangas.show',$id);
    }

    public function recents() {
        $gangas = Ganga::orderBy('created_at','desc')->paginate(4);
        return view('gangas.index',compact('gangas'));
    }

    public function getBestAvg() {
        $gangas = Ganga::select(DB::raw('*, (likes / (likes + unlikes)) AS avg_likes_dislikes'))->orderby('avg_likes_dislikes','DESC')->paginate(4);
        return view('gangas.index',compact('gangas'));
    }

}

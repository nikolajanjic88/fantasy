<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HeroesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd(request()->tag);
        $heroes = Hero::latest()->filter(request(['tag', 'search']))->paginate(4);
        return view('index')->with('heroes', $heroes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $formFields = $request->validate([
            'name' => ['required', 'unique:heroes'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
        //dd($formFields);

        $formFields['user_id'] = auth()->id();

        Hero::create($formFields);

        return redirect('/')->with('message', 'Hero created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Hero $hero)
    {
        //$hero = Hero::find($id); moze da bude show($id) pa da radim Hero::find($id), a moze i show(Hero $hero) i onda ne moram da radim find(), ali ruta mora biti {hero}
        if(!$hero) {
            abort(404, 'Page not found');
        }
        return view('hero')->with('hero', $hero);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Hero $hero)
    {
        if(!$hero) {
            abort(404, "Page not found");
        }
        //dd($hero);
        return view('edit')->with('hero', $hero);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hero $hero)
    {
        //samo da korisnik koji je napravio heroja moze da edituje
        if($hero->user_id != auth()->id()) {
            abort(403, 'Unauthorized action');
        }

        $formFields = $request->validate([
            'name' => 'required',
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $hero->update($formFields);

        return back()->with('message', 'Hero updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hero = Hero::find($id);
        //samo da korisnik koji je napravio heroja moze da brise
        if($hero->user_id != auth()->id()) {
            abort(403, 'Unauthorized action');
        }
        $hero->delete();
        return redirect('/')->with('message', 'Hero deleted');
    }

    public function manage() {
        return view('manage', ['heroes' => auth()->user()->heroes()->get()]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\levels;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class LevelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $levels= levels::select(
            'id',
            'name_'.LaravelLocalization::getCurrentLocale().' as name'
        )->get();
        return view('AdminPanel.levels.index',compact('levels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('AdminPanel.levels.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $data = $request->validate([
            'name_ar'=>'required',
            'name_en'=>'required',
        ]);
        levels::create($data);
        session()->flash('success',__('panel.levels.the_level_has_been_added'));
        return redirect()->route('levels.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function edit($id)
    {
        $levels= levels::find($id);
        return view('AdminPanel.levels.show',compact('levels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, levels $level)
    {
      $data= $request->validate([
            'name_ar'=>'required',
            'name_en'=>'required'
        ]);

        $level->update($data);
        session()->flash('success',__('panel.levels.this_level_has_been_edited'));
        return redirect()->route('levels.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(levels $level)
    {
        $level->delete();
        session()->flash('success',__('panel.levels.this_level_has_been_deleted'));
        return redirect()->route('levels.index');
    }
}

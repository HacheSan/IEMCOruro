<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = Activity::orderBy('id', 'desc')->get();
        return view('administrador.actividades.index',compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrador.actividades.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validacion
        /*$request->validate([
            'title'=>'required',
            'description'=>'required',
            'place'=>'required',
            'date'=>'required',
            'image'=>'required'
        ]);*/
        $actividad = Activity::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'place'=>$request->place,
            'date'=>$request->date,
            'image'=>$request->image
    
        ]);
        return redirect()->route('admin.actividades.index')->with('info', 'La actividad se creo Satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $actividad)
    {
        return view('administrador.actividades.edit', compact('actividad'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $actividad)
    {
        $actividad->update($request->all());
        return redirect()->route('admin.actividades.index')->with('info', 'Los datos de la actividad se actualizó satisfactoriamente.');
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $actividad)
    {
        $actividad->delete(); 
        return redirect()->route('admin.actividades.index')->with('info', 'La se eliminó satisfactoriamente.');  
    }
}

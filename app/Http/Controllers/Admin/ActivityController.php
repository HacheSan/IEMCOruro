<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Image;
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

    public function actividadimagen(Request $request)
    {
        try {
            $folderPath = public_path('storage/actividades/');

            $image_parts = explode(";base64,", $request->image);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);

            $imageName = uniqid() . '.png';

            $imageFullPath = $folderPath . $imageName;

            file_put_contents($imageFullPath, $image_base64);

            $saveFile = new Image();
            $saveFile->image = $imageName;
            $saveFile->save();
            $datos = array(
                'image' => $imageName
            );
            //Devolvemos el array pasado a JSON como objeto

            return json_encode($datos, JSON_FORCE_OBJECT);
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }
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
    public function edit(Activity $actividade)
    {
        return view('administrador.actividades.edit', compact('actividade'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $actividade)
    {
        $actividade->update($request->all());
        return redirect()->route('admin.actividades.index')->with('info', 'Los datos de la actividad se actualizó satisfactoriamente.');
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $actividade)
    {
        $actividade->delete(); 
        return redirect()->route('admin.actividades.index')->with('info', 'La se eliminó satisfactoriamente.');  
    }
}

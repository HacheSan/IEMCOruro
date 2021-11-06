<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = date('Y-m-d');
        $members = Member::orderBy('id', 'desc')->get();
        return view('administrador.miembros.index',compact('members','now'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrador.miembros.create');
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
        $request->validate([
            'name'=>'required|max:50',
            'surname'=>'required|max:50',
            'ci'=>'required|unique:members|max:15',
            'gender'=>'required',
            'marital_status'=>'required',
            'address'=>'required',
            'status'=>'required',
            'phone'=>'required|max:15',
            'date_of_birth'=>'required|max:15',
            //'image'=>'required',//|dimensions:min_width-150,min_height-150',
            'post'=>'required',
        ]);
        /*public function messages()
        {
            return[
                'name.requerid'=>'El campo es requerido',
                'name.max'=>'Solo permite 50 caracteres',

                'surname.requerid'=>'El campo es requerido',
                'surname.max'=>'Solo permite 50 caracteres',

                'ci.requerid'=>'El campo es requerido',
                'ci.unique'=>'la Cedula de Idnetidad ya esta registrado',
                'ci.max'=>'Solo permite 15 caracteres',
                'ci.min'=>'Solo permite 7 caracteres minimo',

                'gemder.requerid'=>'El campo es requerido',

                'marital_status.requerid'=>'El campo es requerido',

                'status.requerid'=>'El campo es requerido',

                'phone.requerid'=>'El campo es requerido',
                'phone.max'=>'Solo permite 15 caracteres',
                'phone.min'=>'Solo permite 8 caracteres minimo',

                'date_of_birth.requerid'=>'El campo es requerido',
                'date_of_birth.max'=>'Solo permite 15 caracteres',

                'image.requerid'=>'El campo es requerido',
                'image.dimensions'=>'Solo se permite imagen de 150x150',

                'post.requerid'=>'El campo es requerido',

            ];
        }*/

       $member = Member::create([
            'name'=>$request->name,
            'surname'=>$request->surname,
            'ci'=>$request->ci,
            'gender'=>$request->get('gender'),
            'marital_status'=>$request->get('marital_status'),
            'address'=>$request->address,
            'status'=>$request->get('status'),
            'phone'=>$request->phone,
            'date_of_birth'=>$request->date_of_birth,
            //'image'=>$request->image,
            'post'=>$request->post,
        ]);
        return redirect()->route('admin.miembros.index')->with('info', 'Los datos del miembro se creo Satisfactoriamente.');
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
    public function edit(Member $miembro)
    {
        return view('administrador.miembros.edit', compact('miembro'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $miembro)
    {
        $miembro->update($request->all());
        return redirect()->route('admin.miembros.index')->with('info', 'Los datos del miembro se actualizó satisfactoriamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $miembro)
    {
        $miembro->delete();
        return redirect()->route('admin.miembros.index')->with('info', 'Los datos del miembro se eliminó satisfactoriamente.');
    }
    //searchMember
    public function searchMember(Request $request){
        $findmember=Member::where('ci',$request->ci)->first();
        if($findmember){
            $data = array(
                'id'=>$findmember->id,
                'name'=>$findmember->name,
                'surname'=>$findmember->surname,
                'ci'=>$findmember->ci,
            );
            return json_encode($data, JSON_FORCE_OBJECT);
        }else{
            $data = array(
                'id'=>"0",
            );
            return json_encode($data, JSON_FORCE_OBJECT);
        }
    }
}

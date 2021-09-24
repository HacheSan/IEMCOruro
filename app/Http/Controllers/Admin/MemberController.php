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
        $members = Member::orderBy('id', 'desc')->get();
        return view('administrador.miembros.index',compact('members'));
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
            'name'=>'required',
            'surname'=>'required',
            'ci'=>'required',
            'gender'=>'required',
            'marital_status'=>'required',
            'address'=>'required',
            'status'=>'required',
            'phone'=>'required',
            'date_of_birth'=>'required',
            'image'=>'required',
            'post'=>'required',
        ]);
        
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
            'image'=>$request->image,
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
}

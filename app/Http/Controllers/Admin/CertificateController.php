<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityDetail;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $certificates = ActivityDetail::orderBy('id', 'desc')->get();
        return view('administrador.certificados.index',compact('certificates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date = date("Y-m-d");
        $activity_detail = ActivityDetail::create([
            'member_id' => $request->member_id,
            'description' => $request->description,
            'date' => $date,
            'state' => "No",
        ]);
        return redirect()->route('admin.certificados.index')->with('info', 'Se entregó el certificado Satisfactoriamente.');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $record = ActivityDetail::find($request->id);
        $record->update([
            'state' => 'Si',
        ]);
        return redirect()->route('admin.certificados.index')->with('info', 'Entregado del certificado exitosa.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActivityDetail $activitydetail)
    {
        $activitydetail->delete();
        return redirect()->route('admin.certificados.index')->with('info', 'Eliminación del certificado exitosa.');
    }
}

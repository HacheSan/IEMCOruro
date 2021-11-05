<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BoxType;
use App\Models\Economy;
use App\Models\Member;
use Illuminate\Http\Request;

class EconomyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::get();
        $boxtypes = BoxType::get();
        return view('administrador.economia.index', compact('boxtypes', 'members'));
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
        date_default_timezone_set("America/La_Paz");
        $date = date("Y-m-d");
        $time = date("H:m");
        $datetime = $date . "T" . $time;
        //
        $income_egress = 0;

        $economy = Economy::create([
            'type_id' => $request->get('type_id'),
            'member_id' => $request->get('member_id'),
            'description' => $request->description,
            'date' => $datetime,
            'income' => $request->income,
            'egress' => $request->egress,
            'total' => $income_egress
        ]);
        return redirect()->route('admin.economia.index')->with('info', 'Registro económico creado satisfactoriamente.');
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

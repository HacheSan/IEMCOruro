<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ActivityAssistance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssistanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$activity_assistances = ActivityAssistance::orderBy('id', 'desc')->get();
        $activities = Activity::orderBy('id', 'desc')->get();
        return view('administrador.asistencias.index', compact('activities')); //,compact('members')
    }
    public function tblAssistance(Request $request)
    {
        $activity_id = $request->activity_id;
        if (request()->ajax()) {
            return datatables()->of(DB::table('activity_assistances')
                ->join('members', 'activity_assistances.member_id', '=', 'members.id')
                ->where('activity_id', $activity_id)
                ->get(array(
                    'ci',
                    'name',
                    'surname',
                    'gender',
                    'member_id',
                    'activity_id'
                )))
                ->addColumn('delete', 'administrador.asistencias.delete')
                ->rawColumns(['delete'])
                ->addIndexColumn()
                ->make(true);
        }
    }
    public function destroyAssistance(Request $request)
    {
        $asistance = DB::table('activity_assistances')
            ->where('activity_id', $request->activity_id)
            ->where('member_id', $request->member_id)
            ->delete();
        return $asistance;
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
        $activity_assistances = ActivityAssistance::create([
            'activity_id' => $request->activity_id,
            'member_id' => $request->member_id,
        ]);
        return $activity_assistances;
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

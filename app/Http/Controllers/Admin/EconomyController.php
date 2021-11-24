<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BoxType;
use App\Models\Economy;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $type_in = $request->type_in;
        $income = $request->income;
        $egress = $request->egress;
        $total = Economy::where('type_id', $request->type_id)->sum('total');
        $ultimEc = Economy::where('type_id', $request->type_id)->max('id');
        $ultimTotal = Economy::where('id', $ultimEc)->first();
        if($type_in == 1){

            if($income <= 0){
                $msg=[
                    'type_id' => '0',
                    'msg'=> 'El ingreso no puede ser menor a cero bolivianos',
                ];
                return json_encode($msg, JSON_FORCE_OBJECT);
            }
            if($total == NULL){
                $economy = Economy::create([
                    'type_id' => $request->type_id,
                    'member_id' => $request->get('member_id'),
                    'description' => $request->description,
                    'date' => $datetime,
                    'income' => $income,
                    'egress' => '0',
                    'total' => $income,
                ]);

                return json_encode($economy, JSON_FORCE_OBJECT);
            }
            $economy = Economy::create([
                'type_id' => $request->type_id,
                'member_id' => $request->get('member_id'),
                'description' => $request->description,
                'date' => $datetime,
                'income' => $income,
                'egress' => '0',
                'total' => (float)$ultimTotal->total+(float)$income,
            ]);
            return json_encode($economy, JSON_FORCE_OBJECT);
        }else{
            if($egress <= 0 || $egress > $ultimTotal->total){
                $msg=[
                    'type_id' => '0',
                    'msg'=> 'La salida no puede ser menor a cero o exceder a la caja.',
                ];
                return json_encode($msg, JSON_FORCE_OBJECT);
            }
            $economy = Economy::create([
                'type_id' => $request->type_id,
                'member_id' => $request->get('member_id'),
                'description' => $request->description,
                'date' => $datetime,
                'income' => '0',
                'egress' => $egress,
                'total' => (float)$ultimTotal->total-(float)$request->egress,
            ]);
            return json_encode($economy, JSON_FORCE_OBJECT);
        }
        //return redirect()->route('admin.economia.index')->with('info', 'Registro económico creado satisfactoriamente.');
    }
    public function tblEconomy(Request $request){
        $month = $request->month;
        $year = $request->year;
        $type_id = $request->type_id;
        if (request()->ajax()) {
            return datatables()->of(DB::table('economies')
                ->join('members', 'economies.member_id', '=', 'members.id')
                ->where('type_id', $type_id)
                ->whereMonth('date', '=', $month)
                ->whereYear('date', '=', $year)
                //->where('date', '=', Carbon::now()->subMonth()->month)
                ->get(array(
                    'economies.id',
                    'name',
                    'surname',
                    'description',
                    'date',
                    'income',
                    'egress',
                    'total',
                )))
                //->addColumn('delete', 'invoice.invoices.btndeleteinvoicetedail')
                //->rawColumns(['delete'])
                //->addIndexColumn()
                ->make(true);
        }
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

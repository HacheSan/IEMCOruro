<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();
        $userb = [];
        return view('administrador.usuarios.index',compact('users','userb'));
    }
    public function search(Request $request)
    {
        try {
            $term = 'Hache';
            $querys = Member::where('name', 'LIKE', '%' . $term . '%')->get();
            //$querys = Antecedent::with('people', 'detective', 'crime', 'province')->where('arrestado', 'LIKE','%'.$term.'%')->get();
            /* $querys = DB::table('people')
            ->select('arrestado')
            ->where('arrestado', 'LIKE','%'.$term.'%'); */
            //->orWhere('ci','LIKE','%'.$term.'%');
            //return $query;
            $data = [];
            foreach ($querys as $query) {
                $data[] = [
                    'label' => $query->name //.' (CI:) '.$query->ci,
                ];
            }
            return $data;
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function buscarmiembro(Request $request){
        $miembro = $request->miembro;
        if (request()->ajax()) {
            return datatables()->of(DB::table('members')
                ->orWhere('name', 'like', '%' . $miembro . '%')
                ->get(array(
                    'id',
                    'name',
                    'surname',
                    'ci',
                    'gender'
                )))
                ->addColumn('detalle', 'administrador.usuarios.btn_opcion')
                ->rawColumns(['detalle'])
                ->addIndexColumn()
                ->make(true);
        }
    }

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
        $miembro = Member::find($request->id);
        $users = User::create([
            'name'=>$miembro->name,
            'surname'=>$miembro->surname,
            'gender'=>$miembro->gender,
            'marital_status'=>$miembro->marital_status,
            'address'=>$miembro->address,
            'status'=>$miembro->status,
            'phone'=>$miembro->phone,
            'image'=>$miembro->image,
            'email'=>$request->email,
            'password'=>Hash::make($request->email),
            'role'=>$request->role,
    
        ]);
        return redirect()->route('admin.usuarios.index')->with('info', 'El rol se asignó Satisfactoriamente.');
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Region;
use App\Province;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProvinceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('province/index');        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function json()
    {
        return datatables()->query(
            DB::table('provinces')
                ->select('provinces.*', 'regions.description as region')
                ->where('provinces.status', true)
                ->join('regions', 'regions.region_id', '=', 'provinces.region_id')
        )->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['region'] = Region::orderBy('description', 'asc')->get()->pluck('description', 'region_id');
        return view('province/create', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'region_id' => 'required',
            'description' => 'required|max:255',
            'observation' => 'max:255',
        ],[
            'region_id.required' => 'El campo Región es obligatorio.',
            'description.required' => 'El campo descripción es obligatorio.',
            'description.max' => [
                'numeric' => 'El campo descripción no debe ser mayor a :max.',
                'file'    => 'El archivo descripción no debe pesar más de :max kilobytes.',
                'string'  => 'El campo descripción no debe contener más de :max caracteres.',
                'array'   => 'El campo descripción no debe contener más de :max elementos.',
            ],
            'observation.required' => 'El campo observación es obligatorio.',
            'observation.max' => [
                'numeric' => 'El campo observación no debe ser mayor a :max.',
                'file'    => 'El archivo observación no debe pesar más de :max kilobytes.',
                'string'  => 'El campo observación no debe contener más de :max caracteres.',
                'array'   => 'El campo observación no debe contener más de :max elementos.',
            ]
        ]);
        # Request
        $region_id = $request->input('region_id');
        $description = $request->input('description');
        $observation = $request->input('observation');
        # Create
        $record = New Province;
        $record->user_id = Auth::id();
        $record->region_id = $region_id;
        $record->description = $description;
        $record->observation = $observation;
        $record->status = 1;
        $record->save();
        return redirect('/province/create')->with('success', 'Registro Guardado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $count = Province::where('province_id', $id)->count();
        if ($count>0) {
            # Show
            $data['row'] = Province::where('province_id', $id)->first();
            return view('province.show', ['data' => $data]);
        }else{
            # Error
            return redirect('/province')->with('info', 'No se puede editar el registro');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $count = Province::where('province_id', $id)->count();
        if ($count>0) {
            # Edit
            $data['region'] = Region::orderBy('description', 'asc')->get()->pluck('description', 'region_id');
            $data['row'] = Province::where('province_id', $id)->first();
            return view('province.edit', ['data' => $data]);
        }else{
            # Error
            return redirect('/province')->with('info', 'No se puede editar el registro');
        }
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
        $request->validate([
            'region_id' => 'required',
            'description' => 'required|max:255',
            'observation' => 'required|max:255',
        ],[
            'region_id.required' => 'El campo Región es obligatorio.',
            'description.required' => 'El campo descripción es obligatorio.',
            'description.max' => [
                'numeric' => 'El campo descripción no debe ser mayor a :max.',
                'file'    => 'El archivo descripción no debe pesar más de :max kilobytes.',
                'string'  => 'El campo descripción no debe contener más de :max caracteres.',
                'array'   => 'El campo descripción no debe contener más de :max elementos.',
            ],
            'observation.required' => 'El campo observación es obligatorio.',
            'observation.max' => [
                'numeric' => 'El campo observación no debe ser mayor a :max.',
                'file'    => 'El archivo observación no debe pesar más de :max kilobytes.',
                'string'  => 'El campo observación no debe contener más de :max caracteres.',
                'array'   => 'El campo observación no debe contener más de :max elementos.',
            ]
        ]);
        $count = Province::where('province_id', $id)->count();
        if ($count>0) {
            # Request
            $region_id = $request->input('region_id');
            $description = $request->input('description');
            $observation = $request->input('observation');
            # Update
            $record = Province::where('province_id', $id)->first();
            $record->user_id = Auth::id();
            $record->region_id = $region_id;
            $record->description = $description;
            $record->observation = $observation;
            $record->status = 1;
            $record->save();
            return redirect('/province/edit/'.$id)->with('success', 'Registro Guardado');
        }else{
            # Error
            return redirect('/province')->with('info', 'No se puede Editar el registro');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $count = Province::where('province_id', $id)->count();
        if ($count>0) {
            # Destroy
            Province::where('province_id', $id)->update(['status' => false]);
            return response()->json([
                'status' => '1',
                'msg' => 'success'
            ]);
        }else{
            # Error
            return response()->json([
                'status' => '0',
                'msg' => 'fail'
            ]);
        }
    }
}

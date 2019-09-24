<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\District;
use App\Province;
use App\Region;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DistrictController extends Controller
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
        return view('district/index');        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function json()
    {
        return datatables()->query(
            DB::table('districts')
                ->select('districts.*', 'provinces.description as province', 'regions.description as region')
                ->where('districts.status', true)
                ->join('provinces', 'provinces.province_id', '=', 'districts.province_id')
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
        $data['region'] = Region::where('status', true)->orderBy('description', 'asc')->get()->pluck('description', 'region_id');
        return view('district/create', ['data' => $data]);
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
            'province_id' => 'required',
            'description' => 'required|max:255',
            'observation' => 'max:255',
        ],[
            'region_id.required' => 'El campo Región es obligatorio.',
            'province_id.required' => 'El campo Provincia es obligatorio.',
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
        $province_id = $request->input('province_id');
        $description = $request->input('description');
        $observation = $request->input('observation');
        # Create
        $record = New District;
        $record->user_id = Auth::id();
        $record->province_id = $province_id;
        $record->description = $description;
        $record->observation = $observation;
        $record->status = 1;
        $record->save();
        return redirect('/district/create')->with('success', 'Registro Guardado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $count = District::where([['district_id', $id], ['status', true]])->count();
        if ($count>0) {
            # Show
            $data['row'] = District::where('district_id', $id)->first();
            return view('district.show', ['data' => $data]);
        }else{
            # Error
            return redirect('/district')->with('info', 'No se puede editar el registro');
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
        $count = District::where([['district_id', $id], ['status', true]])->count();
        if ($count>0) {
            # Edit
            $data['region'] = Region::where('status', true)->orderBy('description', 'asc')->get()->pluck('description', 'region_id');
            $data['row'] = District::where('district_id', $id)->first();
            return view('district.edit', ['data' => $data]);
        }else{
            # Error
            return redirect('/district')->with('info', 'No se puede editar el registro');
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
            'province_id' => 'required',
            'description' => 'required|max:255',
            'observation' => 'max:255',
        ],[
            'region_id.required' => 'El campo Región es obligatorio.',
            'province_id.required' => 'El campo Provincia es obligatorio.',
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
        $count = District::where([['district_id', $id], ['status', true]])->count();
        if ($count>0) {
            # Request
            $province_id = $request->input('province_id');
            $description = $request->input('description');
            $observation = $request->input('observation');
            # Update
            $record = District::where('district_id', $id)->first();
            $record->user_id = Auth::id();
            $record->province_id = $province_id;
            $record->description = $description;
            $record->observation = $observation;
            $record->status = 1;
            $record->save();
            return redirect('/district/edit/'.$id)->with('success', 'Registro Guardado');
        }else{
            # Error
            return redirect('/district')->with('info', 'No se puede Editar el registro');
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
        $count = District::where([['district_id', $id], ['status', true]])->count();
        if ($count>0) {
            # Destroy
            District::where('district_id', $id)->update(['status' => false]);
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

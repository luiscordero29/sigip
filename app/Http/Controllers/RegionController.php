<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Region;
use Illuminate\Support\Facades\Auth;

class RegionController extends Controller
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
        return view('region/index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function json()
    {
        return datatables()->of(Region::where('status', true)->get())->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('region/create');
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
            'description' => 'required|unique:regions|max:255',
        ],[
            'description.required' => 'El campo descripción es obligatorio.',
            'description.unique' => 'El valor del campo descripción ya está en uso.',
            'description.max' => [
                'numeric' => 'El campo descripción no debe ser mayor a :max.',
                'file'    => 'El archivo descripción no debe pesar más de :max kilobytes.',
                'string'  => 'El campo descripción no debe contener más de :max caracteres.',
                'array'   => 'El campo descripción no debe contener más de :max elementos.',
            ]
        ]);
        # Request
        $description = $request->input('description');
        # Create
        $record = New Region;
        $record->user_id = Auth::id();
        $record->description = $description;
        $record->status = 1;
        $record->save();
        return redirect('/region/create')->with('success', 'Registro Guardado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $count = Region::where('region_id', $id)->count();
        if ($count>0) {
            # Show
            $data['row'] = Region::where('region_id', $id)->first();
            return view('region.show', ['data' => $data]);
        }else{
            # Error
            return redirect('/region')->with('info', 'No se puede editar el registro');
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
        $count = Region::where('region_id', $id)->count();
        if ($count>0) {
            # Edit
            $data['row'] = Region::where('region_id', $id)->first();
            return view('region.edit', ['data' => $data]);
        }else{
            # Error
            return redirect('/region')->with('info', 'No se puede editar el registro');
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
            'description' => ['required', 'max:255', Rule::unique('regions')->ignore($id, 'region_id')],
        ],[
            'description.required' => 'El campo descripción es obligatorio.',
            'description.unique' => 'El valor del campo descripción ya está en uso.',
            'description.max' => [
                'numeric' => 'El campo descripción no debe ser mayor a :max.',
                'file'    => 'El archivo descripción no debe pesar más de :max kilobytes.',
                'string'  => 'El campo descripción no debe contener más de :max caracteres.',
                'array'   => 'El campo descripción no debe contener más de :max elementos.',
            ],
        ]);
        $count = Region::where('region_id', $id)->count();
        if ($count>0) {
            # Region
            $description = $request->input('description');
            # Update
            $record = Region::where('region_id', $id)->first();
            $record->description = $description;
            $record->save();
            return redirect('/region/edit/'.$id)->with('success', 'Registro Guardado');
        }else{
            # Error
            return redirect('/region')->with('info', 'No se puede Editar el registro');
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
        $count = Region::where('region_id', $id)->count();
        if ($count>0) {
            # Destroy
            $record = Region::where('region_id', $id)->first();
            $record->status = false;
            $record->save();
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

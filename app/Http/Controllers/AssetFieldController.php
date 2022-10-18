<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use \App\Models\AssetField;
use \App\Models\AssetFieldGroup;

class AssetFieldController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AssetFieldGroup $assetFieldGroup)
    {
        $assetFields = $assetFieldGroup->assetFields()->with('fieldType')->get();
        return $assetFields;
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
    public function store(Request $request, AssetFieldGroup $assetFieldGroup)
    {
        $validationData = $request->validate([
            'name' => 'required|string'
        ]);

        $assetField = $assetFieldGroup->assetFields()
                                ->create([
                                    'name' => $request->name,
                                    'field_type_id' => $request->type,
                                    'slug' => Str::slug($request->name) . '-' . rand(1111, 9999)
                                ]);


        return response()->json($assetField);
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
        $assetField = AssetField::whereId($id);
        $data = [];

        if ($request->has('name')) {
            $data['name'] = $request->name;
            $data['slug'] = Str::slug($request->name) . '-' . rand(1111, 9999);
        }
        
        if ($request->has('type')) {
            $data['field_type_id'] = $request->type;
        }
        
        if ($request->has('isVisible')) {
            $data['isVisible'] = $request->isVisible;
        }
        
        if ($request->has('isRequired')) {
            $data['isRequired'] = $request->isRequired;
        }
        
        if ($request->has('isEditable')) {
            $data['isEditable'] = $request->isEditable;
        }
        
        if ($request->has('isTimestampField')) {
            $data['isTimestampField'] = $request->isTimestampField;
        }

        $assetField->update($data);

        return response()->json($assetField);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $assetField = AssetField::whereId($id);

        $assetField->delete();

        return response()->json($assetField);
    }
}

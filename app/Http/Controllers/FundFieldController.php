<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use \App\Models\FundField;
use \App\Models\FundFieldGroup;

class FundFieldController extends Controller
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
    public function index(FundFieldGroup $fundFieldGroup)
    {
        $fundFields = $fundFieldGroup->fundFields()->with('fieldType')->get();
        return $fundFields;
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
    public function store(Request $request, FundFieldGroup $fundFieldGroup)
    {
        $validationData = $request->validate([
            'name' => 'required|string'
        ]);

        $fundField = $fundFieldGroup->fundFields()
                                ->create([
                                    'name' => $request->name,
                                    'field_type_id' => $request->type,
                                    'isRequired' => false,
                                    'isVisible' => true,
                                    'slug' => Str::slug($request->name) . '-' . rand(1111, 9999)
                                ]);


        return response()->json($fundField);
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
        $fundField = FundField::whereId($id);
        $data = [];

        if ($request->has('name')) {
            $data['name'] = $request->name;
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

        $fundField->update($data);

        return response()->json($fundField);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fundField = FundField::whereId($id);

        $fundField->delete();

        return response()->json($fundField);
    }
}

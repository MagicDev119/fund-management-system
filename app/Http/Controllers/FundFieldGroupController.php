<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use \App\models\FundFieldGroup;
use \App\models\FieldType;
use \App\Models\User;

class FundFieldGroupController extends Controller
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
    public function index()
    {
        $fieldGroups = [];
        foreach(Auth::user()->fundFieldGroups as $key => $value) {
            $value['fieldCnt'] = count($value->fundFields);
            $fieldGroups[] = $value;
        }
        $fieldType = FieldType::get();

        return response()->json([
            'fieldGroups' => $fieldGroups,
            'fieldType' => $fieldType
        ]);
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
        $validationData = $request->validate([
            'name' => 'required|string'
        ]);

        $fundFieldGroup = Auth::user()->fundFieldGroups()
                                ->create([
                                    'group_name' => $request->name,
                                    'type' => 2,
                                    'isVisible' => true,
                                    'slug' => Str::slug($request->name) . '-' . rand(1111, 9999)
                                ]);


        return response()->json($fundFieldGroup);
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

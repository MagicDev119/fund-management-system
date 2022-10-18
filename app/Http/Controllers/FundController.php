<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use \App\Models\User;
use \App\Models\Asset;
use \App\Models\SectorIndustry;
use \App\Models\DropdownList;
use \App\Models\FundType;
use \App\Models\FundField;
use \App\Models\FieldType;
use \App\Models\Fund;

class FundController extends Controller
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
        $fund = Auth::user()->funds()->with('fundFieldGroups.fundFields.fundData', 'assets.assetFieldGroups.assetFields.assetData', 'fundType')->get();
        return response()->json($fund);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userSetFundFieldGroups = Auth::user()->fundFieldGroups()
                                            ->with([
                                                'fundFields.fieldType',
                                                'fundFields' => function($query) {
                                                    $query->where('isVisible', 1);
                                                }])
                                            ->get();
        $fundType = FundType::get();
        foreach($userSetFundFieldGroups as $userSetFundFieldGroup) {
            foreach($userSetFundFieldGroup->fundFields as $fundField) {
                if ($fundField->fieldType->name != 'Dropdown') continue;
                $dropdownFieldList = [
                    "name" => $fundField->name,
                    "slug" => $fundField->slug,
                    "cate_name" => $fundField->fieldType->cate_name,
                    "resource" =>  $fundField->fieldType->resource
                ];

                switch($fundField->fieldType->table)
                {
                    case 'users':
                        $dropdownFieldList['data'] = [
                            'text' => 'name',
                            'value' => 'id',
                            'list' => User::select(
                                                array(
                                                    'id as value',
                                                    DB::raw('concat(COALESCE(first_name, ""), " ", COALESCE(last_name, "")) AS text')
                                                )
                                            )
                                            ->where('admin_role', '!=', 1)
                                            ->get()
                        ];
                        break;
                    case 'asset':
                        $dropdownFieldList['data'] = [
                            'text' => 'name',
                            'value' => 'id',
                            'list' => Asset::select(
                                                array(
                                                    'id as value',
                                                    'name AS text'
                                                )
                                            )
                                            ->get()
                        ];
                        break;
                    case 'sector_industry':
                        $dropdownFieldList['data'] = [
                            'text' => 'name',
                            'value' => 'id',
                            'list' => SectorIndustry::select(
                                                array(
                                                    'id as value',
                                                    'name AS text',
                                                    'type'
                                                )
                                            )
                                            ->where('type', $fundField->fieldType->resource)
                                            ->get()
                        ];
                        break;
                    case 'dropdown_list':
                        $dropdownFieldList['data'] = [
                            'text' => 'name',
                            'value' => 'id',
                            'list' => DropdownList::select(
                                                array(
                                                    'id as value',
                                                    'name AS text',
                                                    'type'
                                                )
                                            )
                                            ->where('type', $fundField->fieldType->resource)
                                            ->get()
                        ];
                        break;
                    default:
                        break;
                }
                $fundField['dropdown'] = $dropdownFieldList;
            }
        }

        return response()->json([
            'fund_type' => $fundType,
            'userSetFundFieldGroups' => $userSetFundFieldGroups
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateFields = [
            'name' => ['required', 'string'],
            'type' => ['required', 'string'],
            'currency' => ['required'],
            'legal_name' => ['required']
        ];
        $validatedData = $request->validate($validateFields);

        $newFund = Auth::user()->funds()->create([
                            'name' => $request->name,
                            'currency' => $request->currency,
                            'fund_type_id' => $request->type,
                            'legal_name' => $request->legal_name,
                            'slug' => Str::slug($request->name) . '-' . rand(1111, 9999)
                        ]);

        foreach(Auth::user()->fundFieldGroups as $fundFieldGroup) {
            if ($fundFieldGroup->isVisible != 1) continue;
            $newFundFieldGroup = $newFund->fundFieldGroups()->create([
                'group_name' => $fundFieldGroup->group_name,
                'slug' => Str::slug($fundFieldGroup->group_name) . '-' . rand(1111, 9999),
                'isVisible' => 1,
                'type' => 3
            ]);

            foreach($fundFieldGroup->fundFields as $fundField) {
                if ($fundField->isVisible != 1) continue;
                $newFundField = $newFundFieldGroup->fundFields()->create([
                    'name' => $fundField->name,
                    'slug' => Str::slug($fundField->name) . '-' . rand(1111, 9999),
                    'field_type_id' => $fundField->field_type_id,
                    'isVisible' => 1,
                    'isRequired' => $fundField->isRequired
                ]);
                $newFundData = $newFundField->fundData()->create([
                    'value' => $request['fund_' . $fundField->id]
                ]);
            }
        }

        return response()->json($newFund);
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

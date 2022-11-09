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

class AssetController extends Controller
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
    public function index(Request $request)
    {
        if ($request->has('fund_id') && $request->fund_id != 'all') {
            $assets = Asset::with('funds')->get();
        } else {
            $funds = Auth::user()->funds()->pluck('fund.id')->toArray();
            $assets = Asset::with('funds.users')->whereIn('funds.fund_id', $funds)->get();
        }
        
        return response()->json($assets);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userSetAssetFieldGroups = Auth::user()->assetFieldGroups()
                                            ->with([
                                                'assetFields.fieldType',
                                                'assetFields' => function($query) {
                                                    $query->where('isVisible', 1);
                                                }])
                                            ->get();
        foreach($userSetAssetFieldGroups as $userSetAssetFieldGroup) {
            foreach($userSetAssetFieldGroup->assetFields as $assetField) {
                if ($assetField->fieldType->name != 'Dropdown') continue;
                $dropdownFieldList = [
                    "name" => $assetField->name,
                    "slug" => $assetField->slug,
                    "cate_name" => $assetField->fieldType->cate_name,
                    "resource" =>  $assetField->fieldType->resource
                ];

                switch($assetField->fieldType->table)
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
                                            ->where('type', $assetField->fieldType->resource)
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
                                            ->where('type', $assetField->fieldType->resource)
                                            ->get()
                        ];
                        break;
                    default:
                        break;
                }
                $assetField['dropdown'] = $dropdownFieldList;
            }
        }

        return response()->json([
            'userSetAssetFieldGroups' => $userSetAssetFieldGroups
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
            'legal_name' => ['required']
        ];
        $validatedData = $request->validate($validateFields);

        $newAsset = Auth::user()->assets()->create([
                            'name' => $request->name,
                            'legal_name' => $request->legal_name,
                            'slug' => Str::slug($request->name) . '-' . rand(1111, 9999)
                        ]);

        foreach(Auth::user()->assetFieldGroups as $assetFieldGroup) {
            if ($assetFieldGroup->isVisible != 1) continue;
            $newAssetFieldGroup = $newAsset->assetFieldGroups()->create([
                'group_name' => $assetFieldGroup->group_name,
                'slug' => Str::slug($assetFieldGroup->group_name) . '-' . rand(1111, 9999),
                'type' => 3
            ]);

            foreach($assetFieldGroup->assetFields as $assetField) {
                if ($assetField->isVisible != 1) continue;
                $newAssetField = $newAssetFieldGroup->assetFields()->create([
                    'name' => $assetField->name,
                    'slug' => Str::slug($assetField->name) . '-' . rand(1111, 9999),
                    'field_type_id' => $assetField->field_type_id,
                    'isEditable' => $assetField->isEditable,
                    'isTimestampField' => $assetField->isTimestampField,
                    'isRequired' => $assetField->isRequired
                ]);
                $newAssetData = $newAssetField->assetData()->create([
                    'value' => $request['asset_' . $assetField->id],
                    'set_date' => date("Y-m-d")
                ]);
            }
        }

        return response()->json($newAsset);
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

    public function datacollection(Request $request, Asset $asset)
    {
        return response()->json($asset->datacollection()->with('companyMatrics.datas', 'companyMatrics.matricsResource', 'comments.user')->get());
    }
}

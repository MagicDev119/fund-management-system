<?php

namespace App\Http\Controllers;

use App\Models\CompanyMatrics;
use Illuminate\Http\Request;
use \App\Models\Asset;

class CompanyMatricsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompanyMatrics  $companyMatrics
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyMatrics $companyMatrics)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CompanyMatrics  $companyMatrics
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanyMatrics $companyMatrics)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompanyMatrics  $companyMatrics
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompanyMatrics $companyMatrics)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompanyMatrics  $companyMatrics
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyMatrics $companyMatrics)
    {
        //
    }
}

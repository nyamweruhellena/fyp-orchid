<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\API\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReportResource;
use App\Models\Property;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReportController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        $validator = Validator::make($request->all(), [
            'property_name' => 'required',
            'property_location' => 'nullable',
            'description' => 'nullable|string',
            'cost' => 'nullable',
            'status' => 'nullable'
        ]);

        if ($validator->fails()) {
            return $this->sendError('VALIDATION_ERROR', $validator->errors()->all(), 422);
        }

        $report = new Report();

        /**
         * We want the user to input name, location and/or description
         * From these parameters we want to get the property that is being referred to
         */
        $property = Property::where('name', 'LIKE', $request->property_name)->where('location', 'LIKE', $request->property_location)->first();

        $report->property_id = $property->id; //
        $report->description = $request->description;
        $report->cost = $request->cost ?? 0;
        $report->status = $property->status;
        $report->save();

        return $this->sendResponse(new ReportResource($report), 'CREATE_SUCCESS');

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

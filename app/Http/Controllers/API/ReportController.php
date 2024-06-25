<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReportResource;
use App\Models\CollegeBlock;
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
        $reports = Report::latest('updated_at')->paginate();

        if (count($reports) == 0) {
            return $this->sendError('RETRIEVE_MANY_FAILED', 'No reports found', 404);
        } else {
            return $this->sendResponse(ReportResource::collection($reports), 'RETRIEVE_SUCCESS');
        }
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


        /**
         * We want the user to input name, location and/or description
         * From these parameters we want to get the property that is being referred to
         *
         * Note the location is linked to table college blocks and not the property table
         */
        try {
            $location = CollegeBlock::firstOrCreate(['name' => $request->property_location]);

            $property = Property::firstOrCreate([
                'name' => $request->property_name,
                'serial_no' => $request->serial_no ?? generateSerialNumber(),
                'college_block_id' => $location->id,
            ]);

            $report = new Report();

            $report->property_id = $property->id; //
            $report->name = $property->name;
            $report->description = $request->description;
            $report->cost = $request->cost ?? 0;
            $report->status = 'Not done';
            $report->save();

            return $this->sendResponse(new ReportResource($report), 'CREATE_SUCCESS');
        } catch (\Throwable $th) {
            return $this->sendError('CREATE_FAILED', $th->getMessage(), 500);
        }
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

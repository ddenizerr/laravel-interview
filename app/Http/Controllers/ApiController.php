<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePropertyRequest;
use App\Models\Property;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    /**
     * @return false|string
     */
    public function index(): bool|string
    {
        $properties = Property::all();

        return json_encode($properties);
    }

    /**
     * Returns data by $id
     * @param $id
     * @return mixed
     */
    public function property($id): mixed
    {
        return Property::find($id);
    }

    /**
     * Creates new object with Property class
     * @param CreatePropertyRequest $request
     * @return Application|ResponseFactory|Response
     */
    public function create(CreatePropertyRequest $request): Response|Application|ResponseFactory
    {
        DB::begintransaction();

        $property = new Property;

        try {
            $property->parent_property_id = $request->parent_property_id;
            $property->organisation = $request->organisation;
            $property->property_type = $request->property_type;
            $property->uprn = $request->uprn;
            $property->address = $request->address;
            $property->town = $request->town;
            $property->postcode = $request->postcode;
            $property->live = $request->live;
            $property->save();

            Log::info('A new property created.');

            return response('New Property Created', 200);
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('Can not create new property');
            return response('Property create error: '.$exception->getMessage(),500);
        }


    }
}

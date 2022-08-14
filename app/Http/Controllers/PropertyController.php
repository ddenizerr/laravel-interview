<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePropertyRequest;
use App\Models\Property;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PropertyController extends Controller
{
    /**
     * @return false|string
     */
    public function index(): bool|string
    {
        $properties = Property::get();

        return response()->json(['properties' => $properties], 201);
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
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request)
    {

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

        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('Can not create new property');
            return response()->json(['message' => 'Property create error: ' . $exception->getMessage(), 500]);
        }

        DB::commit();
        return response()->json([
            'message' => 'New Property Created.',
        ], 200);

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'organisation' => 'required',
            'property_type' => 'required',
            'uprn' => 'required',
            'address' => 'required',
            'live' => 'required',
        ]);

        if ($validator->fails()) {
            return $validator->getMessageBag();
        }

        DB::begintransaction();

        $property = Property::find($id);

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
            Log::info('Property with id = ' . $property->id . ' is updated');
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('Can not update the property');
            return response()->json([
                'error' => 'Property with id = ' . $property->id . ' cannot be updated',
            ], 200);
        }
        DB::commit();
        return response()->json([
            'message' => 'Property with id = ' . $property->id . ' is updated',
        ], 200);

    }

    public function destroy($id)
    {
        DB::begintransaction();

        $property = Property::find($id);

        try {

            $property->delete();
            Log::info('Property deleted successfully . ');
            DB::commit();
            return response('Property deleted successfully . ', 200);
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('Property cannot be deleted . ');
            return response('Property with id = ' . $property->id . ' can not be deleted' . $exception->getMessage(), 500);
        }


    }

    public function getNotes($id)
    {
        $property = Property::find($id);

        return response()->json($property->notes());

    }


}

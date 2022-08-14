<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCertificateRequest;
use App\Http\Requests\UpdateCertificateRequest;
use App\Models\Certificate;
use App\Models\Property;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CertificatesController extends Controller
{
    /**
     * @return false|string
     */
    public function index(): bool|string
    {
        $certificates = Certificate::all();
        return response()->json(['certificates' => $certificates],200);
    }

    /**
     * Returns data by $id
     * @param $id
     * @return mixed
     */
    public function certificate($id): mixed
    {
        $certificate = Property::find($id);
        return response()->json(['certificate' => $certificate],200 );
    }

    /**
     * Creates new object with Property class
     * @param CreateCertificateRequest $request
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        $certificate = new Certificate();

        $validator = Validator::make($request->all(), [
            'stream_name' => 'required',
            'property_id' => 'required',
            'issue_date' => 'required',
            'next_due_date' => 'required',
        ]);
        try {
            $certificate->stream_name = $request->stream_name;
            $certificate->property_id = $request->property_id;
            $certificate->issue_date = Carbon::parse($request->issue_date);
            $certificate->next_due_date =  Carbon::parse($request->next_due_date);

            $certificate->save();

            Log::info('A new certificate created.');

        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('Can not create new certificate');
            return response()->json(['message' => 'Certificate create error: ' . $exception->getMessage(), 500]);
        }

        DB::commit();
        return response()->json([
            'message' => 'New Certificate Created.',
        ], 200);

    }


    public function getNotes($id)
    {
        $certificate= Certificate::find($id);

        return response()->json($certificate->notes);
    }

}

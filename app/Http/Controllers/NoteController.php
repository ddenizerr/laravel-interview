<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Property;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function show($type, $id)
    {
        if ($type == 'property') {
            return Note::where('model_type', 'Property')->where('model_id',$id)->get();
        } elseif ($type == 'certificate') {
            return Note::where('model_type', 'Certificate')->where('model_id',$id)->get();
        }
        return response()->json(['message' => 'not found'], 404);
    }

    public function create(Request $request, $type, $id)
    {
        if ($type == 'property' || $type =='certificate' ){
            $note = new Note();
            $note->model_id = $id;
            $note->note = $request->note;
            $note->model_type = ucfirst($type);
            $note->save();
            return response()->json(['message' => 'New notes created'], 200);
        }
        return response()->json(['message' => 'Unrelevant model type'], 500);
    }
}

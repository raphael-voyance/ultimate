<?php

namespace App\Http\Controllers\Universe;

use App\Models\Numerology;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NumerologyController extends Controller
{
    public function index() {
        $numbers = Numerology::all();
        
        return view('universe.numerology.index', ['numbers' => $numbers]);
    }

    public function view(Request $request) {
        $number = Numerology::where('number', $request->number)->firstOrFail();
        return view('universe.numerology.view', ['number' => $number]);
    }
    public function update(Request $request) {
        $request->validate([
            'field' => 'required',
            'value' => 'required'
        ]);

        $number = Numerology::where('number', $request->number)->firstOrFail();

        $field = $request->field;
        $value = $request->value;

        if($field == 'interpretation') {
            $request->validate([
                'pathType' => 'required'
            ]);
            
            $pathType = $request->pathType;

            $interpretations = json_decode($number->interpretations, true);

            if(isset($interpretations[$pathType])) {
                $interpretations[$pathType] = $value;
            }else {
                $interpretations[$pathType] = [
                    $pathType => $value
                ];
            }

            $number->interpretations = json_encode($interpretations);


        }else {
            $number->$field = $value;
        }

        $number->save();

        return response()->json(['message' => 'Le nombre a été mis à jour avec succés !']);
    }
}

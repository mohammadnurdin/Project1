<?php

namespace App\Http\Controllers;
use App\Models\Workshop;
use Illuminate\Http\Request;

class WorkshopsController extends Controller
{
    public function autocomplete(Request $request)
    {
        $data = Workshop::select("name as value", "id")
                    ->where('name', 'LIKE', '%'. $request->get('search'). '%')
                    ->get();
    
        return response()->json($data);
    }
}

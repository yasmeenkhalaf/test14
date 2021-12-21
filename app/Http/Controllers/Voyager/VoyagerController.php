<?php

namespace App\Http\Controllers\Voyager;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;

class VoyagerController extends VoyagerBaseController
{

    public function changeswitch(Request $request)
    {
        //dd($request);
        if($request->mode == "true")
        {
            $affected_field = DB::table($request->slug)->where('id', '=', $request->id)->update(array($request->fieldname => 1));
        }
        else
        {
            $affected_field = DB::table($request->slug)->where('id', '=', $request->id)->update(array($request->fieldname => 0));
        }
        return response()->json(['success'=>'Status '.$request->fieldname.' change successfully. ']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\PriStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockManager extends Controller
{
    /*here is methode that returns the m-stock views*/

    public function priSuplies()
    {
        $mat = DB::table('primaryproduct')->get();
        return view('items.m-stock.Pri-suplies', ['data' => $mat]);
    }

    public function stockDis()
    {
        return view('items.m-stock.stk-dis');
    }

    public function totalAll()
    {
        return view('items.m-stock.total-mpstdis');
    }

    /*fonctions to manage primary stock*/
    public function AddPriStck(Request $request)
    {
        $request->post();
        $request->validate([
            'code.*' => 'bail|required|numeric',
            'productname.*' => 'bail|required',
            'quantity.*' => 'bail|required|numeric',
            'unit.*' => 'bail|required'
        ]);

        foreach ($request->code as $key => $code) {
            $dataPS = new PriStock();
            $dataPS->code = $code;
            $dataPS->productname = $request->productname[$key];
            $dataPS->quantity = $request->quantity[$key];
            $dataPS->unit = $request->unit[$key];

            if ($dataPS->save()) {
                $res = true;
            } else {
                $res = false;
            }

        }

        if ($res === true) {
            return back()->with('success', 'Data saved');
        } else {
            return back()->with('fail', 'Data not saved');
        }


    }
    /*fonctions to manage primary stock*/


    /*function to verify if code exist or not start here*/
    public function searchCode(Request $request)
    {
        $request->ajax();
        $code = $request->search;
        $data = DB::table('primaryproduct')
            ->where('code', $code)->doesntExist();


        return response()->json($data);
    }
    /*function to verify if code exist or not end here*/
}

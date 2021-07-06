<?php

namespace App\Http\Controllers;

use App\Models\AdvencePay;
use App\Models\EditStore;
use App\Models\StoreCheckin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\StoreWorkers;
use App\Models\DeleteStore;
use Barryvdh\DomPDF\Facade as PDF;

class WorkersManager extends Controller
{
/*here is methodes that returns the m-workers views*/
   /* Checkin workers bloc start */
    public function checkInWorkers()
    {
        $todayDate = date('Y-m-d');
        $checkin = DB::table('workers')->get();
        $savedcheckin = DB::table('workers')
            ->rightJoin('checkin', 'workers.id_worker', '=', 'checkin.id_worker')
            ->where('date_checkin' , $todayDate)
            ->get();

       return view('items.m-workers.checkin', ['checkin' => $checkin], ['savedcheckin' => $savedcheckin]);
    }
    /* Checkin workers bloc end */

    /* Salary workers bloc start */

    public function salaryWorkers()
    {
        $month = date('m');
        $year = date('Y');
        $monthlypay = DB::table('advancepay')
            ->whereMonth('advance_date', $month)
            ->whereYear('advance_date', $year)
            ->orderByDesc('created_at')
            ->get();

        $workers = DB::table('workers')->get();

       return view('items.m-workers.salary', ['workers' => $workers , 'monthlyadvpay' => $monthlypay]);
    }

    /* Salary workers bloc end */

    /* Update worker bloc start */
    public function updateWorker()
    {
        $worker = DB::table('workers')->get();
       return view('items.m-workers.update',['worker' => $worker]);
    }
    /* Update worker bloc end */

    /*here is the end methodes that returns the m-workers views*/

    /*Start of Methode to save workers*/
    /**
     * Store a new blog post.
     *
     * @param  Request  $request
     * @return Response
     */
    public function addStore(Request $request)
    {
        //$todayDate = date('d/m/Y');

        $request->validate([
            'name' => 'bail|required',
            'family_name' => 'bail|required',
            'address' => 'bail|required',
            'phone' => 'bail|required|numeric',
            'enter_date' => 'required|date',
            'salary' => 'bail|required|numeric',
        ]);
        if(StoreWorkers::insert($request->all()))
        {
            return back()->with('success', 'Data inserted successfuly');
        }else
            {
                return back()->with('fail', 'Something went wrong !');
            }


    }
    /*End of Methode that save workers*/


    /**
     * edit a blog post.
     *
     * @param  Request  $request
     * @return Response
     */
    /*Start of Methode that edit worker*/
    public function editStore(Request $request, $id)
    {
        $request->validate([
            'name' => 'bail|required',
            'family_name' => 'bail|required',
            'address' => 'bail|required',
            'phone' => 'bail|required|numeric',
            'enter_date' => 'required|date',
        ]);
        if(EditStore::where('id_worker', $id)->update([
            'name' => $request->name,
            'family_name' => $request->family_name,
            'address' => $request->address,
            'phone' => $request->phone,
            'enter_date' => $request->enter_date,
            ]))
        {
            return back()->with('modified', 'data modified with success');
        }else
            {
                return back()->with('notModified', 'data not modified, something went wrong !');
            }
    }
    /*End of Methode that edit worker*/

    /**
     * Store a new blog post.
     *
     * @param  Request  $request
     * @return Response
     */
    /*Start of Methode that delete worker*/
    public function deleteStore($id)
    {
        if(DeleteStore::where('id_worker', $id)->delete())
        {
            return back()->with('deleted', 'record deleted successfuly !');
        }else
            {
                return back()->with('failed', 'record failed to delete !');
            }
    }
    /*End of Methode that delete worker*/
    /*-----------------------------------------------------------------------------------------------------*/


    /*methods for salary and advance start here */
    public function setAdvance(Request $request, $id, $name, $family)
    {
        $request->validate([

            'advance_pay' => 'bail|required|numeric',
            'advance_date' => 'bail|required|date',
        ]);
        if(AdvencePay::where('id_worker', $id)->insert([
            'id_worker' => $id,
            'name' => $name,
            'family_name' => $family,
            'advance_pay' => $request->advance_pay,
            'advance_date' => $request->advance_date,
            '_token' => $request->token]))
        {
            return back()->with('inserted', 'advanced payment inserted successfuly !');
        }else
            {
                return back()->with('notinserted', 'advanced payment not inserted !');
            }
    }
    /*methods for salary and advance end here*/


    /*method to checkIn workers daily start */
    public function checkIn(Request $request)
    {

        $request->validate([
            'id_worker.*' => 'bail|required|numeric',
            'status.*' => 'bail|required'
        ]);

        $todayDate = date('Y-m-d');
        if(DB::table('checkin')->where('date_checkin', $todayDate)->doesntExist())
        {
            foreach ($request->id_worker as $key=>$id_worker)
            {
                $data = new StoreCheckin();
                $data->id_worker = $id_worker;
                $data->date_checkin = $todayDate;
                $data->status = $request->status[$key];
                if ($data->save())
                {
                    $res = true;
                }else
                {
                    $res = false;
                }
            }
            if($res === true){return back()->with('success','Data saved');}else{return back()->with('fail', 'Data not saved');}
        }else
            {
                return back()->with('fail', 'Double Pointage');
            }


    }
    /*method to checkIn workers daily end */

    /*method to update checkIn workers daily start */
    public function updateCheckin(Request $request ,$id)
    {
        $todayDate = date('Y-m-d');
        $request->validate([
            'status' => 'bail|required'
        ]);
        if(DB::table('checkin')->where([
            ['date_checkin', $todayDate] ,
            ['id_worker', '=', $id],
        ])->update(['status' => $request->status]))
        {
            return back()->with('updated', 'data updated successfuly');
        }else{return back()->with('fail', 'data failed to update');}
    }
    /*method to update checkIn workers daily end */


 /*-------------------------------------------------Ajax requests start here-----------------------------------------------------------------*/

    /*start ajax request to find advance payment*/
    public function searchAdvPay(Request $request)
    {
        $request->ajax();
        $search = $request->search;
        $month = date('m');
        $year = date('Y');
        $data = DB::table('advancepay')
            ->where('advance_search', 'like', '%'.$search.'%')
            ->whereMonth('advance_date', $month)
            ->whereYear('advance_date', $year)
            ->get();

        return response()->json($data);
    }
    /*end ajax request to find advance payment*/


    /* method to download pdf start here*/
    // Generate PDF
    public function createPDF(Request $request, $id)
    {
        $year = date('Y');
        $RquestedMonth = $request->selectedmonth;
        $data =[];
        // retreive all records from db
        if ( DB::table('checkin')->whereMonth('date_checkin', $RquestedMonth)->whereYear('date_checkin', $year)->exists())
        {

            $worker = DB::table('workers')
                ->leftJoin('checkin', 'checkin.id_worker', '=', 'workers.id_worker')
                ->where('workers.id_worker', $id)
                ->whereMonth('checkin.date_checkin', $RquestedMonth)
                ->get();

        }

        // share data to view
        view()->share('docs.pdf',$data);
        $pdf = PDF::loadView('docs.pdf', ['data' => $data]);

        // download PDF file with download method
       // return $pdf->download('pdf_file.pdf');
        return $worker;
    }
    /*method to download pdf end here*/
}

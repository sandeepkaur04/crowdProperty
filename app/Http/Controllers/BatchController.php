<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Batch;
use Auth;

class BatchController extends Controller
{
    public function index() {
        $batches = Batch::orderBy('id','desc')->get()->toArray();
        return view('batches.index', compact('batches'));
    }

    /** 
     * Add the batch and assign a unique number to each batch. is_ended status represents if the batch is ended for the day or not
     * batches can be added multiple for the time because there is a possibility that the batch consignment locations are different.
     * so the batches can be closed once all the consignments for specific location are done.
     */
    public function add(Request $request) {

        if($request->isMethod('post')) {
            $validatedData = $request->validate([
                'driver_name' => 'required',
                'driver_email' => 'required',
            ]);

            $data = $request->all();

            $batch_no = 1;
            $prev_rec = Batch::latest()->value('batch_no');
            if($prev_rec != '') {
                $batch_no = $prev_rec + 1;
            }

            $rec = new Batch();
            $rec->batch_no = $batch_no;
            $rec->date = date('Y-m-d');
            $rec->driver_name = $data['driver_name'];
            $rec->email = $data['driver_email'];
            $rec->is_ended = '0';
            if($rec->save()) {
                return redirect('/batches');
            } else {
                return redirect()->back();
            }
        }
        return view('batches.form');
    }

    /** update the is_ended status and send email to the driver of the batch. 
     * This email will consist all the consignment numbers for the current batch which is assigned to the driver */
    public function endbatch($batch_id) {
         Batch::where('id', $batch_id)->update(['is_ended' => '1']);
        $dets = Batch::send_batch_details($batch_id);
         return redirect()->back();
    }
}

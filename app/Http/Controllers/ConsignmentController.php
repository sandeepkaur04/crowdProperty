<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Batch, App\Models\Consignment;
use Auth;

class ConsignmentController extends Controller
{
    /** fetch consignments according to the batch */
    public function index($batch_id) {
        $consignments = Consignment::where('batch_id', $batch_id)->orderBy('id','desc')->get()->toArray();
        $can_add = Batch::where('id', $batch_id)->value('is_ended');
        return view('consignments.index', compact('consignments', 'batch_id','can_add'));
    }

    /** add consignments according to the batch by assigning unique number to each consignment */
    public function add(Request $request, $batch_id) {

        if($request->isMethod('post')) {
            $validatedData = $request->validate([
                'item_name' => 'required',
                'address' => 'required',
            ]);

            $data = $request->all();
            $cons = new Consignment();
            $cons->batch_id = $batch_id;
            $cons->cons_no = random_int(100000, 999999);
            $cons->name = $data['item_name'];
            $cons->address = $data['address'];

            if($cons->save()) {
                return redirect('/consignments/'.$batch_id);
            } else {
                return redirect()->back();
            }
        }
        return view('consignments.form', compact('batch_id'));
    }
}

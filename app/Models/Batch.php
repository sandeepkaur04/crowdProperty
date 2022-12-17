<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    public static function send_batch_details($batch_id) {

        // get the batch details with all the assigned consignment numbers
        $detail = Batch::select('*')
                        ->where('id', $batch_id)
                        ->with('consignments')
                        ->get()
                        ->toArray();

        // echo '<pre>'; print_r($detail); die;
        $consignment_numbers = [];
        foreach ($detail as $key => $value) {
            foreach ($value['consignments'] as $key2 => $value2) {
                array_push($consignment_numbers, $value2['cons_no']);
            }
            

            // send email to driver with all the consignment numbers
            $to = $value['email'];
            $subject = "Consigment numbers";
            $txt = `Hello! Please find the consignment numbers as following: <br>`.implode(" ", $consignment_numbers).` `;
            $headers = "From: noreply@crowdproperty.com" . "\r\n" ;
            // mail($to,$subject,$txt,$headers);
            return true;
        }
    }

    public function consignments() {
        return $this->hasMany(Consignment::class, 'batch_id', 'id');
    }
}

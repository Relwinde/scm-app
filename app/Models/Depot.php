<?php

namespace App\Models;

use Mpdf\Mpdf;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Depot extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function print (){
        ini_set('memory_limit', '440M');
        $mpdf = new Mpdf([
            'mode'=>'utf-8',
            'format' => 'A4-P',
            'default_font_size' => 12,
	        'default_font' => 'FreeSerif'
        ]);

        $html = view('prints.depot', ['depot'=>$this]);
        $mpdf->writeHTML($html);
        $mpdf->Output();
    }

}

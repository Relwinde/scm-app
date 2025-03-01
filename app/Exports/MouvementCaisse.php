<?php

namespace App\Exports;

use App\Models\SuiviCaisse;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class MouvementCaisse implements FromQuery, ShouldAutoSize, WithHeadings, WithColumnFormatting

{

    use Exportable;

    public $start_date;
    public $end_date;

    public function __construct($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        $query = SuiviCaisse::select([
            'bon_de_caisses.depense as libelle_bon',
            'depots.libelle as libelle_depot',
            'ajustement_bons.libelle as libelle_ajustement',
            'suivi_caisses.montant',
            'suivi_caisses.solde_before',
            'suivi_caisses.solde_after',
            'suivi_caisses.created_at',])
                ->leftjoin('bon_de_caisses', 'suivi_caisses.bon_de_caisse_id', '=', 'bon_de_caisses.id')
                ->leftjoin('ajustement_bons', 'suivi_caisses.ajustement_bon_id', '=', 'ajustement_bons.id')
                ->leftjoin('depots', 'suivi_caisses.depot_id', '=', 'depots.id')
                ->orderBy('suivi_caisses.created_at', 'DESC');

        if ($this->start_date) {
            $query->where('suivi_caisses.created_at', '>=', $this->start_date);
        }
        if ($this->end_date) {
            $query->where('suivi_caisses.created_at', '<=', $this->end_date);
        }

        return $query;
    }

    public function headings(): array
    {
        return ["Bon de caisse", "Dépot", "Ajustement", "Montant (F CFA)", "Montant avant opération (F CFA)", "Montant après opération (F CFA)", "Date"];
    }

    public function columnFormats(): array
    {
        return [
                'D' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
                'E' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
                'F' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            ];
    }

}

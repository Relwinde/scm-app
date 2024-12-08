<?php

namespace App\Exports;

use App\Models\BonDeCaisse;
use App\Models\TransportInterne;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TransportDepenses implements FromCollection,  ShouldAutoSize, WithHeadings
{
    private TransportInterne $dossier;

    public function __construct(TransportInterne $dossier)
    {
        $this->dossier = $dossier;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $bons = BonDeCaisse::select([
            'bon_de_caisses.numero',
            'bon_de_caisses.depense',
            'bon_de_caisses.montant_definitif',
            'users.name',
            'bon_de_caisses.type_paiement',
            'bon_de_caisses.created_at'
        ])
        ->join('transport_internes', 'bon_de_caisses.transport_interne_id', '=', 'transport_internes.id')
        ->join('users', 'bon_de_caisses.user_id', '=', 'users.id')
        ->where('bon_de_caisses.transport_interne_id', '=', $this->dossier->id)
        ->where(function ($query) {
            $query->where('bon_de_caisses.etape', 'PAYE')
                    ->orWhere('bon_de_caisses.etape', 'CLOS');
        })
        ->orderBy('bon_de_caisses.created_at', 'DESC')->get();

        // Format created_at after fetching
        $bons->transform(function ($bon) {
            $bon->created_at = \Carbon\Carbon::parse($bon->created_at)->format('Y-m-d'); // Adjust format as needed
            return $bon;
        });

        return $bons;
    }

    public function headings(): array
    {
        return ["N° de bon", "Dépenses", "Montant (CFA)", "Emetteur", "Mode de paiement", "Date"];
    }
}

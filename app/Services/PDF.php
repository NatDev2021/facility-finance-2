<?php

namespace App\Services;

use Nette\Utils\Html;
use TCPDF;

class PDF extends TCPDF
{
    public $nomemp;
    public $ncidade;
    public $nuf;
    public $titulo;
    public $data1;
    public $data2;
    public $tipo;


    function __construct($titulo = null, $data1 = null, $data2 = null, $nomemp = null, $cidade = null, $nuf = null, $tipo = null)
    {
        if ($tipo == null) {
            parent::__construct('P');
        } else {
            parent::__construct('L');
        }
        $this->titulo = $titulo;
        $this->data1 = $data1;
        $this->data2 = $data2;
        $this->nomemp = $nomemp;
        $this->ncidade = $cidade;
        $this->nuf = $nuf;
        $this->tipo = $tipo;
    }

    // Definindo o cabeçalho
    public function Header()
    {

        // set margins
        $this->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $this->SetHeaderMargin(PDF_MARGIN_HEADER);
        $this->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $this->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);


  
        // ---------------------------------------------------------

        // set default font subsetting mode
        $this->setFontSubsetting(true);

         $this->SetFont('dejavusans', 'B', 8);


         $this->Image(__DIR__.'/../../public/img/FacilityWeb.jpg', 15, 9, 30, '', 'JPG');
         $this->ln(7);
        $this->Cell(0, 2, ('Pág.: ') . $this->PageNo(), 0, 1, 'R');
        $this->Cell(0, 2, ('                               ' . $this->titulo), 0, 1, 'L');
        $this->Cell(0, 2, ('                               Empresa: ' . ($this->nomemp) . ' - ' . ($this->ncidade) . ' - ' . $this->nuf), 'B', 0, 'L',);
        $this->Cell(0, 2, ('Emissão: ') . strftime("%d/%m/%Y - %H:%M"), 0, 1, 'R');

        $this->Ln(20);

    }
}

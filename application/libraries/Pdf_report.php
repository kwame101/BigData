<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

require_once(dirname(__FILE__).'/tcpdf/tcpdf.php');

class Pdf_report extends TCPDF
{

  public function __construct()
  {
  parent::__construct();
  }
    //Page header
    public function Header() {
      $getDate = date("l jS F Y");
      // Logo
      $image_file = K_PATH_IMAGES.'logo_pdf.png';
      $this->Image($image_file, 15, 10, 30, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
      // Set font
      $this->SetFont('helvetica', 'B', 9);
      // Title
      $this->Cell(70, 9, 'BigDataCorridor User Report', 0, false, 'R', 0, '', 0, false, 'T', 'M');
      //$this->Cell(30, 0, 'BigDataCorridor User Report', 1, $ln=0, 'C', 0, '', 0, false, 'C', 'C');
      $this->Cell(75, 9, $getDate, 0, false, 'R', 0, '', 0, false, 'T', 'M');
  }

  // Page footer
  public function Footer() {
      // Position at 15 mm from bottom
      $this->SetY(-15);
      // Set font
      $this->SetFont('helvetica', 'I', 8);
      // Page number
      //$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
      $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
  }
}

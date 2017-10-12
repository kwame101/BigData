<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends My_Controller{

  /*
    * Initialise functions
    */
    function __construct()
    {
      parent::__construct();
      //die($this->input->is_cli_request()?'T':'F');
      if(!$this->input->is_cli_request())
     {
        echo 'Not allowed';
        exit();
     }
    }

    /*
    *
    */
    public function monthlyEmail()
    {
      //echo "is_cli():".var_dump(is_cli())."<br>";
        $getDate = date("l, jS F, Y");
        $pdf = $this->savePDF();

        //email submit
        $this->load->library('email');
        $this->load->helper('path');
        $this->email->from('test@gmail.com');
        $this->email->to('Kwame@studio14online.co.uk','tester');
        $pdf_path = set_realpath('assets/tmp_email/');
        $this->email->attach($pdf_path.$pdf);
        $msg_info = array(
          'attachment' => 'Monthly Report from '.$getDate
        );
        $this->email->subject('testing email ci');
        $content = $this->load->view('templates/email/monthly_template.php',$msg_info,TRUE);
        $this->email->message($content);
        $this->email->send();
        unlink($pdf_path.$pdf);
    }

    /*
    *
    */
    public function savePDF()
    {
      $this->load->library("Pdf_report");
      date_default_timezone_set('Europe/London');
      $currentdate = date("d_m_Y");
      $getDate = date("l jS F Y");

      // create new PDF document
      $pdf = new Pdf_report(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

      // set document information
      $pdf->SetCreator('Admin tester');
      $pdf->SetAuthor('Admin tester');
      $pdf->SetTitle('BigDataCorridor Report');
      $pdf->SetSubject('BigDataCorridor report');
      $pdf->SetKeywords('PDF, report, bigdata, form, html, data');

      $PDF_HEADER_LOGO = 'logo_example.jpg';
      $pdf->Image('@' . $PDF_HEADER_LOGO);
      $PDF_HEADER_LOGO_WIDTH = '20';
      $PDF_HEADER_TITLE = 'BigDataCorridor Report';
      // set default header data
      $pdf->SetHeaderData($PDF_HEADER_LOGO, $PDF_HEADER_LOGO_WIDTH, $PDF_HEADER_TITLE,NULL);

      // set header and footer fonts
      $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
      $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

      // set default monospaced font
      $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

      // set margins
      $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
      $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

      // set auto page breaks
      $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

      // set image scale factor
      $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

      // set some language-dependent strings (optional)
      if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
      	require_once(dirname(__FILE__).'/lang/eng.php');
      	$pdf->setLanguageArray($l);
      }

      // ---------------------------------------------------------

      // set font
      $pdf->SetFont('helvetica', '', 12);
      // remove default header
      $pdf->setPrintHeader(false);
      //remove default footer
      $pdf->setPrintFooter(false);
      // add a page
      $pdf->AddPage();
          // -- set new background ---
      // get the current page break margin
      $bMargin = $pdf->getBreakMargin();
      // get current auto-page-break mode
      $auto_page_break = $pdf->getAutoPageBreak();
      // disable auto-page-break
      $pdf->SetAutoPageBreak(false, 0);
      // set bacground image
      $img_file = K_PATH_IMAGES.'pdf_doc.jpg';
      $pdf->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
      // restore auto-page-break status
      $pdf->SetAutoPageBreak($auto_page_break, $bMargin);
      // set the starting point for the page content
      $pdf->setPageMark();
      $pdf->Ln(128);

      //date info
      $date_info = '<span style="color:white;font-size:20px;">'.$getDate.'</span>';
      $pdf->writeHTML($date_info, true, false, true, false, '');

      $pdf->Ln(5);
      // Page title 1
      $page_info = '<div style="color:white;font-weight:bold;font-size:48px;">BigDataCorridor</div>';
      $pdf->writeHTML($page_info, true, false, true, false, '');
      //$pdf->Ln(1);
      // Page title 2
      $page_info = '<div style="color:white;font-weight:bold;font-size:48px;">User Report</div>';
      $pdf->writeHTML($page_info, true, false, true, false, '');



      $result = $this->ion_auth->usersProfile(2)->result_array();
      $logged =  $this->ion_auth->activityDetails()->result_array();
      foreach($result as $row){
        $new_date = array();
        //set default header to true
        $pdf->setPrintHeader(true);
        // add a page
        $pdf->AddPage();
        //set default footer to true
        $pdf->setPrintFooter(true);
        $pdf->Ln(10);

        $html_info = '<h1>'.$row['company'].'</h1><table><tr>
                      <th style="font-size:12px;font-weight:bold;color:#8ba5c3;">Name: <span style="color:black;">'.$row['user_full_name'].'</span></th>
                      <th style="font-size:12px;font-weight:bold;color:#8ba5c3;">Email: <span style="color:black;">'.$row['email'].'</span></th>';
        $table_info = '<h1></h1><table style="border:1px solid #000; padding:6px;">';
        $table_info .= '<tr> <th style="border:1px solid #000; padding:6px; font-weight: bold; width: 150px;">
                        Date</th> <th style="border:1px solid #000; padding:6px;font-weight: bold; width: 150px;">Time in</th><th
                        style="border:1px solid #000; padding:6px;font-weight: bold; width: 150px;">Time out</th><th style="font-weight: bold;
                         width: 150px;border:1px solid #000; padding:6px;">Time spent</th></tr>';

        foreach($logged as $log){
          if ($row['id'] == $log['user_id']) {
              $loggedout = DateTime::createFromFormat('Y-m-d H:i:s',date('Y-m-d H:i:s',$log['last_seen']));
              $loggedin = DateTime::createFromFormat('Y-m-d H:i:s',date('Y-m-d H:i:s',$log['logged_in']));
              $total =  $loggedout->diff($loggedin);
              $sumTotal = sprintf(
                '%d:%02d:%02d',
               ($total->d * 24) + $total->h,
               $total->i,
               $total->s
              );
              $table_info .= '<tr>
                            <td style="border:1px solid #000; padding:6px;">'
                            .date('d/m/y',$log['logged_in']).'</td><td style="border:1px solid #000; padding:6px;">'.date('H:i:s',$log['logged_in']).
                            '</td><td style="border:1px solid #000; padding:6px;">'.date('H:i:s',$log['last_seen']).'</td>
                              <td style="border:1px solid #000; padding:6px;">'.$sumTotal.'</td></tr>';
              array_push($new_date, $sumTotal);
            }

        }

        $table_info .= '</table>';

        $html_info .=  '<th style="font-size:12px;font-weight:bold;color:#8ba5c3;text-align:center;">Total time: <span style="color:black;">'.$this->addTime($new_date).'</span></th></tr></table>';

        // output the HTML content
        $pdf->writeHTML($html_info, true, false, true, false, '');
        // output the HTML content
        $pdf->writeHTMLCell(0 , 0,'','',$table_info, 0, 1, 0, true, 'C', true);

      }
      $file_name = 'Report_'.$currentdate.'.pdf';
      //Close and output PDF document
      $pdf->Output($_SERVER['DOCUMENT_ROOT']. 'bigdata/assets/tmp_email/'.$file_name, 'F');

      return $file_name;
    }

    /*
    *
    */
     protected function addTime($times) {
     $seconds = 0;
       foreach ($times as $time)
       {
         list($hour,$minute,$second) = explode(':', $time);
           $seconds += $hour*3600;
           $seconds += $minute*60;
           $seconds += $second;
         }
         $hours = floor($seconds/3600);
         $seconds -= $hours*3600;
         $minutes  = floor($seconds/60);
         $seconds -= $minutes*60;
         return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
     }


}

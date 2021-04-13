<?php

class testController extends Controller
{
    protected $table;

    public function view()
    {
        // $this->load->library('email');
        // $mail = new email();
        // removeUpload('c27792b8568151932fbb2bec7b0f8c57.jpg');
        // loadFrag('volunteer_p_existing');
        // echo isUser('VOL,   ADM');
        // echo getExportName();

        // $zip = new ZipArchive();
        // if (true === $zip->open(DOWNLOAD_PATH.storeDownload('zip'), ZipArchive::CREATE)) {
        //     $zip->addEmptyDir('test');
        //     // $zip->
        //     $zip->addFile(CONTROLLER_PATH.'testController.php', 'test/newname.txt');
        //     $zip->close();
        //     echo 'ok';
        // } else {
        //     echo 'failed';
        // }

        $this->load->library('pdf');
        // $pdf = pdf();
        // $pdf->AddPage();
        // $pdf->SetFont('Arial', 'B', 16);
        // $pdf->Cell(40, 10, 'Hello World!');
        // $pdf->Output();
        $pdf_data = ['logo' => 'img/slmo.png'];
        $pdf = pdf('tour_participant', $pdf_data);
        $pdf->AliasNbPages();
        $pdf->AddPage();

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->SetTextColor(100, 100, 50);
        $pdf->Cell(200, 10, 'Tour Participant Details', 0, 1, 'C');

        $pdf->SetTextColor(0, 0, 0);

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(40, 10, 'Full Name');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(40, 10, 'Full Name');
        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(40, 10, 'Type');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(40, 10, 'Type');
        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(40, 10, 'Gender');
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(40, 10, 'Date of Birth');
        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(200, 10, 'Passport Details', 'B', 3, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(40, 10, 'Number');
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(40, 10, 'Date of Issue');
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(40, 10, 'Date of Expiry');
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(40, 10, 'Surname');
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(40, 10, 'Other Names');
        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(200, 10, 'Other Details', 'B', 3, 'C');
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(40, 10, 'T-Shirt Size');
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(40, 10, 'Room Type');
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(40, 10, 'Catering Needs');

        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(200, 10, 'Passport Photo', 'B', 3, 'C');
        $pdf->Image(PUBLIC_PATH.'/img/dashboard_quiz.png', 10, 190, 190, 100);

        $pdf->Output();

        // $pdf = pdf('test_other');
        // // Column headings
        // $header = ['Country', 'Capital', 'Area (sq km)', 'Pop. (thousands)'];
        // $data = [
        //     ['Austria', 'Vienna', '83859', '8075'],
        //     ['Belgium', 'Brussels', '30518', '10192'],
        //     ['Denmark', 'Copenhagen', '43094', '5295'],
        //     ['Finland', 'Helsinki', '304529', '5147'],
        //     ['France', 'Paris', '543965', '58728'],
        //     ['Germany', 'Berlin', '357022', '82057'],
        //     ['Greece', 'Athens', '131625', '10511'],
        //     ['Ireland', 'Dublin', '70723', '3694'],
        //     ['Italy', 'Roma', '301316', '57563'],
        //     ['Luxembourg', 'Luxembourg', '2586', '424'],
        //     ['Netherlands', 'Amsterdam', '41526', '15654'],
        //     ['Portugal', 'Lisbon', '91906', '9957'],
        //     ['Spain', 'Madrid', '504790', '39348'],
        //     ['Sweden', 'Stockholm', '410934', '8839'],
        //     ['United Kingdom', 'London', '243820', '58862'],
        // ];
        // $pdf->SetFont('Arial', '', 14);
        // $pdf->AddPage();
        // $pdf->BasicTable($header, $data);
        // $pdf->AddPage();
        // $pdf->ImprovedTable($header, $data);
        // $pdf->AddPage();
        // $pdf->FancyTable($header, $data);
        // $pdf->Output('F', DOWNLOAD_PATH.'kakki.pdf');
    }
    public function apisex(){
        $this->load->view('test', 'test');
    }
}

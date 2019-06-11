<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Laporan');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->helper('nuris_helper');
    }

    public $nama_template='template_admin';
    public $header_laporan= array(
                                    'waktu timbang'=>'waktu_timbang',
                                    'Id timbang'=>'id_timbang',
                                    'Nama Penimbang'=>'nama_penimbang',
                                    'Nama Customer'=>'nama_customer',
                                    'Nama Kendaraan'=>'nama_kendaraan',
                                    'Plat Kendaraan'=>'no_plat',
                                    'Nama Product'=>'nama_product',
                                    'Bruto'=>'bruto',
                                    'Tarra'=>'tarra',
                                    'Netto'=>'netto',
                                    'Nilai potongan'=>'nilai_potongan',
                                    'Total bersih'=>'total_bersih',
                                    'Jumlah'=>'jumlah',
                                    );
       
    public function index()
    {
        //$data['data_jenis']=$this->Model_Laporan->get_jenis();
        $this->template->load($this->nama_template,'laporan',$data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Model_Laporan->json();
    }

    public function pdf_penjualan() 
    {
        $w_awal=NULL;
        $w_akhir=NULL;
        $kondisi=NULL;

        if ($_POST) {
            $w_awal= stripslashes("\'".get_gmt_from_date($_POST['tanggal_awal'])."\'");
            $w_akhir= stripslashes("\'".get_gmt_from_date($_POST['tanggal_akhir'])."\'");
            $status= $_POST['status'];
        }

            $kondisi=$_POST['kondisi'];
        
        $data_print = $this->Model_Laporan->laporan_penjualan($w_awal,$w_akhir,$kondisi,$status);
        $data['title']='Laporan Penjualan';
        $data['w_awal']=$_POST['tanggal_awal'];
        $data['w_akhir']=$_POST['tanggal_akhir'];
        
        $data['table_header']=$this->header_laporan;
        $data['record']=$data_print;
	
        if ($data) {
        //print_r($data_print);

        require_once("dompdf/dompdf_config.inc.php");
        $dompdf = new DOMPDF();

        //Load html view
        if ($kondisi==0) {
            //customer
            $html=$this->load->view('pdf_penjualan_cus', $data,TRUE);
        } else {
            $html=$this->load->view('pdf_penjualan_supp', $data,TRUE);
        }
        
        $dompdf->load_html($html);
	    $dompdf->set_paper('A4', 'landscape');
	    $dompdf->render();
	    $dompdf->stream('tes.pdf',array('Attachment' =>0)); 
         
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(base_url('laporan'));
        }
    }

    public function excel_penjualan()
    {
        
        $this->load->helper('exportexcel_helper');
        $namaFile = "Laporan_Penimbangan.xls";
        $judul = "Laporan_Penimbangan";
        $w_akhir=NULL;
        $w_awal=NULL;
        $kondisi=NULL;

        if ($_POST) {
            $w_awal= stripslashes("\'".get_gmt_from_date($_POST['tanggal_awal'])."\'");
            $w_akhir= stripslashes("\'".get_gmt_from_date($_POST['tanggal_akhir'])."\'");
            $status= $_POST['status'];
        }

        if ($_POST['kondisi']) {
            $kondisi=$_POST['kondisi'];
        }
        

        $detail=$this->Model_Laporan->laporan_penjualan($w_awal,$w_akhir,$kondisi,$status);
        $w_awal=$_POST['tanggal_awal'];
        $w_akhir=$_POST['tanggal_akhir'];

    

        $tablehead = 4;
        $tablebody = $tablehead+1;
        $nourut = 1;
        
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();
    xlsWriteLabel(0, 0, "Laporan Penjualan");
    xlsWriteLabel(1, 0, "Periode ".$w_awal." s/d ".$w_akhir." ");

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	
    foreach ($this->header_laporan as $header_xls) {
        xlsWriteLabel($tablehead, $kolomhead++, $header_xls);
    }
    
	$grand_total=0;
    $gt_tabelbody=0;
    $gt_kolombody=0;
    
    foreach ($detail as $data)//$this->Model_Admin->laporan_excel_penjualan($w_awal,$w_akhir) as $data) {
            {

            $kolombody = 0;
            $grand_total=$grand_total+$data['total_bersih'];

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    foreach ($this->header_laporan as $header_xls) {
        xlsWriteLabel($tablebody, $kolombody++,$data[$header_xls]);
            }
        $tablebody++;
            $nourut++;

        $gt_tabelbody=$tablebody;
        $gt_kolombody=$kolombody-1;
        }

        xlsWriteLabel($gt_tabelbody, 1, 'Grand Total');
        xlsWriteNumber($gt_tabelbody, $gt_kolombody, $grand_total);



        xlsEOF();
        exit();
    }

    public function pdf_serah_terima_penjualan() 
    {
        $w_awal=NULL;
        $w_akhir=NULL;
        $kondisi=NULL;

        if ($_POST) {
            $w_awal= stripslashes("\'".get_gmt_from_date($_POST['tanggal_awal'])."\'");
            $w_akhir= stripslashes("\'".get_gmt_from_date($_POST['tanggal_akhir'])."\'");
            $status= $_POST['status'];
        }

        if ($_POST['kondisi']) {
            $kondisi=$_POST['kondisi'];
        }

        
        $data_print = $this->Model_Laporan->laporan_serah_terima($w_awal,$w_akhir,$status);
        $data['title']='Laporan Serah Terima ';
        $data['w_awal']=$_POST['tanggal_awal'];
        $data['w_akhir']=$_POST['tanggal_akhir'];
        
        $data['record']=$data_print;
	
        if ($data) {
        //print_r($data_print);

        require_once("dompdf/dompdf_config.inc.php");
        $dompdf = new DOMPDF();

        //Load html view
	    $html=$this->load->view('pdf_serah_terima', $data,TRUE);
        $dompdf->load_html($html);
	    $dompdf->set_paper('A4', 'landscape');
	    $dompdf->render();
	    $dompdf->stream('tes.pdf',array('Attachment' =>0)); 
         
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(base_url('laporan'));
        }
    }


public function tes()
{
    $record=$this->Model_Laporan->urut_jenis();

      foreach ($record as $data) {
        echo $data['kondisi'];
        echo '<br>';
        foreach ($data['detail'] as $key) {
            echo $key['nama_product'];
            echo '<br>';
        }
    }
   

   // print_r($record);

}

}

/* End of file daftar_struk.php */
/* Location: ./application/controllers/M_kategori.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-02-02 07:57:08 */
/* http://harviacode.com */
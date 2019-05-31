    <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_piutang extends CI_Controller {

 

    public function __construct()

    {

        parent::__construct();
        $this->load->model(array('Model_laporan_piutang'));
        $this->load->library('datatables');
        $user = wp_get_current_user();
         /* if ( !in_array( 'akunting', (array) $user->roles ) ) {
                
                redirect(base_url('denied'));
            } */
         
    }
/* Kontent */
    function list_coa_piutang()
    {
        echo json_encode($this->Model_laporan_piutang->list_coa_piutang());
    }

    public function jsondaftarjurnal()
    {
        header('Content-Type: application/json');
        echo $this->Model_laporan_piutang->jsondaftarjurnal();
    }

/* ------------------------------------------------------------------------------------- */
    /* Laporan Piutang */
    public function index()
    {
        $this->template->load('template_admin','halaman_awal');
    }
    
    /* Voucher piutang */
    public function voucher_piutang()
    {
        $this->template->load('template_admin','akuntansi_piutang_list');
    }
    public function detail_voucher($uniqid) 
    {
        $data_record = $this->Model_laporan_piutang->tampilvoucher($uniqid);
        $data['title']='Struk';
        $data['record']=$data_record;
	
        if ($data) {
        //print_r($data_print);

        //Load html view
	    $html=$this->template->load('template_admin','akuntansi_piutang_detail', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(base_url('akuntansi/verifikasi_jurnal'));
        }
    }
    
    public function tampilcurrentvoucher($uniqid) 
    {
        $data_record = $this->Model_laporan_piutang->tampilvoucher($uniqid);
        $data['title']='Struk';
        $data['record']=$data_record;
	
        if ($data) {
        //print_r($data_print);

        //Load html view
	    $html=$this->load->view('akuntansi_piutang_detail', $data);
        }
    }

    public function print_voucher($uniqid) 
    {
        $data_print = $this->Model_laporan_piutang->tampilvoucher($uniqid);
        $data['title']='Struk';
        $data['record']=$data_print;
	
        if ($data) {
        //print_r($data_print);

        require_once("dompdf/dompdf_config.inc.php");
        $dompdf = new DOMPDF();

        //Load html view
	    $html=$this->load->view('akuntansi_piutang_detail', $data,TRUE);
        $dompdf->load_html($html);
	    $dompdf->set_paper('A4', 'potrait');
	    $dompdf->render();
	    $dompdf->stream('tes.pdf',array('Attachment' =>0));
        
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(base_url('akuntansi/verifikasi_jurnal'));
        }
    }

    
    //Piutang
    public function tampil_piutang()
    {
        $hari=NULL;
        $hari_akhir=NULL;
        $coa=NULL;
        $status=$_POST['status'];
        if ($_POST['hari'] && $_POST['hari_akhir']) {
            $hari= stripslashes("\'".get_gmt_from_date($_POST['hari'])."\'");
            $hari_akhir= stripslashes("\'".get_gmt_from_date($_POST['hari_akhir'])."\'");
            $data['hari'] = $_POST['hari'] .' s/d '.$_POST['hari_akhir'];
        }
            $coa=$_POST['coa'];

        $data['record']=$this->Model_laporan_piutang->tampil_piutang($coa,$hari,$hari_akhir);
        
        if (!$data['record']) {
                $this->session->set_flashdata('message_failed', 'Data Tidak Ditemukan');
                redirect(base_url('laporan_jurnal_buku_besar'),'refresh');
                
        }
            
        
        if ($status=='pdf') {
            require_once("dompdf/dompdf_config.inc.php");
            $dompdf = new DOMPDF();
            //Load html view
            $html=$this->load->view('akuntansi_tampil_piutang',$data,TRUE);
            $dompdf->load_html($html);
            $dompdf->set_paper('A4', 'potrait');
            $dompdf->render();
            $dompdf->stream('tes.pdf',array('Attachment' =>0));
        }
        else {
                $namaFile = "Piutang.xls";
                $judul = "Piutang";
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
                xlsWriteLabel(0, 0, "Piutang");
                xlsWriteLabel(1, 0, "Periode ".$data['hari']."");
                xlsWriteLabel(2, 0, "Coa ".$data['record'][0]['id_coa']." ".$data['record'][0]['nama_coa']."");
                xlsWriteLabel(2, 1, "".$data['record'][0]['id_coa']." ".$data['record'][0]['nama_coa']."");

                $kolomhead = 0;

                xlsWriteLabel($tablehead, $kolomhead++, "Waktu");
                xlsWriteLabel($tablehead, $kolomhead++, "Id jurnal");
                xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");
                xlsWriteLabel($tablehead, $kolomhead++, "Debit");
                xlsWriteLabel($tablehead, $kolomhead++, "Kredit");
                xlsWriteLabel($tablehead, $kolomhead++, "Saldo");
                
                $gt_tabelbody=0;
                $gt_kolombody=0;
                $kolombody = 0;
                
                $total_kredit=0;
                $total_debit=0;
                $total_saldo=0;

                 $kolombody++;
                 $kolombody++;
                xlsWriteLabel($tablebody, $kolombody++,'Saldo Awal');
                 $kolombody++;
                 $kolombody++;
                            
                xlsWriteLabel($tablebody, $kolombody++,$data['record'][0]['saldo_awal_ok']);
                $tablebody++;
                
                foreach ($data['record'] as $recorddata)//$this->Model_Admin->laporan_excel_penjualan($w_awal,$w_akhir) as $record) {
                {

                    $kolombody = 0;
                    
                    $total_saldo=$recorddata['saldo'];
                    $total_kredit=$total_kredit+$recorddata['kredit'];
                    $total_debit=$total_debit+$recorddata['debit'];
                    
                    //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
                    
                    xlsWriteLabel($tablebody, $kolombody++,$recorddata['waktu']);
                    xlsWriteLabel($tablebody, $kolombody++,$recorddata['id_detail']);
                    xlsWriteLabel($tablebody, $kolombody++,$recorddata['keterangan']);
                    xlsWriteLabel($tablebody, $kolombody++,$recorddata['debit']);
                    xlsWriteLabel($tablebody, $kolombody++,$recorddata['kredit']);
                    xlsWriteLabel($tablebody, $kolombody++,$recorddata['saldo']);
                    $tablebody++;
                }
                    $kolombody = 0;
                    xlsWriteLabel($tablebody, $kolombody++,'Total');
                    xlsWriteLabel($tablebody, $kolombody++,'');
                    xlsWriteLabel($tablebody, $kolombody++,'');
                    xlsWriteLabel($tablebody, $kolombody++,$total_debit);
                    xlsWriteLabel($tablebody, $kolombody++,$total_kredit);
                    xlsWriteLabel($tablebody, $kolombody++,$total_saldo);

                xlsEOF();
                exit();
        }
    }

}
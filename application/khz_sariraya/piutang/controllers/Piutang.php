<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Piutang extends CI_Controller {

public $nama_template='template_admin';

public function __construct() {
    parent::__construct();
    $user = wp_get_current_user();
    $this->status_timbangan=get_option('buka_timbangan');
    $this->load->model('Model_Piutang');
    $this->load->helper('nuris_helper');

    if ($this->status_timbangan=='') {  
            $this->session->set_flashdata('message_failed', 'Buka Timbangan terlebih dahulu');
            redirect(base_url('tutup_buku'));
        }
    if ( !in_array( 'penimbang', (array) $user->roles ) ) {
                 redirect(base_url('denied'));
             }
    $this->id_penimbang=get_current_user_id();
    $this->priode=get_option('buka_timbangan');
    
}

    
    public function index()
    {
        $user = wp_get_current_user();
        $data['nama_penimbang'] = $user->display_name;
        
        $this->template->load($this->nama_template,'piutang',$data);
    }

    
/* Kontent */
    
    public function list_customer_coa_piutang()
    {
        $data=$this->Model_Piutang->list_customer_coa_piutang();
        echo json_encode($data);
    }
    
    public function list_jumlah_timbang()
    {
        $data=$this->Model_Piutang->list_jumlah_timbang();
        echo json_encode($data);
    }

/* Aksi */
    
    function piutang_timbangan($type="piutang")
    {
        
        $data['header']=array(  'eod' =>get_option('buka_timbangan') ,
                                'status'=>1,
                                'user_pembuat'=>$this->id_penimbang,
                                'id_tipe_voucher'=>'PD' 
                                );
                                
        if ($type=='piutang') {
            $id_coa_kredit=get_option('coa_pendapatan');
            $id_coa_debit=$this->input->post('id_coa_customer');
        } else {
            $id_coa_debit=get_option('coa_kas');
            $id_coa_kredit=$this->input->post('id_coa_customer');
        }
        

        $data['kredit']=array(  'id_coa' =>$id_coa_kredit ,
                                'kredit'=>$this->input->post['nilai'],
                                'keterangan'=>$this->input->post('keterangan') );

        $data['debit']=array(   'id_coa' =>$id_coa_debit ,
                                'debit'=>$this->input->post['nilai'],
                                'keterangan'=>$this->input->post('keterangan') );

        $alamat_api=base_url('akuntansi/jurnalumum/simpan_api');

        $result=$this->curl->simple_post($alamat_api,$data);
        echo "<pre>";
        print_r( $data);
        echo $alamat_api;
        print_r(json_decode($result));
        echo "</pre>";
    }

}

/* End of file Controllername.php */


<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Timbangan extends CI_Controller {

public $nama_template='template_admin';
public $id_penimbang='';
public $id_group='kasir';

public $data_product=[];
public $uniqid=NULL;
public $coa_kas=0;
public $kelipatan_point=0;
public $persen_pajak=0;
public $status_kasir='';

public function __construct() {
    parent::__construct();
    $user = wp_get_current_user();
    $this->status_timbangan=get_option('buka_timbangan');
    $this->load->model('Model_Timbangan');
    $this->load->helper('nuris_helper');

    if ($this->status_timbangan=='') {  
            $this->session->set_flashdata('message_failed', 'Buka Timbangan terlebih dahulu');
            redirect(base_url('tutup_buku'));
        }
    if ( !in_array( 'penimbang', (array) $user->roles ) ) {
                 redirect(base_url('denied'));
             }
    $this->id_penimbang=get_current_user_id();
    
}

    
    public function index()
    {
        $user = wp_get_current_user();
        $data['nama_penimbang'] = $user->display_name;
        $this->template->load($this->nama_template,'timbangan_utama',$data);
    }

    public function status_kasir()
    {
        $priode=get_option( 'buka_kasir' );
        $data['tanggal_buka']="";
        if ($priode<>'') {
            $x=strtotime($priode);
            $data['tanggal_buka']=date("d-m-Y", $x);
        }

        $this->template->load($this->nama_template,'status_kasir',$data);
    }
    
/* Kontent */
    public function kontent_table_pesanan()
    {
        
        $this->load->view('kontent_kasir/kontent_table_pesanan');
         
    }
    
    function tampilformvoid($uniqid)
    {
        
        $data['uniqid'] = $uniqid;
        $this->load->view('kontent_kasir/kontent_form_void', $data);
        
    }

/* Aksi */
    
    function hitung_timbangan()
    {
        
        $data['kendaraan']=$this->input->post('kendaraan');
        $data['customer']=$this->input->post('customer');
        $data['bruto']=$this->input->post('bruto');
        $data['tarra']=$this->input->post('tarra');
        $data['persen_potongan']=$this->input->post('persen_potongan');
        $data['nilai']=$this->input->post('nilai');

        $hasil['netto']          =$data['bruto']-$data['tarra'] ;
        $hasil['nilai_potongan'] =$hasil['netto']*$data['persen_potongan']/100 ;
        $hasil['total_bersih']   =$hasil['netto']-$hasil['nilai_potongan'];
        $hasil['jumlah']         =$hasil['total_bersih']*$data['nilai'];
        
        echo "
             <p>Bruto = ".$data['bruto']." </p>
             <p>Tarra = ".$data['tarra']." </p>
             <p>Netto = ".$hasil['netto']." </p>
             <p>Potongan (%) = ".$data['persen_potongan']."% </p>
             <p>Nilai Potongan = ".$hasil['nilai_potongan']." </p>
             <p>Total = ".$hasil['total_bersih']." </p>
             <p>Harga = ".$data['nilai']." </p>
             <p>Jumlah = ".$hasil['jumlah']." </p>

        
             ";
    }
    
    function void_item($uniqid)
    {
        $username=$this->input->post('uservoid');
        $password=$this->input->post('passvoid');
        $checker=wp_authenticate_username_password( NULL,$username,$password);
        $capability="void_item";

        if (!is_wp_error($checker)) {
            if (user_can( $checker, $capability )) {
                if($this->Model_Kasir->void_item($uniqid))
                {
                    echo "Berhasil Void";
                }
            }
        }
        
        redirect('kasir','refresh');

    } 

    function masuktimbangan()
    {
        $pencatatan= array(
            'id_pencatat'=>$this->id_kasir,
            'id_timbang'=>0);
        $uniqid=$this->input->post('uniqid',TRUE);
        
        $data['kendaraan']=$this->input->post('kendaraan');
        $data['customer']=$this->input->post('customer');
        $data['product']=$this->input->post('product');
        $data['bruto']=$this->input->post('bruto');
        $data['tarra']=$this->input->post('tarra');
        $data['persen_potongan']=$this->input->post('persen_potongan');
        $data['nilai']=$this->input->post('nilai');

        $hasil['netto']          =$data['bruto']-$data['tarra'] ;
        $hasil['nilai_potongan'] =$hasil['netto']*$data['persen_potongan']/100 ;
        $hasil['total_bersih']   =$hasil['netto']-$hasil['nilai_potongan'];
        $hasil['jumlah']         =$hasil['total_bersih']*$data['nilai'];

            if (is_null($uniqid)) {
            $uniqid=uniqid("",TRUE);
            //Header
            $this->Model_Timbangan->pemesanan('timbangan_h_penimbangan',$pencatatan,$uniqid);
            }

            //Detail Pemesanan
                $insert = array(    'id_product' =>$data['product'],
                                    'id_kendaraan' =>$data['kendaraan'],
                                    'id_customer' =>$data['customer'],
                                    'bruto'=>$data['bruto'],
                                    'tarra'=>$data['tarra'],
                                    'netto'=>$hasil['netto'],
                                    'persen_potongan'=>$data['persen_potongan'],
                                    'nilai_potongan'=>$hasil['nilai_potongan'],
                                    'nilai_persatuan'=>$data['nilai'],
                                    'total_bersih'=>$hasil['total_bersih'],
                                    'jumlah'=>$hasil['jumlah'],
                                    );

                $this->Model_Timbangan->detailpemesanan('timbangan_detail_penimbangan',$insert,$uniqid);

                echo base_url('daftar_struk/read/'.$uniqid);

    }

}

/* End of file Controllername.php */


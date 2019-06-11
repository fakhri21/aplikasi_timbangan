<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Konfigurasi extends CI_Model {

    public function __construct()
	{
		parent::__construct();
    }

    public function get_coa_kas()
    {
        $this->db->select('isi');
        $this->db->from('konfigurasi');
        $this->db->where_in('nama_konfigurasi','coa kas');
        return $this->db->get()->row_array();
    }
    
    public function get_priode_harian_akuntansi()
    {
        $this->db->select('isi');
        $this->db->from('konfigurasi');
        $this->db->where("(nama_konfigurasi='buka_akuntansi_bulan' OR nama_konfigurasi='buka_akuntansi')",NULL,FALSE);
        return $this->db->get()->result_array();
    }
    
    public function get_priode_harian_kasir()
    {
        $this->db->select('isi');
        $this->db->from('konfigurasi');
        $this->db->where_in('nama_konfigurasi','buka_kasir');
        return $this->db->get()->row_array();
    }
    
    public function get_penyetuju_jurnal()
    {
        $this->db->get_penyetuju_jurnal();
        return $data['nama'];
    }
    
    public function get_pemeriksa_jurnal()
    {
        $this->db->get_penyetuju_jurnal();
        return $data['nama'];
    }
    
    public function get_facebook()
    {
        $this->db->from('konfigurasi');
        $this->db->where_in('nama_konfigurasi','facebook');
        return $this->db->get()->row_array();
    }
    
    public function get_twitter()
    {
        $this->db->get_twitter();
        return $data['twitter'];
    }
    
    public function get_blogger()
    {
        $this->db->get_blogger();
        return $data['blog'];
    }
    
    public function get_email()
    {
        $this->db->get_email();
        return $data['email'];
    }
    
    public function get_maps()
    {
        $this->db->get_maps();
        return $data['maps'];
    }
    
    public function get_instagram()
    {
        $this->db->get_instagram();
        return $data['instagram'];
    }
    
}

/* End of file ModelName.php */

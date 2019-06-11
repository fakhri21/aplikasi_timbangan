<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Piutang extends CI_Model {

/* Aksi */    
	

	
/* Kontent */
	function cek_coa_piutang($id_customer)
	{
		
		$this->db->select('id_coa');
		$this->db->from('timbangan_m_customer a');
		$this->db->where('uniqid', $id_customer);
		$this->db->join('akuntansi_m_coa b', 'a.uniqid_coa_piutang = b.uniqid', 'left');
		$data=$this->db->get()->row();
		return $data->id_coa;
	}
	
	function cek_nilai_timbang($uniqid)
	{
		$this->db->select('	bruto,
							netto,
							persen_potongan,
							nilai_persatuaan');
		$this->db->from('timbangan_laporan_penimbangan');
		$this->db->where('uniqid_header', $uniqid);
		$this->db->group_by('uniqid_header');
		
		return $this->db->get()->row_array();
		
	}

	function list_customer_coa_piutang()
	{
		$this->db->select('nama,uniqid_coa_piutang');
		$this->db->from('timbangan_m_customer');
		return $this->db->get()->result_array();
		
	}
	
	function list_jumlah_timbang()
	{
		$this->db->select('id_timbang,jumlah');
		$this->db->where('status_timbang', 1);
		$this->db->from('timbangan_laporan_penimbangan');
		return $this->db->get()->result_array();
		
	}

	

}
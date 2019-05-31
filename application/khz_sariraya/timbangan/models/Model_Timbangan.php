<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Timbangan extends CI_Model {

/* Aksi */    

	function penimbangan($table,$data,$uniqid)
    {
        $this->db->set('uniqid',$uniqid);
		$this->db->insert($table,$data);
    }

	function detailpenimbangan($table,$data,$uniqid)
	{
		$this->db->set('uniqid','UUID_SHORT()',FALSE);
		$this->db->set('uniqid_header',$uniqid);
		return $this->db->insert($table,$data);
	}
	
	function isi_timbangan($table,$data,$uniqid)
	{
		
		$this->db->where('uniqid_header', $uniqid);
		$this->db->update($table, $data);
		
	}
	

	
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
							nilai_persatuan');
		$this->db->from('timbangan_laporan_penimbangan');
		$this->db->where('uniqid_header', $uniqid);
		$this->db->group_by('uniqid_header');
		
		return $this->db->get()->row_array();
		
	}

	function list_customer()
	{
		$this->db->select('*');
		$this->db->from('m_customer');
		return $this->db->get()->result_array();
		
	}

	

}
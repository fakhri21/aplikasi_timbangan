<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_laporan_piutang extends CI_Model {

function list_coa_piutang()
{
    
    $this->db->select('a.*');
    $this->db->from('akuntansi_m_coa a');
    $this->db->join('akuntansi_m_kelompok_coa b', 'a.id_kelompok_coa = b.uniqid', 'left');
    $this->db->where('b.id_kelompok_coa=1013000 ');
    return $this->db->get()->result_array();
    
}


//tampil piutang
function tampil_piutang($coa,$hari,$hari_akhir)
{    
    $this->db->select('DATE_FORMAT(waktu,"%d-%m-%Y") as waktu,id_detail,keterangan,debit,kredit,id_coa,nama_coa,(x.saldo_sebelumnya+akuntansi_buku_besar.saldo_awal)as saldo_awal_ok,(x.saldo_sebelumnya+akuntansi_buku_besar.saldo_awal+@s:=@s+nilai_voucher) as saldo');
    if ($hari<>NULL) {
        $this->db->from('akuntansi_buku_besar,
                    (select @s:=0) as v_saldo,
                    (select sum(if(DATE(eod)<DATE('.$hari.'),(nilai_voucher),0)) as saldo_sebelumnya from akuntansi_buku_besar where id_coa='.$coa.' ) as x 
                    ');
        $this->db->where('eod between date('.$hari.') and date('.$hari_akhir.')' );
    
    }
    else {
        $this->db->from('akuntansi_buku_besar,
                    (select @s:=0) as v_saldo0,
                    (select sum(if(DATE(eod)<curdate() and date(eod)>0,(nilai_voucher),0)) as saldo_sebelumnya from akuntansi_buku_besar where id_coa='.$coa.' ) as x 
                    ');    
        $this->db->where('eod',0);
    }
    $this->db->where('status',1);
    $this->db->where('id_coa',$coa);
    $this->db->order_by('id_detail', 'asc');
    
    
    return $this->db->get()->result_array();   
}


//voucher piutang
function jsondaftarjurnal() {
    $this->datatables->select('uniqid,id_voucher,concat(id_tipe_voucher,DATE_FORMAT(waktu,"%y%m"),right(concat(prefix_number,id_voucher),4))as id_voucherjurnal,DATE_FORMAT(waktu,"%d-%m-%Y") as waktu,status');
    $this->datatables->from('akuntansi_h_voucher');
    $this->datatables->where('id_tipe_voucher', 'PD'); 
    $this->datatables->add_column('action',"tes");
    return $this->datatables->generate();
}

function tampilvoucher($uniqid)
{
    $this->db->select('*');
		$this->db->from('akuntansi_voucher_jurnal a');
		$this->db->where('a.uniqid',$uniqid);
        $this->db->where('id_tipe_voucher', 'PD'); 
        $this->db->group_by('id_session');
        $this->db->order_by('id_detail', 'asc');
        
        
        return $this->db->get()->result_array();
		
}

}

/* End of file ModelName.php */

<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_kendaraan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_kendaraan');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template_admin','m_kendaraan/timbangan_m_kendaraan_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Model_kendaraan->json();
    }

    public function read($id) 
    {
        $row = $this->Model_kendaraan->get_by_id($id);
        if ($row) {
            $data = array(
		'uniqid' => $row->uniqid,
		'id_kendaraan' => $row->id_kendaraan,
		'no_plat' => $row->no_plat,
		'nama_kendaraan' => $row->nama_kendaraan,
		'nilai_tarra' => $row->nilai_tarra,
	    );
            $this->template->load('template_admin','m_kendaraan/timbangan_m_kendaraan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(base_url('m_kendaraan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => base_url('m_kendaraan/create_action'),
	    'uniqid' => set_value('uniqid'),
	    'id_kendaraan' => set_value('id_kendaraan'),
	    'no_plat' => set_value('no_plat'),
	    'nama_kendaraan' => set_value('nama_kendaraan'),
	    'nilai_tarra' => set_value('nilai_tarra'),
	);
        $this->template->load('template_admin','m_kendaraan/timbangan_m_kendaraan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_kendaraan' => $this->input->post('id_kendaraan',TRUE),
		'no_plat' => $this->input->post('no_plat',TRUE),
		'nama_kendaraan' => $this->input->post('nama_kendaraan',TRUE),
		'nilai_tarra' => $this->input->post('nilai_tarra',TRUE),
	    );

            $this->Model_kendaraan->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(base_url('m_kendaraan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Model_kendaraan->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => base_url('m_kendaraan/update_action'),
		'uniqid' => set_value('uniqid', $row->uniqid),
		'id_kendaraan' => set_value('id_kendaraan', $row->id_kendaraan),
		'no_plat' => set_value('no_plat', $row->no_plat),
		'nama_kendaraan' => set_value('nama_kendaraan', $row->nama_kendaraan),
		'nilai_tarra' => set_value('nilai_tarra', $row->nilai_tarra),
	    );
            $this->template->load('template_admin','m_kendaraan/timbangan_m_kendaraan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(base_url('m_kendaraan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('uniqid', TRUE));
        } else {
            $data = array(
		'id_kendaraan' => $this->input->post('id_kendaraan',TRUE),
		'no_plat' => $this->input->post('no_plat',TRUE),
		'nama_kendaraan' => $this->input->post('nama_kendaraan',TRUE),
		'nilai_tarra' => $this->input->post('nilai_tarra',TRUE),
	    );

            $this->Model_kendaraan->update($this->input->post('uniqid', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(base_url('m_kendaraan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Model_kendaraan->get_by_id($id);

        if ($row) {
            $this->Model_kendaraan->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(base_url('m_kendaraan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(base_url('m_kendaraan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_kendaraan', 'id kendaraan', 'trim|required');
	$this->form_validation->set_rules('no_plat', 'no plat', 'trim|required');
	$this->form_validation->set_rules('nama_kendaraan', 'nama kendaraan', 'trim|required');
	$this->form_validation->set_rules('nilai_tarra', 'nilai tarra', 'trim|required|numeric');

	$this->form_validation->set_rules('uniqid', 'uniqid', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "timbangan_m_kendaraan.xls";
        $judul = "timbangan_m_kendaraan";
        $tablehead = 0;
        $tablebody = 1;
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

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Kendaraan");
	xlsWriteLabel($tablehead, $kolomhead++, "No Plat");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Kendaraan");
	xlsWriteLabel($tablehead, $kolomhead++, "Nilai Tarra");

	foreach ($this->Model_kendaraan->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->id_kendaraan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_plat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_kendaraan);
	    xlsWriteNumber($tablebody, $kolombody++, $data->nilai_tarra);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file M_kendaraan.php */
/* Location: ./application/controllers/M_kendaraan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-05-06 16:43:01 */
/* http://harviacode.com */
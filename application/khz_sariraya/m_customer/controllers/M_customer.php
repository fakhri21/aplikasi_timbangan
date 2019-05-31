<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_customer extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_customer');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template_admin','m_customer/timbangan_m_customer_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Model_customer->json();
    }

    public function read($id) 
    {
        $row = $this->Model_customer->get_by_id($id);
        if ($row) {
            $data = array(
		'uniqid' => $row->uniqid,
		'nama' => $row->nama,
		'alamat' => $row->alamat,
		'no_handphone' => $row->no_handphone,
		'email' => $row->email,
	    );
            $this->template->load('template_admin','m_customer/timbangan_m_customer_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(base_url('m_customer'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => base_url('m_customer/create_action'),
	    'uniqid' => set_value('uniqid'),
	    'nama' => set_value('nama'),
	    'alamat' => set_value('alamat'),
	    'no_handphone' => set_value('no_handphone'),
	    'email' => set_value('email'),
	);
        $this->template->load('template_admin','m_customer/timbangan_m_customer_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'no_handphone' => $this->input->post('no_handphone',TRUE),
		'email' => $this->input->post('email',TRUE),
		'uniqid_coa_piutang' => $this->input->post('coa_piutang',TRUE)
	    );

            $this->Model_customer->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(base_url('m_customer'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Model_customer->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => base_url('m_customer/update_action'),
		'uniqid' => set_value('uniqid', $row->uniqid),
		'nama' => set_value('nama', $row->nama),
		'alamat' => set_value('alamat', $row->alamat),
		'no_handphone' => set_value('no_handphone', $row->no_handphone),
		'email' => set_value('email', $row->email),
	    );
            $this->template->load('template_admin','m_customer/timbangan_m_customer_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(base_url('m_customer'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('uniqid', TRUE));
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'no_handphone' => $this->input->post('no_handphone',TRUE),
		'email' => $this->input->post('email',TRUE),
        'uniqid_coa_piutang' => $this->input->post('coa_piutang',TRUE),
	    );

            $this->Model_customer->update($this->input->post('uniqid', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(base_url('m_customer'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Model_customer->get_by_id($id);

        if ($row) {
            $this->Model_customer->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(base_url('m_customer'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(base_url('m_customer'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('no_handphone', 'no handphone', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');

	$this->form_validation->set_rules('uniqid', 'uniqid', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "timbangan_m_customer.xls";
        $judul = "timbangan_m_customer";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
	xlsWriteLabel($tablehead, $kolomhead++, "No Handphone");
	xlsWriteLabel($tablehead, $kolomhead++, "Email");

	foreach ($this->Model_customer->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_handphone);
	    xlsWriteLabel($tablebody, $kolombody++, $data->email);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file M_customer.php */
/* Location: ./application/controllers/M_customer.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-05-06 16:30:13 */
/* http://harviacode.com */
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class obatnr extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('obatnr_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'obatnr/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'obatnr/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'obatnr/index.html';
            $config['first_url'] = base_url() . 'obatnr/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->obatnr_model->total_rows($q);
        $obatnr = $this->obatnr_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'obatnr_data' => $obatnr,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'obatnr/obatnr_list',
            'judul' => ' Obat Non Racik',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->obatnr_model->get_by_id($id);
        if ($row) {
            $data = array(
        'obatnr_id' => $row->obatnr_id,
        'obatalkes_kode' => $row->obatalkes_kode,
		'obatalkes_nama' => $row->obatalkes_nama,
        'signa_nama' => $row->signa_nama,
        'stok' => $row->stok
	    );
            $this->load->view('obatnr/obatnr_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('obatnr'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('obatnr/create_action'),
        'obatnr_id' => set_value('obatnr_id'),
	    'obatalkes_kode' => set_value('obatalkes_kode'),
        'obatalkes_nama' => set_value('obatalkes_nama'),
        'signa_nama' => set_value('signa_nama'),
        'stok' => set_value('stok'),
        'konten' => 'obatnr/obatnr_form',
            'judul' => ' Obat Non Racik ',
	);
        $this->load->view('v_index', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
        'obatalkes_kode' => $this->input->post('obatalkes_kode',TRUE),
		'obatalkes_nama' => $this->input->post('obatalkes_nama',TRUE),
        'signa_nama' => $this->input->post('signa_nama',TRUE),
        'stok' => $this->input->post('stok',TRUE),
	    );

            $this->obatnr_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('obatnr'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->obatnr_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('obatnr/update_action'),
        'obatnr_id' => set_value('obatnr_id', $row->obatnr_id),
		'obatalkes_kode' => set_value('obatalkes_kode', $row->obatalkes_kode),
        'obatalkes_nama' => set_value('obatalkes_nama',$row->obatalkes_nama),
        'signa_nama' => set_value('signa_nama',$row->signa_nama),
        'stok' => set_value('stok',$row->stok), 
        'konten' => 'obatnr/obatnr_form',
            'judul' => ' Obat Non Racik',
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('obatnr'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('obatnr_id', TRUE));
        } else {
            $data = array(
        'obatalkes_kode' => $this->input->post('obatalkes_kode',TRUE),
        'obatalkes_nama' => $this->input->post('obatalkes_nama',TRUE),
        'signa_nama' => $this->input->post('signa_nama',TRUE),
        'stok' => $this->input->post('stok',TRUE),
	    );

            $this->obatnr_model->update($this->input->post('obatnr_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('obatnr'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->obatnr_model->get_by_id($id);

        if ($row) {
            $this->obatnr_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('obatnr'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('obatnr'));
        }
    }

    public function _rules() 
    {
    $this->form_validation->set_rules('obatalkes_kode', 'obatalkes_kode', 'trim|required');
    $this->form_validation->set_rules('obatalkes_nama', 'obatalkes_nama', 'trim|required');
    $this->form_validation->set_rules('signa_nama', 'signa_nama', 'trim|required');

    $this->form_validation->set_rules('stok', 'stok', 'trim|required');
	
	$this->form_validation->set_rules('obatnr_id', 'obatnr_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

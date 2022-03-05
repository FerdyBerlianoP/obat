<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class obatr extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('obatr_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'obatr/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'obatr/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'obatr/index.html';
            $config['first_url'] = base_url() . 'obatr/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->obatr_model->total_rows($q);
        $obatr = $this->obatr_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'obatr_data' => $obatr,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'obatr/obatr_list',
            'judul' => ' Obat Racik',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->obatr_model->get_by_id($id);
        if ($row) {
            $data = array(
        'obatr_id' => $row->obatr_id,
        'obatalkes_kode' => $row->obatalkes_kode,
		'obatr_nama' => $row->obatr_nama,
        'obatalkes_nama' => $row->obatalkes_nama,
        'obatr2' => $row->obatr2,
        'signa_nama' => $row->signa_nama,
        'stok' => $row->stok,
        'stokr2' => $row->stokr2
	    );
            $this->load->view('obatr/obatr_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('obatr'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('obatr/create_action'),
        'obatr_id' => set_value('obatr_id'),
	    'obatalkes_kode' => set_value('obatalkes_kode'),
        'obatr_nama' => set_value('obatr_nama'),
        'obatalkes_nama' => set_value('obatalkes_nama'),
        'obatr2' => set_value('obatr2'),
        'signa_nama' => set_value('signa_nama'),
        'stok' => set_value('stok'),
        'stokr2' => set_value('stokr2'),
        'konten' => 'obatr/obatr_form',
            'judul' => ' Obat Racik ',
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
		'obatr_nama' => $this->input->post('obatr_nama',TRUE),
        'obatalkes_nama' => $this->input->post('obatalkes_nama',TRUE),
        'obatr2' => $this->input->post('obatr2',TRUE),
        'signa_nama' => $this->input->post('signa_nama',TRUE),
        'stok' => $this->input->post('stok',TRUE),
        'stokr2' => $this->input->post('stokr2',TRUE),
	    );

            $this->obatr_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('obatr'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->obatr_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('obatr/update_action'),
        'obatr_id' => set_value('obatr_id', $row->obatr_id),
		'obatalkes_kode' => set_value('obatalkes_kode', $row->obatalkes_kode),
        'obatr_nama' => set_value('obatr_nama',$row->obatr_nama),
        'obatalkes_nama' => set_value('obatalkes_nama',$row->obatalkes_nama),
        'obatr2' => set_value('obatr2',$row->obatalkes_nama),
        'signa_nama' => set_value('signa_nama',$row->signa_nama),
        'stok' => set_value('stok',$row->stok),
        'stokr2' => set_value('stokr2',$row->stokr2),
        'konten' => 'obatr/obatr_form',
            'judul' => ' Obat Racik',
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('obatr'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('obatr_id', TRUE));
        } else {
            $data = array(
        'obatalkes_kode' => $this->input->post('obatalkes_kode',TRUE),
        'obatr_nama' => $this->input->post('obatr_nama',TRUE),
        'obatalkes_nama' => $this->input->post('obatalkes_nama',TRUE),
        'obatr2' => $this->input->post('obatr2',TRUE),
        'signa_nama' => $this->input->post('signa_nama',TRUE),
        'stok' => $this->input->post('stok',TRUE),
        'stokr2' => $this->input->post('stokr2',TRUE),
	    );

            $this->obatr_model->update($this->input->post('obatr_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('obatr'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->obatr_model->get_by_id($id);

        if ($row) {
            $this->obatr_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('obatr'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('obatr'));
        }
    }

    public function _rules() 
    {
    $this->form_validation->set_rules('obatalkes_kode', 'obatalkes_kode', 'trim|required');
    $this->form_validation->set_rules('obatr_nama', 'obatr_nama', 'trim|required');
    $this->form_validation->set_rules('obatalkes_nama', 'obatalkes_nama', 'trim|required');
    $this->form_validation->set_rules('obatr2', 'obatr2', 'trim|required');
    $this->form_validation->set_rules('signa_nama', 'signa_nama', 'trim|required');
    $this->form_validation->set_rules('stok', 'stok', 'trim|required');
    $this->form_validation->set_rules('stokr2', 'stokr2', 'trim|required');
	$this->form_validation->set_rules('obatr_id', 'obatr_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

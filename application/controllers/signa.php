
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class signa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('signa_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'signa/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'signa/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'signa/index.html';
            $config['first_url'] = base_url() . 'signa/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->signa_model->total_rows($q);
        $signa = $this->signa_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'signa_data' => $signa,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'signa/signa_list',
            'judul' => 'Aturan Minum',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->signa_model->get_by_id($id);
        if ($row) {
            $data = array(
        'signa_id' => $row->signa_id,
        'signa_kode' => $row->signa_kode,
		'signa_nama' => $row->signa_nama,
        'additional_data' => $row->additional_data,
        'created_date' => $row->created_date,
        'created_by' => $row->created_by,
        'modified_count' => $row->modified_count,
        'last_modified_date' => $row->last_modified_date,
        'last_modified_by' => $row->last_modified_by,
        'is_deleted' => $row->is_deleted,
        'is_active' => $row->is_active,
        'deleted_date' => $row->deleted_date,
        'deleted_by' => $row->deleted_by, 
	    );
            $this->load->view('signa/signa_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('signa'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('signa/create_action'),
        'signa_id' => set_value('signa_id'),
	    'signa_kode' => set_value('signa_kode'),
        'signa_nama' => set_value('signa_nama'),
        'additional_data' => set_value('additional_data'),
        'created_date' => set_value('created_date'),
        'created_by' => set_value('created_by'),
        'modified_count' => set_value('modified_count'),
        'last_modified_date' => set_value('last_modified_date'),
        'last_modified_by' => set_value('last_modified_by'),
        'is_deleted' => set_value('is_deleted'),
	    'is_active' => set_value('is_active'),
        'deleted_date' => set_value('deleted_date'),
        'deleted_by' => set_value('deleted_by'),
        'konten' => 'signa/signa_form',
            'judul' => ' Aturan Minum ',
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
        'signa_kode' => $this->input->post('signa_kode',TRUE),
		'signa_nama' => $this->input->post('signa_nama',TRUE),
        'additional_data' => $this->input->post('additional_data',TRUE),
        'created_date' => $this->input->post('created_date',TRUE),
        'created_by' => $this->input->post('created_by',TRUE),
        'modified_count' => $this->input->post('modified_count',TRUE),
        'last_modified_date' => $this->input->post('last_modified_date',TRUE),
        'last_modified_by' => $this->input->post('last_modified_by',TRUE),
        'is_deleted' => $this->input->post('is_deleted',TRUE),
        'is_active' => $this->input->post('is_active',TRUE),
        'deleted_date' => $this->input->post('deleted_date',TRUE),
        'deleted_by' => $this->input->post('deleted_by',TRUE),
	    );

            $this->signa_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('signa'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->signa_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('signa/update_action'),
        'signa_id' => set_value('signa_id', $row->signa_id),
		'signa_kode' => set_value('signa_kode', $row->signa_kode),
        'signa_nama' => set_value('signa_nama',$row->signa_nama),
        'additional_data' => set_value('additional_data',$row->additional_data),
        'created_date' => set_value('created_date',$row->created_date),
        'created_by' => set_value('created_by',$row->created_by),
        'modified_count' => set_value('modified_count',$row->modified_count),
        'last_modified_date' => set_value('last_modified_date',$row->last_modified_date),
        'last_modified_by' => set_value('last_modified_by',$row->last_modified_by),
        'is_deleted' => set_value('is_deleted',$row->is_deleted),
        'is_active' => set_value('is_active',$row->is_active),
        'deleted_date' => set_value('deleted_date',$row->deleted_date),
        'deleted_by' => set_value('deleted_by',$row->deleted_by), 
        'konten' => 'signa/signa_form',
            'judul' => ' Aturan Minum',
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('signa'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('signa_id', TRUE));
        } else {
            $data = array(
        'signa_kode' => $this->input->post('signa_kode',TRUE),
        'signa_nama' => $this->input->post('signa_nama',TRUE),
        'additional_data' => $this->input->post('additional_data',TRUE),
        'created_date'=>  $this->input->post('created_date',TRUE),
        'created_by' => $this->input->post('created_by',TRUE),
        'modified_count' => $this->input->post('modified_count',TRUE),
        'last_modified_date' => $this->input->post('last_modified_date',TRUE),
        'last_modified_by'=> $this->input->post('last_modified_by',TRUE),
        'is_deleted' => $this->input->post('is_deleted',TRUE),
        'is_active' => $this->input->post('is_active',TRUE),
        'deleted_date' => $this->input->post('deleted_date',TRUE),
        'deleted_by' => $this->input->post('deleted_by',TRUE),
	    );

            $this->signa_model->update($this->input->post('signa_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('signa'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->signa_model->get_by_id($id);

        if ($row) {
            $this->signa_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('signa'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('signa'));
        }
    }

    public function _rules() 
    {
    $this->form_validation->set_rules('signa_kode', 'signa_kode', 'trim|required');
    $this->form_validation->set_rules('signa_nama', 'signa_nama', 'trim|required');
    $this->form_validation->set_rules('additional_data', 'additional_data', 'trim|required');
    $this->form_validation->set_rules('created_date', 'created_date', 'trim|required');
    $this->form_validation->set_rules('created_by', 'created_by', 'trim|required');
    $this->form_validation->set_rules('modified_count', 'modified_count', 'trim|required');
    $this->form_validation->set_rules('last_modified_date', 'last_modified_date', 'trim|required');
    $this->form_validation->set_rules('last_modified_by', 'last_modified_by', 'trim|required');
    $this->form_validation->set_rules('is_deleted', 'is_deleted', 'trim|required');
    $this->form_validation->set_rules('is_active', 'is_active', 'trim|required');
    $this->form_validation->set_rules('deleted_date', 'deleted_date', 'trim|required');
    $this->form_validation->set_rules('deleted_by', 'deleted_by', 'trim|required');
	
	$this->form_validation->set_rules('signa_id', 'signa_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

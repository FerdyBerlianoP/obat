
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class obatalkes extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('obatalkes_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'obatalkes/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'obatalkes/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'obatalkes/index.html';
            $config['first_url'] = base_url() . 'obatalkes/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->obatalkes_model->total_rows($q);
        $obatalkes = $this->obatalkes_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'obatalkes_data' => $obatalkes,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'obatalkes/obatalkes_list',
            'judul' => ' obat',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->obatalkes_model->get_by_id($id);
        if ($row) {
            $data = array(
        'obatalkes_id' => $row->obatalkes_id,
        'obatalkes_kode' => $row->obatalkes_kode,
		'obatalkes_nama' => $row->obatalkes_nama,
        'stok' => $row->stok,
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
            $this->load->view('obatalkes/obatalkes_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('obatalkes'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('obatalkes/create_action'),
        'obatalkes_id' => set_value('obatalkes_id'),
	    'obatalkes_kode' => set_value('obatalkes_kode'),
        'obatalkes_nama' => set_value('obatalkes_nama'),
        'stok' => set_value('stok'),
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
        'konten' => 'obatalkes/obatalkes_form',
            'judul' => ' obat ',
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
        'stok' => $this->input->post('stok',TRUE),
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

            $this->obatalkes_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('obatalkes'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->obatalkes_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('obatalkes/update_action'),
        'obatalkes_id' => set_value('obatalkes_id', $row->obatalkes_id),
		'obatalkes_kode' => set_value('obatalkes_kode', $row->obatalkes_kode),
        'obatalkes_nama' => set_value('obatalkes_nama',$row->obatalkes_nama),
        'stok' => set_value('stok',$row->stok),
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
        'konten' => 'obatalkes/obatalkes_form',
            'judul' => ' obat',
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('obatalkes'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('obatalkes_id', TRUE));
        } else {
            $data = array(
        'obatalkes_kode' => $this->input->post('obatalkes_kode',TRUE),
        'obatalkes_nama' => $this->input->post('obatalkes_nama',TRUE),
        'stok' => $this->input->post('stok',TRUE),
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

            $this->obatalkes_model->update($this->input->post('obatalkes_id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('obatalkes'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->obatalkes_model->get_by_id($id);

        if ($row) {
            $this->obatalkes_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('obatalkes'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('obatalkes'));
        }
    }

    public function _rules() 
    {
    $this->form_validation->set_rules('obatalkes_kode', 'obatalkes_kode', 'trim|required');
    $this->form_validation->set_rules('obatalkes_nama', 'obatalkes_nama', 'trim|required');
    $this->form_validation->set_rules('stok', 'stok', 'trim|required');
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
	
	$this->form_validation->set_rules('obatalkes_id', 'obatalkes_id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

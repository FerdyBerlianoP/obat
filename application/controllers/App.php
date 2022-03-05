<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

	
	public function index()
	{
		if ($this->session->userdata('level') == "") {
            redirect('app/login');
        } 
        
        
		$data = array(
			'konten' => 'home',
            'judul' => 'Dashboard',
     
		);
		 //print_r($data);
		$this->load->view('v_index', $data);
	}


	public function login()
	{

		if ($this->input->post() == NULL) {
			$this->load->view('login');
		} else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$cek_user = $this->db->query("SELECT * FROM users WHERE username='$username' and password='$password' ");
			//$cek_supplier = $this->db->query("SELECT * FROM supplier WHERE username='$username' and password='$password'");
			if ($cek_user->num_rows() == 1) {
				foreach ($cek_user->result() as $row) {
					$sess_data['id_user'] = $row->id_user;
					$sess_data['nama'] = $row->nama_user;
					$sess_data['username'] = $row->username;
					$sess_data['level'] = $row->level;
					$this->session->set_userdata($sess_data);
				}
				//redirect('app');
			//}elseif ($cek_supplier->num_rows() == 1) {
				//foreach ($cek_supplier->result() as $row) {
					//$sess_data['id_user'] = $row->kode_supplier;
					//$sess_data['nama'] = $row->nama_supplier;
					//$sess_data['username'] = $row->username;
					//$sess_data['level'] = 'supplier';
					//$this->session->set_userdata($sess_data);
				//}
				redirect('app');
			} else {
				?>
				<script type="text/javascript">
					alert('Username Atau password kamu salah !');
					window.location="<?php echo base_url('app/login'); ?>";
				</script>
				<?php
			}

		}
	}

	function logout()
	{
		$this->session->unset_userdata('id_user');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('nama');
		$this->session->unset_userdata('level');
		session_destroy();
		redirect('app/login');
	}

	}
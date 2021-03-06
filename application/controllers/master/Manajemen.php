<?php 

class Manajemen extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('auth');
        //load model
        if(!$this->auth->is_logged_in()) {
			redirect(base_url());
        }
        if(!$this->auth->is_have_perm('masterdata_posisi'))
        redirect('');

        $this->load->model('master/manajemen_model', 'manajemen_model');
    }

    public function index(){
        $data['admins'] = $this->manajemen_model->getAdmin();
    
        $this->load->view('master/manajemen_pengguna/list_view', $data);
    }

    function add(){
        $data['outlets'] = $this->manajemen_model->showOutlet();
        $data['permGroups'] = $this->manajemen_model->perm_group();
        $this->load->view('master/manajemen_pengguna/add_form', $data);
    }

    public function store(){
        $manajemen = $this->manajemen_model;
        $validation = $this->form_validation;

        $validation->set_rules($manajemen->rules());        
        
        if($validation->run() != false){
            $manajemen->save();
            $this->session->set_flashdata('success', "User Berhasil Terdaftar");
        }else{
            $this->session->set_flashdata('failed', "User Gagal Terdaftar, Silahkan Cek Kembali Inputan Data");
        }
        redirect('master/manajemen/add');
    }

    public function edit($admin_id = null){
        if(!isset($admin_id)) redirect('master/manajemen');

        $manajemen = $this->manajemen_model;
        
        $validation = $this->form_validation;

        $validation->set_rules('admin_username', 'Username', 'trim|required');
        $validation->set_rules('admin_realname', 'Nama Lengkap', 'trim|required');
        $validation->set_rules('admin_email', 'Admin Email', 'trim|valid_email|required');

        if($validation->run() != false){
            $manajemen->update();
            $this->session->set_flashdata('success', "User Berhasil di Ubah");
        }

        $data['admin'] = $manajemen->getAdminbyId($admin_id);
        $data['outlets'] = $this->manajemen_model->showOutlet();
        $data['permGroups'] = $this->manajemen_model->perm_group();
        
        $this->load->view('master/manajemen_pengguna/edit_form', $data);
    }

    public function delete($admin_id = null){
        if(!isset($admin_id)) show_404();
        
        if($this->manajemen_model->hapus($admin_id)){
            redirect('master/manajemen');
        }
    }

}
?>
<?php 
class Categories011 extends CI_controller {

	public function __construct()
	{	
		parent::__construct();
		if (! $this->session->userdata('username')) redirect('auth011');
		$this->load->model('Categoriesmodel_011');
		$this->load->library('form_validation');

	}

	public function index()
	{
		$data['judul'] = 'List categories';
		$data['categories011'] = $this->Categoriesmodel_011->getAllCategories();
		if( $this->input->post('keyword') ) {
			$data['categories011'] = $this->Categoriesmodel_011->cariDataCategories();
		}
		$this->load->view('templates011/header', $data);
		$this->load->view('categories011/index', $data);
		$this->load->view('templates011/footer');
	}
	
	public function tambah()
	{
		$data['judul'] = 'Form Tambah Data Categories';

		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');

		if( $this->form_validation->run() == FALSE ){
			$this->load->view('templates011/header', $data);
			$this->load->view('categories011/tambah' );
			$this->load->view('templates011/footer' );
		} else{
			$this->Categoriesmodel_011->tambahDataCategories();
			$this->session->set_flashdata('flash', 'Ditambahkan');
			redirect('categories011');
		}
	}
	public function hapus($id)
	{
		$this->Categoriesmodel_011->hapusDataCategories($id);
		$this->session->set_flashdata('flash', 'Dihapus');
		redirect('categories011');
	}

	public function detail($id)
	{
		$data['judul'] = 'Detail Data Categories';
		$data['categories011'] = $this->Categoriesmodel_011->getCategoriesById($id);
		$this->load->view('templates011/header', $data);
		$this->load->view('categories011/detai', $data);
		$this->load->view('templates011/footer');
	} 

	public function ubah($id)
	{
		$data['judul'] = 'Form ubah Data Categories';
		$data['categories011'] = $this->Categoriesmodel_011->getCategoriesById($id);

		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');

		if( $this->form_validation->run() == FALSE ){
			$this->load->view('templates011/header', $data);
			$this->load->view('categories011/ubah', $data);
			$this->load->view('templates011/footer' );
		} else{
			$this->Categoriesmodel_011->ubahDataCategories();
			$this->session->set_flashdata('flash', 'Diubah');
			redirect('categories011');
		}
	}

}

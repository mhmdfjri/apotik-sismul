<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kategori_model');
        $this->load->helper(['form', 'url']);
    }

    public function index()
    {
        $data['categories'] = $this->Kategori_model->getAll();
        $this->load->view('kategori/index', $data);
    }

    public function create()
    {
        $this->load->view('kategori/create');
    }

    public function store()
    {
        $data = [
            'nama_kategori' => $this->input->post('name', true)
        ];
        $this->Kategori_model->save($data);
        $this->session->set_flashdata('success', 'Kategori berhasil ditambahkan');
        redirect('kategori');
    }
}

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
        $data['kategori'] = $this->Kategori_model->getAll();
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

    public function edit($id)
    {
        $data['kategori'] = $this->Kategori_model->getById($id);

        if (!$data['kategori']) {
            $this->session->set_flashdata('error', 'Kategori tidak ditemukan.');
            return redirect('kategori');
        }

        $this->load->view('kategori/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'nama_kategori' => $this->input->post('name', true)
        ];

        if ($this->Kategori_model->updateById($id, $data)) {
            $this->session->set_flashdata('success', 'Kategori berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Kategori gagal diperbarui.');
        }

        redirect('kategori');
    }


    public function delete($id)
    {
        if ($this->Kategori_model->deleteById($id)) {
            $this->session->set_flashdata('success', 'Kategori berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Kategori gagal dihapus.');
        }
        redirect('kategori');
    }

    public function delete_all()
    {
        $this->Kategori_model->deleteAll();
        $this->session->set_flashdata('success', 'Semua kategori berhasil dihapus.');
        redirect('kategori');
    }
}

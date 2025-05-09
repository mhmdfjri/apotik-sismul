<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load model Kategori dan helper form & URL
        $this->load->model('Kategori_model');
        $this->load->helper(['form', 'url']);
    }

    public function index()
    {
        // Ambil parameter limit dan page dari URL (default: 10 item per halaman dan halaman 1)
        $limit = $this->input->get('limit', TRUE) ?: 10;
        $page = $this->input->get('page', TRUE) ?: 1;

        // Hitung offset berdasarkan halaman
        $offset = ($page - 1) * $limit;

        // Ambil data kategori dari model dengan paginasi
        $data['kategori'] = $this->Kategori_model->getPaginated($limit, $offset);
        
        // Hitung total kategori untuk keperluan paginasi
        $totalKategori = $this->Kategori_model->countAll();
        
        // Hitung total halaman yang tersedia
        $data['totalPages'] = ceil($totalKategori / $limit);
        
        // Tambahkan info tambahan ke data view
        $data['page'] = $page;
        $data['limit'] = $limit;
        $data['totalKategori'] = $totalKategori;

        // Load view kategori index dengan data
        $this->load->view('kategori/index', $data);
    }

    public function create()
    {
        // Tampilkan form tambah kategori
        $this->load->view('kategori/create');
    }

    public function store()
    {
        // Ambil data dari form dan simpan ke database
        $data = [
            'nama_kategori' => $this->input->post('name', true)
        ];

        $this->Kategori_model->save($data);
        $this->session->set_flashdata('success', 'Kategori berhasil ditambahkan');
        redirect('kategori');
    }

    public function edit($id)
    {
        // Ambil data kategori berdasarkan ID
        $data['kategori'] = $this->Kategori_model->getById($id);

        // Redirect jika data tidak ditemukan
        if (!$data['kategori']) {
            $this->session->set_flashdata('error', 'Kategori tidak ditemukan.');
            return redirect('kategori');
        }

        // Tampilkan form edit dengan data kategori
        $this->load->view('kategori/edit', $data);
    }

    public function update($id)
    {
        // Ambil data dari form dan update kategori berdasarkan ID
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
        // Hapus kategori berdasarkan ID
        if ($this->Kategori_model->deleteById($id)) {
            $this->session->set_flashdata('success', 'Kategori berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Kategori gagal dihapus.');
        }

        redirect('kategori');
    }

    public function delete_all()
    {
        // Hapus semua kategori
        $this->Kategori_model->deleteAll();
        $this->session->set_flashdata('success', 'Semua kategori berhasil dihapus.');
        redirect('kategori');
    }
}
<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Obat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Obat_model');
        $this->load->model('Kategori_model');
        $this->load->helper(['form', 'url']);
    }

   public function index()
	{
		// Get limit and page from the URL or set default values
		$limit = $this->input->get('limit', TRUE) ?: 10;
		$page = $this->input->get('page', TRUE) ?: 1;

		// Calculate the offset for the query
		$offset = ($page - 1) * $limit;

		// Get paginated obat data
		$data['obat'] = $this->Obat_model->getPaginated($limit, $offset);
		
		// Get the total number of obat records
		$totalObat = $this->Obat_model->countAll();
		
		// Calculate the total number of pages
		$data['totalPages'] = ceil($totalObat / $limit);
		
		// Pass additional data to the view
		$data['page'] = $page;
		$data['limit'] = $limit;
		$data['totalObat'] = $totalObat;

		// Load the view
		$this->load->view('obat/index', $data);
	}


    public function create()
    {
        $data['categories'] = $this->Kategori_model->getAll();
        $this->load->view('obat/create', $data);
    }

    public function store()
    {
        $image = '';
        if ($_FILES['medicine_image']['name']) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 5120; // 5MB
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('medicine_image')) {
                $image = $this->upload->data('file_name');
            } else {
                echo $this->upload->display_errors();
                exit;
            }
        }

        $data = [
            'nama_obat' => $this->input->post('name', true),
            'gambar_obat' => $image,
            'deskripsi' => $this->input->post('description', true),
            'id_kategori' => $this->input->post('category_id'),
            'kuantitas' => $this->input->post('quantity'),
            'harga' => $this->input->post('price'),
            'expiration_date' => $this->input->post('expiration_date'),
        ];

        $this->Obat_model->save($data);
        $this->session->set_flashdata('success', 'Obat berhasil ditambahkan');
        redirect('obat');
    }

    public function edit($id)
    {
        $data['obat'] = $this->Obat_model->getById($id);
        $data['categories'] = $this->Kategori_model->getAll();

        if (!$data['obat']) {
            $this->session->set_flashdata('error', 'Obat tidak ditemukan.');
            return redirect('obat');
        }

        $this->load->view('obat/edit', $data);
    }

    public function update($id)
    {
        $obat = $this->Obat_model->getById($id);

        if (!$obat) {
            $this->session->set_flashdata('error', 'Obat tidak ditemukan.');
            return redirect('obat');
        }

        $image = $obat->gambar_obat;

        if ($_FILES['medicine_image']['name']) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 5120;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('medicine_image')) {
                // Hapus gambar lama jika ada
                if ($image && file_exists(FCPATH . 'uploads/' . $image)) {
                    unlink(FCPATH . 'uploads/' . $image);
                }
                $image = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                return redirect('obat/edit/' . $id);
            }
        }

        $data = [
            'nama_obat' => $this->input->post('name', true),
            'gambar_obat' => $image,
            'deskripsi' => $this->input->post('description', true),
            'id_kategori' => $this->input->post('category_id'),
            'kuantitas' => $this->input->post('quantity'),
            'harga' => $this->input->post('price'),
            'expiration_date' => $this->input->post('expiration_date'),
        ];

        if ($this->Obat_model->updateById($id, $data)) {
            $this->session->set_flashdata('success', 'Obat berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Obat gagal diperbarui.');
        }

        redirect('obat');
    }


    public function delete($id)
    {
        if ($this->Obat_model->deleteById($id)) {
            $this->session->set_flashdata('success', 'Obat berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Obat gagal dihapus.');
        }

        redirect('obat');
    }

    public function delete_all()
    {
        $this->Obat_model->deleteAll();
        $this->session->set_flashdata('success', 'Semua data obat berhasil dihapus.');
        redirect('obat');
    }
}

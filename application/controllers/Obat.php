<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Obat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct(); // Memanggil konstruktor parent (CI_Controller)
        $this->load->model('Obat_model'); // Memuat model Obat
        $this->load->model('Kategori_model'); // Memuat model Kategori
        $this->load->helper(['form', 'url']); // Memuat helper form dan url
    }

    public function index()
    {
        // Ambil parameter limit, page, dan search dari URL (dengan nilai default)
        $limit = $this->input->get('limit', TRUE) ?: 10;
        $page = $this->input->get('page', TRUE) ?: 1;
        $search = $this->input->get('search', TRUE);

        // Hitung offset untuk paginasi
        $offset = ($page - 1) * $limit;

        // Ambil data obat sesuai limit dan pencarian
        $data['obat'] = $this->Obat_model->getPaginated($limit, $offset, $search);
        
        // Hitung total data obat (dengan atau tanpa filter search)
        $totalObat = $this->Obat_model->countAll($search);
        
        // Hitung jumlah halaman total
        $data['totalPages'] = ceil($totalObat / $limit);

        // Kirim variabel tambahan ke view
        $data['page'] = $page;
        $data['limit'] = $limit;
        $data['totalObat'] = $totalObat;
        $data['search'] = $search;

        // Tampilkan view
        $this->load->view('obat/index', $data);
    }

    public function create()
    {
        $data['categories'] = $this->Kategori_model->getAll(); // Ambil semua kategori
        $this->load->view('obat/create', $data); // Tampilkan form input obat baru
    }

    public function store()
    {
        $image = '';
        // Cek apakah ada file gambar yang diupload
        if ($_FILES['medicine_image']['name']) {
            $config['upload_path'] = './uploads/'; // Lokasi simpan gambar
            $config['allowed_types'] = 'jpg|jpeg|png'; // Format yang diizinkan
            $config['max_size'] = 5120; // Maksimal ukuran file (KB)

            $this->load->library('upload', $config);

            // Jika upload berhasil, simpan nama file
            if ($this->upload->do_upload('medicine_image')) {
                $image = $this->upload->data('file_name');
            } else {
                // Tampilkan error dan hentikan proses
                echo $this->upload->display_errors();
                exit;
            }
        }

        // Ambil input dari form dan simpan dalam array
        $data = [
            'nama_obat' => $this->input->post('name', true),
            'gambar_obat' => $image,
            'deskripsi' => $this->input->post('description', true),
            'id_kategori' => $this->input->post('category_id'),
            'kuantitas' => $this->input->post('quantity'),
            'harga' => $this->input->post('price'),
            'expiration_date' => $this->input->post('expiration_date'),
        ];

        // Simpan data ke database
        $this->Obat_model->save($data);
        $this->session->set_flashdata('success', 'Obat berhasil ditambahkan');
        redirect('obat'); // Kembali ke halaman utama obat
    }

    public function read($id)
    {
        $data['obat'] = $this->Obat_model->getDetailById($id); // Ambil detail obat berdasarkan ID
        
        if (!$data['obat']) {
            // Jika data tidak ditemukan
            $this->session->set_flashdata('error', 'Obat tidak ditemukan.');
            return redirect('obat');
        }

        $this->load->view('obat/detail', $data); // Tampilkan halaman detail
    }

    public function edit($id)
    {
        $data['obat'] = $this->Obat_model->getById($id); // Ambil data obat
        $data['categories'] = $this->Kategori_model->getAll(); // Ambil semua kategori

        if (!$data['obat']) {
            $this->session->set_flashdata('error', 'Obat tidak ditemukan.');
            return redirect('obat');
        }

        $this->load->view('obat/edit', $data); // Tampilkan form edit
    }

    public function update($id)
    {
        $obat = $this->Obat_model->getById($id); // Ambil data obat berdasarkan ID

        if (!$obat) {
            $this->session->set_flashdata('error', 'Obat tidak ditemukan.');
            return redirect('obat');
        }

        $image = $obat->gambar_obat;

        // Cek jika ada gambar baru yang diupload
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
                // Simpan nama gambar baru
                $image = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                return redirect('obat/edit/' . $id);
            }
        }

        // Ambil input dari form
        $data = [
            'nama_obat' => $this->input->post('name', true),
            'gambar_obat' => $image,
            'deskripsi' => $this->input->post('description', true),
            'id_kategori' => $this->input->post('category_id'),
            'kuantitas' => $this->input->post('quantity'),
            'harga' => $this->input->post('price'),
            'expiration_date' => $this->input->post('expiration_date'),
        ];

        // Update data di database
        if ($this->Obat_model->updateById($id, $data)) {
            $this->session->set_flashdata('success', 'Obat berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Obat gagal diperbarui.');
        }

        redirect('obat'); // Kembali ke halaman utama obat
    }

    public function delete($id)
    {
        // Hapus data obat berdasarkan ID
        if ($this->Obat_model->deleteById($id)) {
            $this->session->set_flashdata('success', 'Obat berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Obat gagal dihapus.');
        }

        redirect('obat');
    }

    public function delete_all()
    {
        // Hapus semua data obat dari database
        $this->Obat_model->deleteAll();
        $this->session->set_flashdata('success', 'Semua data obat berhasil dihapus.');
        redirect('obat');
    }
}

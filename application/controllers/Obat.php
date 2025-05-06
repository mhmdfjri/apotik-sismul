<?php
// application/controllers/Dashboard.php
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
        // $data['obat'] = $this->Obat_model->get_all();
        // $this->load->view('obat/index', $data);
        $this->load->view('obat/index');
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
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori_model extends CI_Model
{
    public function getAll()
    {
        return $this->db->get('kategori')->result();
    }

    public function save($data)
    {
        return $this->db->insert('kategori', $data);
    }

    public function deleteById($id)
    {
        $this->db->where('id_kategori', $id);
        return $this->db->delete('kategori');
    }
}

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

    public function getById($id)
    {
        return $this->db->get_where('kategori', ['id_kategori' => $id])->row();
    }

    public function updateById($id, $data)
    {
        return $this->db->update('kategori', $data, ['id_kategori' => $id]);
    }


    public function deleteById($id)
    {
        $this->db->where('id_kategori', $id);
        return $this->db->delete('kategori');
    }

    public function deleteAll()
    {
        return $this->db->empty_table('kategori');
    }
}

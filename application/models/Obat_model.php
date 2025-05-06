<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Obat_model extends CI_Model
{
    public function getAll()
    {
        $this->db->select('obat.*, kategori.nama_kategori');
        $this->db->from('obat');
        $this->db->join('kategori', 'kategori.id_kategori = obat.id_kategori');
        return $this->db->get()->result();
    }

    public function save($data)
    {
        return $this->db->insert('obat', $data);
    }

    public function getById($id)
    {
        return $this->db->get_where('obat', ['id_obat' => $id])->row();
    }

    public function updateById($id, $data)
    {
        $this->db->where('id_obat', $id);
        return $this->db->update('obat', $data);
    }

    public function deleteById($id)
    {
        $this->db->where('id_obat', $id);
        return $this->db->delete('obat');
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori_model extends CI_Model
{
    // Mengambil semua data kategori
    public function getAll()
    {
        return $this->db->get('kategori')->result();
    }

    // Menyimpan data kategori baru ke tabel 'kategori'
    public function save($data)
    {
        return $this->db->insert('kategori', $data);
    }

    // Mengambil satu data kategori berdasarkan ID
    public function getById($id)
    {
        return $this->db->get_where('kategori', ['id_kategori' => $id])->row();
    }

    // Mengupdate data kategori berdasarkan ID
    public function updateById($id, $data)
    {
        return $this->db->update('kategori', $data, ['id_kategori' => $id]);
    }

    // Menghapus satu data kategori berdasarkan ID
    public function deleteById($id)
    {
        $this->db->where('id_kategori', $id);
        return $this->db->delete('kategori');
    }

    // Menghapus seluruh isi tabel kategori
    public function deleteAll()
    {
        return $this->db->empty_table('kategori');
    }

    // Mengambil data kategori dengan limit dan offset (paginasi)
    public function getPaginated($limit, $offset)
    {
        return $this->db->get('kategori', $limit, $offset)->result();
    }

    // Menghitung jumlah total kategori
    public function countAll()
    {
        return $this->db->count_all('kategori');
    }
}
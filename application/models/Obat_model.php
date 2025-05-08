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
        return $this->db->update('obat', $data, ['id_obat' => $id]);
    }


    public function deleteById($id)
    {
        // Ambil data obat berdasarkan ID
        $obat = $this->db->get_where('obat', ['id_obat' => $id])->row();

        if ($obat) {
            // Hapus file gambar jika ada
            $gambar_path = FCPATH . 'uploads/' . $obat->gambar_obat;
            if (file_exists($gambar_path) && is_file($gambar_path)) {
                unlink($gambar_path);
            }

            // Hapus data dari database
            return $this->db->delete('obat', ['id_obat' => $id]);
        }

        return false;
    }


    public function deleteAll()
    {
        // Ambil semua gambar dulu
        $obat_list = $this->db->get('obat')->result();

        foreach ($obat_list as $obat) {
            $gambar_path = FCPATH . 'uploads/' . $obat->gambar_obat;
            if (file_exists($gambar_path) && is_file($gambar_path)) {
                unlink($gambar_path);
            }
        }

        // Kosongkan tabel obat
        return $this->db->empty_table('obat');
    }

	public function getPaginated($limit, $offset)
	{
		$this->db->select('obat.*, kategori.nama_kategori');
		$this->db->from('obat');
		$this->db->join('kategori', 'kategori.id_kategori = obat.id_kategori');
		$this->db->limit($limit, $offset); // Apply limit and offset for pagination
		return $this->db->get()->result();
	}

	public function countAll()
	{
		return $this->db->count_all('obat');
	}

}

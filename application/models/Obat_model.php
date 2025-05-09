<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Obat_model extends CI_Model
{
    // Ambil semua data obat beserta nama kategori
    public function getAll()
    {
        $this->db->select('obat.*, kategori.nama_kategori');
        $this->db->from('obat');
        $this->db->join('kategori', 'kategori.id_kategori = obat.id_kategori');
        return $this->db->get()->result();
    }

    // Simpan data obat baru
    public function save($data)
    {
        return $this->db->insert('obat', $data);
    }

    // Ambil data obat berdasarkan ID (tanpa join)
    public function getById($id)
    {
        return $this->db->get_where('obat', ['id_obat' => $id])->row();
    }

    // Update data obat berdasarkan ID
    public function updateById($id, $data)
    {
        return $this->db->update('obat', $data, ['id_obat' => $id]);
    }

    // Ambil detail obat dengan nama kategori
    public function getDetailById($id)
    {
        $this->db->select('obat.*, kategori.nama_kategori');
        $this->db->from('obat');
        $this->db->join('kategori', 'kategori.id_kategori = obat.id_kategori');
        $this->db->where('obat.id_obat', $id);
        return $this->db->get()->row();
    }

    // Hapus obat berdasarkan ID, sekaligus hapus file gambarnya
    public function deleteById($id)
    {
        $obat = $this->getById($id);

        if ($obat) {
            if (!empty($obat->gambar_obat)) {
                $gambar_path = FCPATH . 'uploads/' . $obat->gambar_obat;
                if (is_file($gambar_path) && file_exists($gambar_path)) {
                    unlink($gambar_path);
                }
            }

            return $this->db->delete('obat', ['id_obat' => $id]);
        }

        return false;
    }

    // Hapus seluruh data dan file gambar obat
    public function deleteAll()
    {
        $obat_list = $this->getAll();

        foreach ($obat_list as $obat) {
            if (!empty($obat->gambar_obat)) {
                $gambar_path = FCPATH . 'uploads/' . $obat->gambar_obat;
                if (is_file($gambar_path) && file_exists($gambar_path)) {
                    unlink($gambar_path);
                }
            }
        }

        return $this->db->empty_table('obat');
    }

    // Ambil data obat dengan paginasi dan pencarian
    public function getPaginated($limit, $offset, $search = null)
    {
        $this->db->select('obat.*, kategori.nama_kategori');
        $this->db->from('obat');
        $this->db->join('kategori', 'kategori.id_kategori = obat.id_kategori');

        if (!empty($search)) {
            $this->db->like('obat.nama_obat', $search);
        }

        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }

    // Hitung total data untuk paginasi
    public function countAll($search = null)
    {
        $this->db->from('obat');

        if (!empty($search)) {
            $this->db->like('nama_obat', $search);
        }

        return $this->db->count_all_results();
    }
}

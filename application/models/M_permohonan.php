<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_permohonan extends CI_Model {
    public $table_name = "epak_permohonan";

    public function rules()
    {
        return [
            ['field' => 'pemohon', 'label' => 'Pihak Ke-1', 'rules' => 'required'],
            ['field' => 'termohon', 'label' => 'Pihak Ke-2', 'rules' => 'required'],
            ['field' => 'tgl_permohonan', 'label' => 'Tanggal','rules' => 'required'],
            ['field' => 'no_registrasi', 'label' => 'No Surat Permohonan','rules' => 'required'],
            ['field' => 'subject', 'label' => 'Isi Permohonan','rules' => 'required'],
            ['field' => 'kasus_posisi', 'label' => 'Kasus Posisi','rules' => 'required'],
            ['field' => 'dokumen', 'label' => 'Dokumen'],
            ['field' => 'status', 'label' => 'Status'],
            ['field' => 'nama_jaksa', 'label' => 'Nama Jaksa'],
            ['field' => 'nip_jaksa', 'label' => 'NIP Jaksa'],
            ['field' => 'id_timjpn', 'label' => 'Nama Jaksa'],
        ];
    }

    

    public function save($data) {
        $this->db->trans_begin();
        $this->db->insert($this->table_name, $data);
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            return 0;
        } else {
            $this->db->trans_commit();
            $insert_id = $this->db->insert_id();
            return  $insert_id;
        }
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        $this->db->update($this->table_name, $data);
        // print_r($this->db->last_query());
    }

    public function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->table_name);
    }

    public function select_all($options = "") {
        if($options) {
            $this->db->where($options);
        }

        $data = $this->db->get($this->table_name);
        return $data->result();
    }

    public function selectId($id) {
        $this->db->where('id', $id);
        $data = $this->db->get($this->table_name);
        return $data->row();
    }

    public function total_rows() {
        $data = $this->db->get($this->table_name);
        return $data->num_rows();
    }

    public function alterTable() {
        $this->load->dbforge();

        // $field_namajaksa = $this->db->field_exists('nama_jaksa', $this->table_name);
        // $field_nipjaksa = $this->db->field_exists('nip_jaksa', $this->table_name);

        // if (!$field_namajaksa && !$field_nipjaksa) {
        //     $fields = array(
        //         'nama_jaksa' => array('type' => 'VARCHAR', 'constraint' => '255'),
        //         'nip_jaksa' => array('type' => 'VARCHAR', 'constraint' => '255'),
        //     );

        //     $this->dbforge->add_column($this->table_name, $fields);
        // }

        if($this->db->field_exists('nama_jaksa', $this->table_name)) {
            $this->dbforge->drop_column($this->table_name, 'nama_jaksa');
        }

        if($this->db->field_exists('nip_jaksa', $this->table_name)) {
            $this->dbforge->drop_column($this->table_name, 'nip_jaksa');
        }

        if(!$this->db->field_exists('id_timjpn', $this->table_name)) {
            $this->dbforge->add_column($this->table_name, array(
                'id_timjpn' => array('type' => 'INT','constraint' => 11)
            ));
        }
    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_timjpn extends CI_Model {
    public $table_name = "epak_timjpn";

    public function rules()
    {
        return [
            ['field' => 'permohonan_id', 'label' => 'Permohonan ID'],
            ['field' => 'user_id', 'label' => 'User ID'],
        ];
    }    

    public function save($data) {
        // $this->db->trans_begin();
        // $having = $this->db->query('SELECT `*` FROM '.$this->table_name.' WHERE `permohonan_id` = "'.$data['permohonan_id'].'" AND `user_id` = "'.$data['user_id'].'"')->num_rows();
        $having = $this->db->get_where($this->table_name, array('permohonan_id' => $data['permohonan_id'], 'user_id' => $data['user_id']))->num_rows();
        if($having > 0) {
            $insert_id = 0;
        } else {
            $this->db->insert($this->table_name, $data);
            $insert_id = $this->db->insert_id();
        }

        return  $insert_id;

        // $insert_query = $this->db->insert_string($this->table_name, $data);
        // $insert_query = str_replace('INSERT INTO','INSERT IGNORE INTO',$insert_query);
        // $this->db->query($insert_query);

        // $this->db->trans_complete();
        
        // if ($this->db->trans_status() === FALSE){
        //     $this->db->trans_rollback();
        //     return 0;
        // } else {
        //     $this->db->trans_commit();
            // $insert_id = $this->db->insert_id();
            // return  $insert_id;
        // }
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        $this->db->update($this->table_name, $data);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->table_name);
    }

    public function select_all($options = "") {
        if($options) {
            $this->db->where($options);
        }
        $this->db->join('epak_users b', 'b.id = a.user_id');
        $this->db->select('a.*, b.nama as nama_jaksa, b.nohape as nip_jaksa');
        $data = $this->db->get($this->table_name . ' a');
        return $data->result();
    }

    public function total_rows() {
        $data = $this->db->get($this->table_name);
        return $data->num_rows();
    }
}
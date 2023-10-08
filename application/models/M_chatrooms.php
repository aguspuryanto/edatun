<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_chatrooms extends CI_Model {
    public $table_name = "epak_chatrooms";

    public function rules()
    {
        return [
            ['field' => 'userid', 'label' => 'User Id'],
            ['field' => 'msg', 'label' => 'Message'],
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
    }

    public function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->table_name);
    }

    public function select_all($options = "") {
        if($options) {
            $this->db->where($options);
        }

        $this->db->join('epak_users b', 'b.id = a.userid');
        $data = $this->db->get($this->table_name . ' a');
        return $data->result();
    }

    public function total_rows() {
        $data = $this->db->get($this->table_name);
        return $data->num_rows();
    }
}
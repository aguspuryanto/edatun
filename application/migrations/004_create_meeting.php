<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Migration_create_meeting extends CI_Migration {
    private $tableName = 'epak_meeting';
    public function up() { 
            $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 20,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'instansi' => array(
                'type' => 'VARCHAR',
                'constraint' => '20'
            ),
            'subject' => array(
                'type' => 'VARCHAR',
                'constraint' => '255'
            ),
            'kategori' => array(
                'type' => 'VARCHAR',
                'constraint' => '255'
            ),
            'tgl_permohonan' => array(
                'type' => 'timestamp',
            ),
            'lokasi' => array(
                'type' => 'VARCHAR',
                'constraint' => '255'
            ),
            'agenda' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'created_at datetime default current_timestamp'
        ));
        $this->dbforge->add_key('id', TRUE);
        if (!$this->db->table_exists($this->tableName)) {
            $this->dbforge->create_table($this->tableName, FALSE, array('ENGINE' => 'InnoDB'));
        }
    }

    public function down()
    {
        $this->dbforge->drop_table($this->tableName);
    }
}
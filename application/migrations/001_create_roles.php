<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Migration_create_roles extends CI_Migration {
    private $tableName = 'roles';
    public function up() { 
            $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 20,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '255'
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table($this->tableName);

        $data_dummies = array(
            array('name' => "admin"),
            array('name' => "user"),
        );
        $this->db->insert_batch($this->tableName, $data_dummies);
    }

    public function down()
    {
        $this->dbforge->drop_table($this->tableName);
    }
}
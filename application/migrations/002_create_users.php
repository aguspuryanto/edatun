<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Migration_create_users extends CI_Migration {
    private $tableName = 'users';
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
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'unique' => TRUE,
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => '255'
            ),
            'role_id' => array(
                'type' => 'INT',
                'constraint' => '20'
            ),
            'CONSTRAINT fk_users_roles FOREIGN KEY (role_id) REFERENCES roles(id)'
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table($this->tableName);

        $data_dummies = array(
            array(
                'name' => "Admin",
                'email' => "admin@mail.com",
                'password' => "5f4dcc3b5aa765d61d8327deb882cf99",
                'role_id' => "1"
            ),
        );
        $this->db->insert_batch($this->table_name, $data_dummies);
    }

    public function down()
    {
        $this->dbforge->drop_table($this->tableName);
    }
}
<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Migration_create_users extends CI_Migration {
    private $tableName = 'epak_users';

    public function up() { 
        // Instansi
        // Username
        // Nama
        // Divisi
        // Role = (Administrator, User)
        // Email
        // No HP

        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 20,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'instansi' => array(
                'type' => 'VARCHAR',
                'constraint' => '255'
            ),
            'username' => array(
                'type' => 'VARCHAR',
                'constraint' => '255'
            ),
            'nama' => array(
                'type' => 'VARCHAR',
                'constraint' => '255'
            ),
            'divisi' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'role_id' => array(
                'type' => 'INT',
                'constraint' => '20'
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'unique' => TRUE,
            ),
            'nohape' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => TRUE
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => '255'
            ),
            'created_at' => array('type' => 'timestamp')
        ));
        $this->dbforge->add_key('id', TRUE);

        if (!$this->db->table_exists($this->tableName)) {
            $this->dbforge->create_table($this->tableName, FALSE, array('ENGINE' => 'InnoDB'));

            $data_dummies = array(
                array(
                    'username' => "Admin",
                    'nama' => "Administrator",
                    'divisi' => NULL,
                    'email' => "admin@mail.com",
                    'nohape' => null,
                    'password' => "5f4dcc3b5aa765d61d8327deb882cf99",
                    'role_id' => "1"
                ),
            );
            $this->db->insert_batch($this->tableName, $data_dummies);
        }
    }

    public function down()
    {
        $this->dbforge->drop_table($this->tableName);
    }
}
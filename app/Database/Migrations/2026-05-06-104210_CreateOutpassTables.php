<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOutpassTables extends Migration
{
public function up()
{
    // Tabel Users
    $this->forge->addField([
        'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
        'username'    => ['type' => 'VARCHAR', 'constraint' => 50],
        'password'    => ['type' => 'VARCHAR', 'constraint' => 255],
        'name'        => ['type' => 'VARCHAR', 'constraint' => 100],
        'role'        => ['type' => 'ENUM', 'constraint' => ['student', 'warden', 'gatekeeper']],
        'created_at'  => ['type' => 'DATETIME', 'null' => true],
    ]);
    $this->forge->addKey('id', true);
    $this->forge->createTable('users');

    // Tabel Outpass Requests
    $this->forge->addField([
        'id'           => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
        'student_id'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
        'reason'       => ['type' => 'TEXT'],
        'destination'  => ['type' => 'VARCHAR', 'constraint' => 255],
        'out_date'     => ['type' => 'DATETIME'],
        'in_date'      => ['type' => 'DATETIME'],
        'status'       => ['type' => 'ENUM', 'constraint' => ['pending', 'approved', 'rejected', 'completed'], 'default' => 'pending'],
        'qr_code'      => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
    ]);
    $this->forge->addKey('id', true);
    $this->forge->addForeignKey('student_id', 'users', 'id', 'CASCADE', 'CASCADE');
    $this->forge->createTable('outpass_requests');
}

    public function down()
    {
        //
    }
}

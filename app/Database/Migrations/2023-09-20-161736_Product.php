<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Product extends Migration
{
    public function up()
    {
        $this->forge->addField(
            [
                'id' => [
                    'type' => 'INT',
                    'constraint' => 5,
                    'auto_increment' => TRUE,
                ],
                'product-name' => [
                    'type' => 'VARCHAR',
                    'constraint' => 350,
                ],
                'price' => [
                    'type' => 'INT',
                    'constraint' => 11,
                ],
                'category' => [
                    'type' => 'VARCHAR',
                    'constraint' => 350,
                ],
                'discription' => [
                    'type' => 'VARCHAR',
                    'constraint' => 350,
                ],
                'image' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                ],
                'taxable' => [
                    'type' => 'TINYINT',
                    'constraint' => 1,
                ],
                'delivery-charge' => [
                    'type' => 'TINYINT',
                    'constraint' => 1,
                ],
                'discount' => [
                    'type' => 'TINYINT',
                    'constraint' => 1,
                ],
                'created_at datetime default current_timestamp',
            ]
        );
        $this->forge->addKey('id', true);
        $this->forge->createTable('products');
    }

    public function down()
    {
        $this->forge->dropTable('products');
    }
}

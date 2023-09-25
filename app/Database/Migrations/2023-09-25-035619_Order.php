<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Order extends Migration
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
                'product_id' => [
                    'type' => 'INT',
                    'constraint' => 5,
                ],
                'quantity' => [
                    'type' => 'INT',
                    'constraint' => 3,
                ],
                'product_unit_price' => [
                    'type' => 'INT',
                    'constraint' => 3,
                ],
                'order_date datetime default current_timestamp',
            ]
        );
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('product_id', 'products', 'id');
        $this->forge->createTable('orders');
    }

    public function down()
    {
        $this->forge->dropTable('orders');
    }
}

<?php

namespace App\Database\Seeds;

use App\Models\TableModel;
use CodeIgniter\Database\Seeder;
use CodeIgniter\Test\Fabricator;

class Table extends Seeder
{
    public function run()
    {
        $fabricator = new Fabricator(TableModel::class);
        $fabricator->create(100);
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;
use Faker\Generator;

class TableModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'persons';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'phone', 'job']; 

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';


    public function fake(Generator &$faker) {
        return [
            'name' => $faker->name(),
            'phone' => $faker->e164PhoneNumber(),
            'job' => $faker->jobTitle(),
        ];
    }

}

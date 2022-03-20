<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\TablesLib;
use CodeIgniter\API\ResponseTrait;

class Table extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        return view('table');
    }

    public function list() 
    {
        $data = $this->request->getVar('order');
        $data = array_shift($data);

        $lib = new TablesLib('gp1', ['id', 'name', 'phone' , 'job', 'created_at']);

        $response = $lib->getResponse([
            'draw' => $this->request->getVar('draw'),
            'length' => $this->request->getVar('length'),
            'start' => $this->request->getVar('start'),
            'search' => $this->request->getVar('search')['value'],
            'order_column' => $data['column'],
            'order_direction' => $data['dir']
        ]);

        return $this->respond($response);
    }
    
}

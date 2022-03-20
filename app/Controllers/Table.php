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
        // $data = json_decode('{
        //     "draw": 1,
        //     "recordsTotal": 2,
        //     "recordsFiltered": 2,
        //     "data": [
        //         [
        //             "Angelica",
        //             "Ramos",
        //             "System Architect",
        //             "London",
        //             "9th Oct 09",
        //             "$2,875"
        //         ],
        //         [
        //             "Ashton",
        //             "Cox",
        //             "Technical Author",
        //             "San Francisco",
        //             "12th Jan 09",
        //             "$4,800"
        //         ]
        //     ]
        // }');

        // return $this->respond($data);
        // dd($this->request->uri->getQuery());

        // draw : pagina
        // length : numero total de registros por pagina

        $lib = new TablesLib('gp1');
        $response = $lib->getResponse([
            'draw' => $this->request->getVar('draw'),
            'length' => $this->request->getVar('length')
        ]);

        return $this->respond($response);
        
    }
}

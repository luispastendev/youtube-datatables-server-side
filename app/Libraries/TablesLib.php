<?php

namespace App\Libraries;

class TablesLib 
{
    private $model;
    private $group;

    public function __construct(string $group)
    {
        $this->model = model(TableModel::class);
        $this->group = $group;
    }

    public function getResponse(array $filters) : array
    {
        [
            'draw' => $page,
            'length' => $noRows
        ] = $filters;

        $data = $this->model->paginate($noRows,$this->group,$page);

        return [
            'draw' => $this->model->pager->getCurrentPage($this->group),
            'recordsTotal' => $this->model->pager->getTotal($this->group),
            'recordsFiltered' =>  $this->model->pager->getTotal($this->group),
            'data' => $this->toApi($data)
        ];
    }    

    private function toApi(array $data) : array
    {
        $output = [];
        foreach ($data as $row) {
            unset($row['updated_at']);
            $output[] = $row;
        }
        return $output;
    }
}
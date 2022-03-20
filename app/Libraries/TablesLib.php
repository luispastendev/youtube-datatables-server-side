<?php

namespace App\Libraries;

class TablesLib 
{
    private $model;
    private $group;
    private $columns;

    public function __construct(string $group, array $columns)
    {
        $this->model = model(TableModel::class);
        $this->columns = $columns;
        $this->group = $group;
    }

    public function getResponse(array $filters) : array
    {
        [
            'draw' => $draw,
            'start' => $start,
            'length' => $noRows,
            'order_column' => $column,
            'order_direction' => $direction
        ] = $filters;

        $page = ceil(($start - 1) / $noRows + 1);

        $data = $this->model
                    ->orderBy($this->getColumn($column), $direction)
                    ->paginate($noRows,$this->group, $page);

        return [
            'draw' => $draw,
            'recordsTotal' => $this->model->pager->getTotal($this->group),
            'recordsFiltered' =>  $this->model->pager->getTotal($this->group),
            'data' => $this->toApi($data)
        ];
    }    

    private function getColumn($index)
    {
        return $this->columns[$index];
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
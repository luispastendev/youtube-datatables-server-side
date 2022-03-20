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
            'order_direction' => $direction,
            'search' => $search
        ] = $filters;

        $page = ceil(($start - 1) / $noRows + 1);
        
        $this->model->orderBy($this->getColumn($column), $direction);

        if (!empty($search)) {
            $this->applyGlobalSearch($search);
        }

        $data = $this->model->paginate($noRows,$this->group, $page);

        return [
            'draw' => $draw,
            'recordsTotal' =>  $this->model->countAll(),
            'recordsFiltered' => $this->model->pager->getTotal($this->group),
            'data' => $this->toApi($data)
        ];
    }    

    private function applyGlobalSearch($match)
    {
        foreach ($this->columns as $column) {
            $this->model->orLike($column, $match);
        }
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
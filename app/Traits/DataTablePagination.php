<?php

namespace App\Traits;

use Schema;

trait DataTablePagination
{
	public function paginated($start, $limit, $order_key, $dir, $columns, $search = null)
	{

		$order = $this->getOrder($order_key);
		$searchables = $this->getSearchableFields($columns);

		$query = $this->model
			->offset($start)
		    ->limit($limit)
		    ->orderBy($order,$dir);

		if($search) {
			foreach ($searchables as $column) {
				if(in_array($column, $this->getColumns())) {
					$query->orWhere($column, 'LIKE', "%{$search}%");
				}
			}
		}

		$result = $query->get();
		$result = $this->modifyProperties($result);
		$count =  $this->model->count();

		return [$result, $count];
	}



    protected function modifyProperties($result)
    {
        return $result;
    }

	protected function getSearchableFields($searchables = array())
    {
        $search = array();
        if(empty($searchables)) {
            return $search;
        }
        foreach($searchables as $field){
            if($field['searchable'] == 'true' && !empty($field['data'])) {
                $search[] = $field['data'];
            }
        }
        return $search;
    }

	protected function getOrder(int $key)
	{
		$columns = $this->getColumns();
		return $columns[$key];
	}

	protected function getColumns()
	{

		return Schema::getColumnListing($this->model->getTable());
	}

}

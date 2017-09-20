<?php
namespace Yuga\Database\Elegant;
use Closure;
use Carbon\Carbon;
use Yuga\Support\Str;
use Yuga\Database\Elegant\Collection;
use Yuga\Database\Connection\Connection;
use Yuga\Database\Migration\Schema\Table;
use Yuga\Database\Query\Builder as QueryBuilder;
use Yuga\Database\Elegant\Exceptions\ModelException;
use Yuga\Database\Elegant\Exceptions\ModelNotFoundException;
class Builder
{
    protected static $instance;
    
    /**
    * @var Model
    */
    protected $model;
    /**
    * @var QueryBuilder
    */
    protected $query;

    protected $withTrashed = false;
	protected $onlyTrashed = false;

    public function __construct(Connection $connection, Model $model)
    {
        $this->model = $model;
        $this->query = (new QueryBuilder())->table($this->model->getTable());
        //$this->query->asObject(get_class($this->getModel()));
    }


    public function all($columns = null)
    {
        $models = $this->getAll($columns);
        return $models;
    }

    public function withTrashed()
    {
		$this->withTrashed = true;
		return $this;
	}

    public function onlyTrashed()
    {
		$this->onlyTrashed = true;
		return $this;
	}

    public function getAll($columns = null)
    {
        if ($this->getModel()->dispatchModelEvent('selecting', [$this->query]) === false) {
            return false;
        }
        if ($this->checkTableField($this->getModel()->getTable(), $this->getModel()->getDeleteKey())) {
            if($this->withTrashed){
				
			}elseif($this->onlyTrashed){
				$this->query->whereNotNull($this->getModel()->getDeleteKey());
			}else{
				$this->query->whereNull($this->getModel()->getDeleteKey());
			}
        }
        $models = $this->query->get($columns); 
        $results = $this->getModel()->makeModels($models);
        
        $this->getModel()->dispatchModelEvent('selected', [$this->query]);

        return $results;
    }

    public function prefix($prefix)
    {
        $this->query->addPrefix($this->model->getTable(), $prefix);

        return $this;
    }

    public function limit($limit)
    {
        $this->query->limit($limit);

        return $this;
    }

    public function skip($skip)
    {
        $this->query->offset($skip);

        return $this;
    }

    public function take($amount)
    {
        return $this->limit($amount);
    }

    public function offset($offset)
    {
        return $this->skip($offset);
    }

    public function where($key, $operator = null, $value = null)
    {
        if (func_num_args() === 2) {
            if ($operator instanceof Closure) {
                echo "Yes";
                die();
            }
            $value = $operator;
            $operator = '=';
        }

        $this->query->where($key, $operator, $value);

        return $this;
    }

    public function whereIn($key, $values)
    {
        $this->query->whereIn($key, $values);

        return $this;
    }

    public function whereNot($key, $operator = null, $value = null)
    {
        if (func_num_args() === 2) {
            $value = $operator;
            $operator = '=';
        }

        $this->query->whereNot($key, $operator, $value);

        return $this;
    }

    public function whereNotIn($key, $values)
    {
        $this->query->whereNotIn($key, $values);

        return $this;
    }

    public function whereNull($key)
    {
        $this->query->whereNull($key);

        return $this;
    }

    public function whereNotNull($key)
    {
        $this->query->whereNotNull($key);

        return $this;
    }

    public function whereBetween($key, $valueFrom, $valueTo)
    {
        $this->query->whereBetween($key, $valueFrom, $valueTo);

        return $this;
    }

    public function orWhere($key, $operator = null, $value = null)
    {
        if (func_num_args() === 2) {
            $value = $operator;
            $operator = '=';
        }

        $this->query->orWhere($key, $operator, $value);

        return $this;
    }

    public function orWhereIn($key, $values)
    {
        $this->query->orWhereIn($key, $values);

        return $this;
    }

    public function orWhereNotIn($key, $values)
    {
        $this->query->orWhereNotIn($key, $values);

        return $this;
    }

    public function orWhereNot($key, $operator = null, $value = null)
    {
        if (func_num_args() === 2) {
            $value = $operator;
            $operator = '=';
        }

        $this->query->orWhereNot($key, $operator, $value);

        return $this;
    }

    public function orWhereNull($key)
    {
        $this->query->orWhereNull($key);

        return $this;
    }

    public function orWhereNotNull($key)
    {
        $this->query->orWhereNotNull($key);

        return $this;
    }

    public function orWhereBetween($key, $valueFrom, $valueTo)
    {
        $this->query->orWhereBetween($key, $valueFrom, $valueTo);

        return $this;
    }

    public function get($columns = null)
    {
        return $this->all($columns);
    }


    public function find($ids, $columns = null)
    {
        if ($columns) {
            $this->select($columns);
        }
        if (!is_array($ids)) {
            $this->where($this->model->getPrimaryKey(), $ids);
            $item = $this->first();
            if ($item !== null) {
                return $item;
            }
        } else {
            $items = $this->whereIn($this->model->getPrimaryKey(), $ids)->get();
            return $items;
        }
        
        return null;
    }

    public function findOrFail($id)
    {
        $item = $this->find($id);
        if ($item === null) {
            throw new ModelNotFoundException(get_class($this->model) . ' was not found');
        }

        return $item;
    }

    public function first($columns = null)
    {
        if ($columns) {
            $item = $this->query->select($columns)->first();
        } else {
            $item = $this->query->first();
        }
        
        if ($item !== null) {
            return $this->model->newFromQuery($item);
        }
        return null;
    }

    public function last($columns = null)
    {
        if ($columns) {
            $item = $this->query->select($columns)->last();
        } else {
            $item = $this->query->last();
        }
        if ($item !== null) {
            return $this->model->newFromQuery($item);
        }
        return null;
    }

    public function firstOrFail($columns = null)
    {
        $item = $this->first($columns);
        if ($item === null) {
            throw new ModelNotFoundException(get_class($this->model) . ' was not found');
        }

        return $item;
    }

    public function count()
    {
        return $this->query->count();
    }

    public function max($field)
    {
        $result = $this->query->select($this->query->raw('MAX(' . $field . ') AS max'))->get();
        return (int)$result[0]->max;
    }

    public function sum($field)
    {
        $result = $this->query->select($this->query->raw('SUM(' . $field . ') AS sum'))->get();
        return (int)$result[0]->sum;
    }

    protected function getValidData(array $data)
    {
        $out = [];
        foreach ($data as $key => $value) {
            if (in_array($key, $this->model->getColumns(), true) === true) {
                $out[$key] = $value;
            }
        }
        return $out;
    }

    public function update(array $data = [])
    {
        if (count($data) === 0) {
            throw new ModelException('There are no valid columns found to update.');
        }

        $this->query->update($data);

        return $this->model;
    }

    public function create(array $data = [])
    {
        //$data = array_merge($this->model->getRows(), $this->getValidData($data));

        if (count($data) === 0) {
            throw new ModelException('There are no valid columns found to update.');
        }

        $id = $this->query->insert($data);

        if ($id) {

            //$this->model->mergeRows($data);
            $this->model->{$this->model->getPrimaryKey()} = $id;

            return $this->model;
        }

        return false;
    }

    public function firstOrCreate(array $data = [])
    {
        $item = $this->first();

        if ($item === null) {
            $item = $this->createInstance((object)$data);
        }

        $item->mergeRows($data);
        $item->save();
        return $item;
    }

    public function firstOrNew(array $data = [])
    {
        $item = $this->first();
        if ($item === null) {
            return $this->newInstance($data, true);
        }
        return $item;
    }

    public function destroy($ids)
    {
        $this->query->whereIn($this->getModel()->getPrimaryKey(), $ids)->delete();

        return $this->model;
    }

    public function select($fields)
    {
        $this->query->select($fields);

        return $this;
    }

    public function groupBy($field)
    {
        $this->query->groupBy($field);

        return $this;
    }

    public function orderBy($fields, $defaultDirection = 'ASC')
    {
        $this->query->orderBy($fields, $defaultDirection);

        return $this;
    }

    public function join($table, $key, $operator = null, $value = null, $type = 'inner')
    {
        $this->query->join($table, $key, $operator, $value, $type);

        return $this;
    }

    public function raw($value, array $bindings = [])
    {
        return $this->query->raw($value, $bindings);
    }

    public function query($sql, array $bindings = [])
    {
        $this->query->query($sql, $bindings);
        return $this;
    }

    public function subQuery(Model $model, $alias = null)
    {
        return $this->query->subQuery($model->getQuery(), $alias);
    }

    /**
     * @return Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param Model $model
     */
    public function setModel(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return QueryBuilder
     */
    public function getQuery()
    {
        return $this->query;
    }

    public function toSql($raw = null)
    {
        if($raw == 'raw')
            return $this->query->getQuery()->getRawSql();
        return $this->query->getQuery()->getSql();
    }

    public function dates($updated_at, $created_at)
    {
		if(!$this->checkTableField($this->model->getTable(), $created_at)){
			$this->createTableField($this->model->getTable(), $created_at);
		}
		if(!$this->checkTableField($this->model->getTable(), $updated_at)){
			$this->createTableField($this->model->getTable(), $updated_at);
		}
    }
    
    public function checkTableField($table, $field)
    {
        return (new Table($table))->columnExists($field);
    }

    public function createTableField($table, $field)
    {
        $table = new Table($table);
        $table->column($field)->nullable()->datetime();
        $table->addColumns();
    }

    public function delete($permanent = false)
    {
		if($permanent == true){
			return $this->forceDelete();
		}
		return $this->softDelete();
	}

    private function forceDelete()
    {
		return $this->query->delete();
	}

    private function softDelete()
    {
		$time = Carbon::now()->toDateTimeString();
		
		if ($this->checkTableField($this->getModel()->getTable(), $this->getModel()->getDeleteKey())) {
            $this->update([$this->getModel()->getDeleteKey() => $time]);
		} else {
			$this->createTableField($this->getModel()->getTable(), $this->getModel()->getDeleteKey());
			$this->update([$this->getModel()->getDeleteKey() => $time]);
		}
		return $this->getModel();
	}

    public function __clone()
    {
        $this->query = clone $this->query;
    }

}
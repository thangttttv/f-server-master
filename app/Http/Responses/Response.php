<?php
namespace App\Http\Responses;

class Response
{
    /**
     * @var array
     */
    protected $columns = [];

    /**
     * @var array
     */
    protected $optionalColumns = [];

    /**
     * @var int
     */
    protected $statusCode = 200;

    /**
     * @var array
     */
    protected $data = [];

    public function __construct($initialValues, $statusCode = 200)
    {
        foreach (array_keys($this->columns) as $column) {
            if (array_key_exists($column, $initialValues)) {
                $this->data[$column] = $initialValues[$column];
            } elseif (!in_array($column, $this->optionalColumns)) {
                $this->data[$column] = $this->columns[$column];
            }
        }
        $this->statusCode = $statusCode;
    }

    /**
     * @param string $name
     * @param mixed  $value
     */
    public function set($name, $value)
    {
        if (array_key_exists($name, $this->columns)) {
            $this->data[$name] = $value;
        }
    }

    /**
     * @param string $name
     * @param mixed  $default
     *
     * @return mixed|null
     */
    public function get($name, $default = null)
    {
        if (!array_key_exists($name, $this->columns)) {
            return;
        }
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }
        if (is_null($default)) {
            return $this->columns[$name];
        }

        return $default;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $ret = [];
        foreach (array_keys($this->columns) as $column) {
            if (array_key_exists($column, $this->data)) {
                $ret[$column] = $this->data[$column];
            } elseif (!in_array($column, $this->optionalColumns)) {
                $ret[$column] = $this->columns[$column];
            }
        }

        return $ret;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function response()
    {
        return response()->json($this->toArray(), $this->statusCode);
    }
}

<?php
namespace App\Models\DynamoDB;

use App\Presenters\BasePresenter;
use BaoPham\DynamoDb\DynamoDbModel;

/**
 * App\Models\DynamoDB\Base.
 *
 * @mixin \Eloquent
 */
class Base extends DynamoDbModel
{
    public $incrementing = true;
    public $compositeKey = [];
    protected $presenterInstance;

    protected $presenter = BasePresenter::class;

    public function present()
    {
        if (!$this->presenterInstance) {
            $this->presenterInstance = new $this->presenter($this);
        }

        return $this->presenterInstance;
    }

    /**
     * @return string
     */
    public static function getTableName()
    {
        return with(new static())->getTable();
    }

    /**
     * @return string[]
     */
    protected function getEditableColumns()
    {
        return $this->fillable;
    }

    /**
     * @return string
     */
    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }

    public function getLocalizedColumn($key)
    {
        $locale = \App::getLocale();
        if (empty($locale)) {
            $locale = 'en';
        }
        $localizedKey = $key.'_'.strtolower($locale);
        $value        = $this->$localizedKey;
        if (empty($value)) {
            $localizedKey = $key.'_en';
            $value        = $this->$localizedKey;
        }

        return $value;
    }

    /**
     * @return array
     */
    public function toFillableArray()
    {
        $ret = [];
        foreach ($this->fillable as $key) {
            $ret[$key] = $this->$key;
        }

        return $ret;
    }

    /**
     * @return string[]
     */
    public function getFillableColumns()
    {
        return $this->fillable;
    }

    /**
     * @return string[]
     */
    public function getDateColumns()
    {
        return $this->dates;
    }
}

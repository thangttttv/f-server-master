<?php
namespace App\Presenters;

/**
 * @property \App\Models\BankAccount $entity
 */
class BankAccountPresenter extends BasePresenter
{
    protected $multilingualFields = [];

    protected $imageFields = [];

    public function userName()
    {
        $value = 'Unknown';
        if (!empty($this->entity->user)) {
            $value = $this->entity->user->present()->userName();
        }

        return $value;
    }

    public function bankName()
    {
        $value = 'Unknown';
        if (!empty($this->entity->bank)) {
            $value = $this->entity->bank->name;
        }

        return $value;
    }
}

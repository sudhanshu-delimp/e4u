<?php

namespace App\Traits\Models;

use Illuminate\Support\Facades\Auth;

trait HasCreatedUpdatedBy {
    /**
     * Indicates if the model should have created_by and updated_by fields.
     *
     * @var bool
     */
    public $createdUpdatedBy = false;

    /**
     * Update the model's created and updated by.
     *
     * @return bool
     */
    public function setModelCreatedUpdatedBy()
    {
        if (! $this->usesCreatedUpdatedBy()) {
            return false;
        }

        $this->updateCreatedUpdatedBy();
    }

    /**
     * Update the created and updated by.
     *
     * @return void
     */
    public function updateCreatedUpdatedBy()
    {
        $userId = $this->getAuthUserId();
        
        $updatedByColumn = $this->getUpdatedByColumn();

        if (! is_null($updatedByColumn) && $this->isDirty() && ! $this->isDirty($updatedByColumn)) {
            $this->setUpdatedBy($userId);
        }

        $createdByColumn = $this->getCreatedByColumn();

        if (! $this->exists && ! is_null($createdByColumn) && ! $this->isDirty($createdByColumn)) {
            $this->setCreatedBy($userId);
        }
    }

    /**
     * Set the value of the "created_by" attribute.
     *
     * @param  mixed  $value
     * @return $this
     */
    public function setCreatedBy($value)
    {
        $this->{$this->getCreatedByColumn()} = $value;

        return $this;
    }

    /**
     * Set the value of the "updated_by" attribute.
     *
     * @param  mixed  $value
     * @return $this
     */
    public function setUpdatedBy($value)
    {
        $this->{$this->getUpdatedByColumn()} = $value;

        return $this;
    }

    /**
     * Get current auth user id.
     *
     * @return int
     */
    public function getAuthUserId()
    {
        if(request('isImpersonated')) {
            return request('impersonatedId') ?? null;
        }
        return Auth::user()->id ?? null;
    }
    
    /**
     * Determine if the model uses created_byu and updated_by.
     *
     * @return bool
     */
    public function usesCreatedUpdatedBy()
    {
        return $this->createdUpdatedBy;
    }

    /**
     * Get the name of the "created_by" column.
     *
     * @return string|null
     */
    public function getCreatedByColumn()
    {  
        return static::CREATED_BY;
    }

    /**
     * Get the name of the "updated_by" column.
     *
     * @return string|null
     */
    public function getUpdatedByColumn()
    {
        return static::UPDATED_BY;
    }

    /**
     * Get the fully qualified "created_by" column.
     *
     * @return string
     */
    public function getQualifiedCreatedByColumn()
    {
        return $this->qualifyColumn($this->getCreatedByColumn());
    }

    /**
     * Get the fully qualified "updated_by" column.
     *
     * @return string
     */
    public function getQualifiedUpdatedByColumn()
    {
        return $this->qualifyColumn($this->getUpdatedByColumn());
    }
}

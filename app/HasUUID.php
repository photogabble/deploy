<?php

namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

/**
 * @mixin Model
 */
trait HasUUID
{

    public static function bootHasUUID()
    {
        static::creating(function ($model) {
            /** @var Model|HasUUID $model */
            $uuidFieldName = $model->getUUIDFieldName();
            if (empty($model->$uuidFieldName)) {
                $model->$uuidFieldName = static::generateUUID();
            }
        });
    }

    public function getUUIDFieldName(): string
    {
        if (!empty($this->uuidFieldName)) {
            return $this->uuidFieldName;
        }
        return 'uuid';
    }

    /**
     * @return string
     * @throws Exception
     */
    public static function generateUUID(): string
    {
        return Uuid::uuid4()->toString();
    }
}

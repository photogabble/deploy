<?php

namespace App\Http\Requests;

use Illuminate\Database\Eloquent\Model;
use Photogabble\LumenFormRequest\ApiRequest;

abstract class AbstractModelRequest extends ApiRequest
{

    /**
     * @return Model
     */
    abstract public function model();

    /**
     * @return bool
     */
    public function persist(): bool
    {
        return false;
    }

    /**
     * Get the route handling the request.
     *
     * @param string|null $param
     * @param mixed $default
     * @return null|string
     */
    public function route($param = null, $default = null)
    {
        $route = call_user_func($this->getRouteResolver());

        if (is_null($route) || is_null($param)) {
            return $route;
        }

        return $route[2][$param] ?? $default;
    }
}

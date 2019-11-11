<?php

namespace MichelPi\FortniteApi\Components\Tasks;

use GuzzleHttp\Promise\Promise;

class Awaitable
{
    /**
     * Undocumented variable
     *
     * @var Promise
     */
    private $promise;

    /**
     * Undocumented function
     *
     * @param Promise $promise
     */
    public function __construct($promise)
    {
        $this->promise = $promise;
    }

    public function await()
    {
        return $this->promise->wait();
    }
}

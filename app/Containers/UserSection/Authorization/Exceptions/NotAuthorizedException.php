<?php

declare(strict_types=1);

namespace App\Containers\UserSection\Authorization\Exceptions;

use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException as Exception;

class NotAuthorizedException extends Exception
{
    protected string $route;
    protected Request $request;

    public function setRoute(string $route): self
    {
        $this->route = $route;
        return $this;
    }

    public function getRoute(): string
    {
        return $this->route;
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    public function setRequest(Request $request): self
    {
        $this->request = $request;
        return $this;
    }
}

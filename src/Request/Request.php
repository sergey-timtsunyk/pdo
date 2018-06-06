<?php
/**
 * User: Serhii T.
 * Date: 6/2/18
 */

namespace App\Request;

class Request
{
    /**
     * @var string
     */
    private $handler;

    /**
     * @var string
     */
    private $method;

    /**
     * @var array
     */
    private $query;

    /**
     * @var array
     */
    private $request;

    /**
     * @var
     */
    private $vars;

    /**
     * RouteParameters constructor.
     * @param string $handler
     * @param string $method
     * @param array $query
     * @param array $request
     * @param $vars
     */
    public function __construct(string $handler, string $method, array $vars, array $query, array $request)
    {
        $this->handler = $handler;
        $this->method = $method;
        $this->query = $query;
        $this->request = $request;
        $this->vars = $vars;
    }

    /**
     * @return string
     */
    public function getHandler(): string
    {
        return $this->handler;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return array
     */
    public function getQuery(): array
    {
        return $this->query;
    }

    /**
     * @return array
     */
    public function getVars(): array
    {
        return $this->vars;
    }

    /**
     * @return array
     */
    public function getRequest(): array
    {
        return $this->request;
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function getVarParameter(string $key)
    {
        return $this->vars[$key] ?? null;
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function getRequestParameter(string $key)
    {
        return $this->request[$key] ?? null;
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function getQueryParameter(string $key)
    {
        return $this->query[$key] ?? null;
    }
}

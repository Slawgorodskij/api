<?php

namespace App\Http;

class Request
{
    public function __construct(
        private array $server,
        private array $body,
        private array $params,
    )
    {
    }

    public function getMethod(): string
    {
        return $this->server['REQUEST_METHOD'];
    }

    public function getJsonBody(): array|null
    {
        return $this->body;
    }

    public function getParams()
    {
        if (isset($this->params['s'])) {
            return $this->params['s'];
        }
        return null;
    }

    public function getPage()
    {
        if (isset($this->params['page'])) {
            return $this->params['page'];
        }
        return null;
    }

    public function getPath()
    {

        $stringUrlItem = explode('/', $this->server['REQUEST_URI']);

        $components = [];

        if ($stringUrlItem == '') {
            $components ['path'] = 'index';
        }

        if (isset($stringUrlItem[1])) {
            $components['path'] = $stringUrlItem[1];
        }

        if (isset($stringUrlItem[2]) && is_numeric($stringUrlItem[2])) {
            $components['id'] = $stringUrlItem[2];
        }

        return $components;
    }
}
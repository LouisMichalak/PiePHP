<?php

namespace Core;

final class Request
{
    /**
     * @var array $request will contain secured parameters for request
     */
    private $parameters = [];

    /**
     * get HTTP requests and secure them
     * 
     * @return string secure parameters or an empty array if parameters are empty
     */
    public function getParams()
    {
        $this->parameters = empty($_POST) ? $_GET : array_merge($_POST, $_GET);
        foreach($this->parameters as $key => $value) {
            $this->parameters[$key] = trim($value);
            $this->parameters[$key] = stripslashes($value);
            $this->parameters[$key] = htmlspecialchars($value, ENT_QUOTES);
        }
        return $this->parameters;
    }
}
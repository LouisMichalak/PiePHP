<?php

namespace Core;

final class Request
{
    /**
     * @var array $request will contain secured parameters for request
     */
    private $parameters = [];

    public function __construct()
    {
        $this->setParams();
    }

    /**
     * get HTTP requests and secure them
     * 
     * @return string secure parameters or an empty array if parameters are empty
     */
    public function setParams()
    {
        $this->parameters = empty($_POST) ? $_GET : array_merge($_POST, $_GET);
        foreach($this->parameters as $key => $value) {
            $this->parameters[$key] = trim($value);
            $this->parameters[$key] = stripslashes($value);
            $this->parameters[$key] = htmlspecialchars($value, ENT_QUOTES);
        }
        unset($_POST);
        unset($_GET);
    }

    /**
     * return POST and GET parameters that class request set up
     * 
     * @return array array containing POST and GET parameters
     */
    public function getAllParams()
    {
        return $this->parameters;
    }

    /**
     * return a POST OR GET parameter
     * 
     * @param string $index index of the parameter
     * @return mixed[]|null value of the parameter requested or null if the parameter doesn't exist
     */
    public function getParam(string $index)
    {
        return empty($this->parameters[$index])
            ? null
            : $this->parameters[$index];
    }
}
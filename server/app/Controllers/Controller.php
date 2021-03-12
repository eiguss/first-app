<?php
namespace App\Controllers;

class Controller 
{
    protected function getParam($request, $param , $default=null)
    {
        $postParams = json_decode($request->getBody()->__toString(), true);
        $getParams = $request->getQueryParams();
        $params = array_merge(
            !empty($postParams) ? $postParams :[] ,
            !empty($getParams) ? $getParams :[] 
        );

        return isset($params[$param]) ? $params[$param] : $default;
    }
}
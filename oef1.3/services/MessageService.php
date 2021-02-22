<?php


class MessageService
{

    private $errors;
    private $input_errors;
    private $infos;

    function __controller__(){

    }

    function CountErrors()
    {

        return $this->count(errors);

    }

    function CountInputErrors()
    {
        return $this->count($this->input_errors);
    }

    function CountInfos()
    {
        return $this->count(infos);
    }

    function CountNewErrors()
    {

    }

    function CountNewInputErrors()
    {


    }

    function CountNewInfos()
    {

    }

    function GetInputErrors($input_errors = null)
    {
    return $this->input_errors;

    }

    function AddMessage($typr, $msg, $key = null)
    {
    }

    function ShowErrors()
    {


    }
    function ShowInfos()
    {


    }
}

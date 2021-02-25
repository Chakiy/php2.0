<?php


class MessageService
{

    private $errors;
    private $input_errors;
    private $infos;

    function __controller(){

        $this->infos = $_SESSION['msgs'];
        $_SESSION['msgs'] = [];


        $this->errors = $_SESSION['errors'];
        $_SESSION['errors'] = [];

        $this->input_errors = $_SESSION['input_errors'];
        $_SESSION['input_errors'] = [];



    }

    function CountErrors()
    {

        return count($this->errors);

    }

    function CountInputErrors()
    {
        return count($this->input_errors);
    }

    function CountInfos()
    {
        return count($this->infos);
    }

    function CountNewErrors()
    {
        count($_SESSION['errors']);
    }

    function CountNewInputErrors()
    {
        return count($_SESSION['input_errors']);

    }

    function CountNewInfos()
    {
        return count($_SESSION['msgs']);
    }

    function GetInputErrors()
    {
        if (!$this->CountInputErrors()) {
            return null;
        }else{
            return $this->input_errors;
        }

    }

    function AddMessage($type, $msg, $key = null)
    {
        if ($type === 'input_error') {
            array_push($_SESSION['errors'][$key . "_error"], $msg);
        } else {
            array_push($_SESSION($type), $msg);
        }
    }

    function ShowErrors()
    {

    echo $this->errors;
    }
    function ShowInfos()
    {

    echo $this->infos;
    }
}

<?php

class Conecta
{
    var $db;

    function __construct()
    {

        $this->db = new mysqli('localhost', 'user', '', 'clube_loja', 0000);
    }

    public function getDb()
    {
        return $this->db;
    }
}

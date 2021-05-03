<?php

class ModelLogin extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table = "user";
        $this->table1 = "anggota";
        $this->token = "wehehehe ngapain gan? >:D";
    }

    function cek($data)
    {
        $cek = $this->db->get_where($this->table, $data)->num_rows();
        if ($cek > 0) {
            return true;
        } else {
            return false;
        }
    }

    function getData()
    {
        return $this->db->query($this->db->last_query())->row();
    }
}

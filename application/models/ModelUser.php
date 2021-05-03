<?php

class ModelUser extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table = "user as u";
        $this->table1 = "user";
        $this->column_order = array(NULL, 'u.nama_user', 'u.username');
        $this->column_search = array('u.nama_user', 'u.username');
        $this->order = array('u.id_user' => 'desc');
    }

    private function _get_datatables_query()
    {
        $this->db->from($this->table);

        $i = 0;

        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {

                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->where('level != ', '1');
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function cekPerubahan()
    {
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function insert($data)
    {
        $cek = $this->db->get_where($this->table, array('username' => $data['username']))->num_rows();
        if ($cek == 1) {
            return false;
        } else {
            $this->db->insert($this->table1, $data);
            return $this->cekPerubahan();
        }
    }

    function get($id)
    {
        return $this->db->get_where($this->table, $this->req->id('id_user',$id))->row();
    }


    function update($data, $where)
    {
        $this->db->where($where);
        $this->db->update($this->table1, $data);
        return $this->cekPerubahan();
    }

    function delete($where)
    {
        $this->db->where($where);
        $this->db->delete($this->table1);

        return $this->cekPerubahan();
    }

    function datakelompok()
    {
        $this->db->select('*');
        $this->db->from('kelompok');
        $this->db->order_by('id_kelompok', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    function dataceklis()
    {
        $this->db->select('*');
        $this->db->from('ceklis');
        $this->db->order_by('id_kelompok', 'desc');
        $query = $this->db->get();
        return $query->result();
    }
}

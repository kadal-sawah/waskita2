<?php

class Request extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->uploadTypes = array(
            'doc' => ['allowed_types' => 'pdf|docx'],
            'img' => ['allowed_types' => 'jpg|jpeg|png']
        );
    }

    function id($id, $value)
    {
        return array("md5(sha1(md5(sha1(sha1(md5(md5(sha1(md5(md5($id))))))))))" => $value);
    }

    function acak($text)
    {
        return md5(sha1(md5(sha1(sha1(md5(md5(sha1(md5(md5($text))))))))));
    }

    function cekRelasiUpk($idUpk)
    {
        $hasil = "";
        $harus = "";
        $table = array(
            't_jabatan',
            't_jenis',
            't_sifat',
            't_staf',
            't_tujuan',
            't_aksi',
            't_status'
        );
        foreach ($table as $key) {
            $hasil .= ($this->db->get_where($key, array('id_upk' => $idUpk))->num_rows()) > 0 ? "1" : "0";
            $harus .= "0";
        }
        if ($hasil == $harus) {
            return true;
        } else {
            return false;
        }
    }

    // function getIdUpk($id)
    // {
    //     return $this->db->get_where('t_upk', $this->id($id))->row();
    // }

    function print($array)
    {
        echo "<pre>";
        echo print_r($array);
        echo "</pre>";
    }

    function json($array)
    {
        echo "<pre>";
        echo json_encode($array);
        echo "</pre>";
    }

    function query()
    {
        echo $this->db->last_query();
    }

    function input($input)
    {
        return htmlspecialchars(ltrim(rtrim($_POST[$input])));
    }

    function xss($text)
    {
        return htmlspecialchars(ltrim(rtrim($text)));
    }

    function all($guarded = null)
    {
        $request = $_POST;
        foreach ($request as $key => $value) {
            $result[$key] = $this->input($key);
        }
        if ($guarded != null) {
            foreach ($guarded as $guard_ => $value) {
                if ($value == false) {
                    unset($request[$guard_]);
                } else {
                    unset($request[$guard_]);
                    $request[$guard_] = $value;
                }
            }
        }
        return $request;
    }

    function upload($data)
    {
        $config = array(
            'upload_path' => './uploads/' . $data['path'],
            'encrypt_name' => $data['encrypt']
        );
        $config = array_merge($config, $this->uploadTypes[$data['type']]);
        $this->load->library('upload', $config);
        $uploading = $this->upload->do_upload($data['file']) ? true : false;
        if (!$uploading) {
            return array(
                'message' => 'error',
                'data' => $this->upload->display_errors()
            );
        } else {
            return array(
                'message' => 'success',
                'data' => $this->upload->data()
            );
        }
    }

    function upload_form($data)
    {
        $encrypt = (isset($data['encrypt']) == true) ? true : false;
        $fileName = (isset($data['fileName']) != '') ? $data['fileName'] : null;
        if ($fileName) {
            $config = array(
                'upload_path' => './uploads/' . $data['path'],
                'file_name' => $data['fileName']
            );
        } else {
            $config = array(
                'upload_path' => './uploads/' . $data['path'],
                'encrypt_name' => $encrypt
            );
        }
        // $this->print($config);
        $config = array_merge($config, $this->uploadTypes[$data['type']]);
        $this->load->library('upload', $config);
        $uploading = $this->upload->do_upload($data['file']) ? true : false;
        if (!$uploading) {
            return $data_ = $this->all();
        } else {
            $data_ = $this->all();
            $upload_data = $this->upload->data();
            $result = array_merge($data_, [$data['file'] => $upload_data['file_name']]);
            // print_r($result);
            return $result;
        }
    }
}

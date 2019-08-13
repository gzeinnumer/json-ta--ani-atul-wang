<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Json extends CI_Controller {

    public function __construct(Type $var = null) {
        parent::__construct();
        $this->load->database();
    }

    public function index()
    {
        
    }

    public function getDataUser()
    {
        $array= Array();
        $this->db->select("*");
        $this->db->from("users");
        $data = $this->db->get();
        if($data->num_rows() > 0){
            $array['status'] = true;
            $array['pesan'] = "Data  ada!!";
            //result_data_users
            $array['result_data_users'] = $data->result();
        } else{
            $array['status'] = false;
            $array['pesan'] = "Data tidak ada!!";
        }
        echo json_encode($array);
    }

    public function getDataUserDetail()
    {
        $id=$this->input->post('id');
        $this->db->select("*");
        $this->db->where('id',$id);
        $this->db->from("detail_user");
        $data = $this->db->get();
        if($data->num_rows() > 0){
            $array['status'] = true;
            $array['pesan'] = "Data  ada!!";
            //result_data_detail_users
            $array['result_data_detail_users'] = $data->result();
        } else{
            $array['status'] = false;
            $array['pesan'] = "Data tidak ada!!";
        }
        echo json_encode($array);
    }

    public function login()
    {
        $username=$this->input->post('username');
        $pass=$this->input->post('pass');

        //params 1 namtable
        //params 2 array data untuk prbandingan // kondisi where
        $data = $this->db->get_where('users',array('username' => $username, 'pass' => md5($pass)));
        if($data->num_rows() > 0){
            $array['status'] = true;
            $array['pesan'] = "Sukses login";
            //result_data_detail_users
            $array['result_data_login_users'] = $data->result();
        } else{
            $array['status'] = false;
            $array['pesan'] = "gagal login";
        }
        echo json_encode($array);
    }
}


?>
<?php
Class Pushups_model extends CI_Model
{

  public function __construct()
  {
    $this->load->database();
  }

  public function add_pushups($username, $num_pushups)
  {
    $this->db->select('id');
    $this->db->from('users');
    $this->db->where('username', $username);
    $query = $this -> db -> get();

    if($query -> num_rows() == 1)
    {
      $user_id = $query->row()->id;
      $mysqldate = date("Y-m-d", time());

      $data = array(
                      'user_id' => $user_id,
                      'date'=> $mysqldate,
                      'count'=> $num_pushups
                    );
      $this->db->insert('pushups', $data);
    }
    else
    {
      echo "something went wrong...";
      return false;
    }


  }
}
?>
<?php
Class Pushups_model extends CI_Model
{

  public function __construct()
  {
    $this->load->database();
  }

##### two helper functions:
  public function get_id($username)
  {
    $this->db->select('id');
    $this->db->from('users');
    $this->db->where('username', $username);
    $query = $this->db->get();

    if($query -> num_rows() == 1)
    {
      return $query->row()->id;
    }
    else
    {
      echo "something went wrong...";
      return false;
    }

  }

  public function this_week() #define 'this week' as last monday to next sunday
  {
    $today = date("Y-m-d", time());
    $day_of_week = date("l", time());

    # the below code is not the most efficient way of determining the date range of the current week
    # ...just a quick and easy temporary solution
    if ($day_of_week=="Monday")
    {
      return array('start'=>$today, 'end'=> date('Y-m-d', strtotime($today. ' + 6 days')));
    }
    elseif ($day_of_week=="Tuesday")
    {
      return array('start'=>date('Y-m-d', strtotime($today. ' - 1 days')), 'end'=> date('Y-m-d', strtotime($today. ' + 5 days')));
    }
    elseif ($day_of_week=="Wednesday")
    {
      return array('start'=>date('Y-m-d', strtotime($today. ' - 2 days')), 'end'=> date('Y-m-d', strtotime($today. ' + 4 days')));
    }
    elseif ($day_of_week=="Thursday")
    {
      return array('start'=>date('Y-m-d', strtotime($today. ' - 3 days')), 'end'=> date('Y-m-d', strtotime($today. ' + 3 days')));
    }
    elseif ($day_of_week=="Friday")
    {
      return array('start'=>date('Y-m-d', strtotime($today. ' - 4 days')), 'end'=> date('Y-m-d', strtotime($today. ' + 2 days')));
    }
    elseif ($day_of_week=="Saturday")
    {
      return array('start'=>date('Y-m-d', strtotime($today. ' - 5 days')), 'end'=> date('Y-m-d', strtotime($today. ' + 1 days')));
    }
    elseif ($day_of_week=="Sunday")
    {
      return array('start'=>date('Y-m-d', strtotime($today. ' - 6 days')), 'end'=> $today);
    }
    else
    {
      echo ":(";
      return false;
    }
  }

  public function add_pushups($username, $num_pushups)
  {
    $user_id = $this->get_id($username);
    $mysqldate = date("Y-m-d", time());

    $data = array(
                    'user_id' => $user_id,
                    'date'=> $mysqldate,
                    'count'=> $num_pushups
                  );
    $this->db->insert('pushups', $data);
  }

  public function count_pushups($username=false) 
  {
    if ($username!=false)
    {
      $user_id = $this->get_id($username);
    }

    $this->db->select('count');
    $this->db->from('pushups');
    if ($username!=false)
    {
      $this->db->where('user_id', $user_id);
    }
    $this->db->where('date >=', $this->this_week()['start']);
    $this->db->where('date <=', $this->this_week()['end']);
    $query = $this->db->get();
    $count = 0;

    foreach($query->result() as $row)
    {
      $count += $row->count;
    }
    return $count;
  }
}
?>
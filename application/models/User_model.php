<?php
class User_model extends CI_Model
{
    public function getUser($email, $password)
    {
        $this->db->select("*");
        $query = $this->db->get_where("users", array("email" => $email, "password" => $password ));

        if ($query->num_rows() > 0) { //如果數量大於0
            return $query->row();  //回傳第一筆
        } else {
            return null;
        }
    }

    public function all()
     {
         $query = $this->db->get('users');
         return $query->result_array();
     }

    public function find_by_ids($user_ids)
    {
        $user_ids = array_values(array_unique($user_ids));
        $this->db->where_in('id', $user_ids);
        $query = $this->db->get('users');
        $users = $query->result_array();
        $result = array();
        foreach ($users as $user) {
            $result[$user['id']] = $user;
        }
        return $result;
    }

    public function find($user_id)
    {
        $this->db->where('id', $user_id);
        $query = $this->db->get('users');
        if ($query->num_rows() > 0) { //如果數量大於0
            return $query->row_array();  //回傳第一筆
        } else {
            return null;
        }
    }

    public function create($value)
    {
        $query = $this->db->insert("users", $value);
        if ($query) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

public function update($value, $id)
    {
        $this->db->where('id', $id);
        $query = $this->db->update('users', $value);
        return $query;
    }
    public function destroy($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->delete('users');
        return $query;
    }
}
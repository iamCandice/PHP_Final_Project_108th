<?php
class Article_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function insert($value, $author_id=null)
    {
        $value['user_id'] = $author_id;
        $query = $this->db->insert("articles", $value);
        if ($query) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function getALL()
    {
        $query = $this->db->get('articles');
        return $query->result_array();
    }

    public function find_active()
    {
        $this->db->where('status', 'active');
        $query = $this->db->get('articles');
        return $query->result_array();
    }

    public function get($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('articles');
        if ($query->num_rows() <= 0) {
            return null; //無資料時回傳 null
        }
        return $query->row_array();  //回傳第一筆
    }

    public function gettag($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('tags');
        
        if ($query->num_rows() <= 0) {
            return null; //無資料時回傳 null
        }
        return $query->row_array();  //回傳第一筆
    }

    public function update($value, $id)
    {
        $this->db->where('id', $id);
        $query = $this->db->update('articles', $value);
        return $query;
    }

    public function destroy($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->delete('articles');
        return $query;
    }

    public function find_by_author($author_id)
    {
        $this->db->where('user_id', $author_id);
        $query = $this->db->get('articles');
        return $query->result_array();
    }
}

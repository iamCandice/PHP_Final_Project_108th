<?php 

class Tag_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_all() {
        return $this->db->query("select * from tags")->result();
    }

    public function get_tags($article_id) {
        return $this->db->query("select * from article_tags where article_id = ". $article_id)->result();
    }

    public function gettag($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('tags');
        
        if ($query->num_rows() <= 0) {
            return null; 
        }
        return $query->row_array();
    }
}
    
?>
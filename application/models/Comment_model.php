<?php
class Comment_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function find_by_article($article_id)
    {
        $this->db->where('article_id', $article_id);
        $query = $this->db->get('comments');
        if ($query->num_rows() <= 0) {
            return null;
        }
        return $query->result_array();
    }
    public function create($value)
    {
        $query = $this->db->insert("comments", $value);
        return $query;
    }
}

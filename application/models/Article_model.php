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

    public function insert_tag($article_id, $tags) {
        $this->db->query("DELETE FROM article_tags WHERE article_id = " . $article_id);
        foreach ($tags as $tag) {
            $this->db->insert("article_tags", array("article_id" => $article_id, "tag_id" => $tag));
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
            return null;
        }
        return $query->row_array();
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

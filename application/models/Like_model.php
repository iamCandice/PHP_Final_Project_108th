<?php
class Like_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function insert($user_id=null, $article_id=null)
    {
        if (empty($user_id) || empty($user_id)) {
            return false;
        }
        $value['user_id'] = $user_id;
        $value['article_id'] = $article_id;
        $query = $this->db->insert("likes", $value);
        if ($query) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function destroy($user_id=null, $article_id=null)
    {
        if (empty($user_id) || empty($user_id)) {
            return false;
        }
        $this->db->where('user_id', $user_id);
        $this->db->where('article_id', $article_id);
        $query = $this->db->delete('likes');
        return $query;
    }

    public function is_exists($user_id=null, $article_id=null)
    {
        if (empty($user_id) || empty($article_id)) {
            return false;
        }
        $this->db->where('user_id', $user_id);
        $this->db->where('article_id', $article_id);
        $query = $this->db->get('likes');
        if ($query->num_rows() <= 0) {
            return false;
        }
        return true;
    }

    public function article_likes($article_id=null)
    {
        if (empty($article_id)) {
            return false;
        }
        $this->db->where('article_id', $article_id);
        $query = $this->db->get('likes');
        return $query->result_array();
    }

   public function hot_likes($num = 10)/*取10個*/
    {
        $this->db->select('article_id, count(*) as total')/*把article_id在like裡面出現的次數算出來*/                                 ->group_by('article_id')
            ->order_by('total', 'DESC');/*算出來之後由多到少排出來*/
        $query = $this->db->get('likes', $num);
        return $query->result_array();
    }

   public function hot_tags($num = 10)/*取10個*/
    {
    $this->db->select('tag_id, count(*) as total')
            ->group_by('tag_id')
            ->order_by('total', 'DESC');/*算出來之後由多到少排出來*/
        $query = $this->db->get('article_tags', $num);
        return $query->result_array();
    }
    public function get_member_analysis() {
        return $this->db->query("SELECT date_format(created_at, '%y-%M') as month, count(*) as total FROM `users` GROUP by date_format(created_at, '%y-%M')")
            ->result_array();
    }
}

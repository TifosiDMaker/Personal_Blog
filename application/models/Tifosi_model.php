<?php
class Tifosi_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function signup()
    {
        $data = array(
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('password')),
            'permission' => 1,
        );

        return $this->db->insert('users', $data);
    }

    public function userQuery()
    {
        $query = $this->db->get_where('users', array('username' => $this->input->post('username')));
        $row = $query->row();

        if (isset($row)) {
            if ($row->password == md5($this->input->post('password'))) {
                return array(
                    'username' => $this->input->post('username'),
                    'id' => $row->permission
                );
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function writeArticle()
    {
        $query = $this->db->get_where('posts', array('post_title' => $this->input->post('articleTitle')));
        $row = $query->row();

        $data = array(
            'post_title' => $this->input->post('articleTitle'),
            'post_content' => $this->input->post('article'),
            'post_status' => $this->input->post('status')
        );

        if (isset($row)) {
            return $this->db->update('posts', $data, array('id' => $row->id));
        } else {
            return $this->db->insert('posts', $data);
        }
    }

    public function idQuery($name, $column)
    {
        $this->db->where('term_name', $name);
        $this->db->where('term_group', $column);

        $query = $this->db->get('terms');
        $row = $query->row();

        if (isset($row)) {
            return $row->term_id;
        } else {
            return 0;
        }
    }

    public function sqlitTag()
    {
        return $tags = explode(',', $this->input->post('tags'));
    }

    public function delRelation()
    {
        $query = $this->db->get_where('posts', array('post_title' => $this->input->post('articleTitle')));
        $row = $query->row();

        $id = $row->id;
        $this->db->where('article_id', $id);
        $this->db->delete('relationship');
    }

    public function relation($name)
    {
        $query = $this->db->get_where('posts', array('post_title' => $this->input->post('articleTitle')));
        $row = $query->row();

        //if (isset($row)) {
        $id = $row->id;
        //} else {
        //    $id = 1000;
        //}

        $data = array(
            'article_id' => $id,
            'term_id' => $name
        );

        return $this->db->insert('relationship', $data);
    }

    public function term($name, $group)
    {
        $data = array(
            'term_name' => $name,
            'term_group' => $group
        );

        return $this->db->insert('terms', $data);
    }

    public function termQuery($term)
    {
        $query = $this->db->get_where('terms', array('term_group' => $term));

        return $query->result();
    }

    public function articleQuery($id = false, $page = 1, $term = 0)
    {
        if ($id === false) {
            $this->db->select('*');
            $this->db->from('posts');

            if ($term) {
                if (is_numeric($term)) {
                    $this->db->join('relationship', 'relationship.article_id = posts.id');
                    $this->db->where('term_id', $term);
                } else {
                    $this->db->where($term);
                }
            } else {
                $this->db->where('post_status', 'public');
            }

            $this->db->order_by('post_date', 'DESC');
            $this->db->limit(10, ($page - 1) * 10);

            $query = $this->db->get();
            return $query->result();
        } else {
            $query = $this->db->get_where('posts', array('id' => $id));

            return $query->row();
        }
    }

    public function getTerm($aid, $tid)
    {
        $this->db->select('*');
        $this->db->from('relationship');
        $this->db->join('terms', 'terms.term_id = relationship.term_id');
        $this->db->where('article_id', $aid);
        if ($tid == 1) {
            $this->db->where('term_group', $tid);
            $query = $this->db->get();

            return $query->result();
        } elseif ($tid == 2) {
            $this->db->where('term_group', $tid);
            $query = $this->db->get();

            return $query->row();
        }
    }

    public function comment()
    {
        $data = array(
            'comment' => $this->input->post('comment'),
            'post_id' => $this->input->post('id'),
            'user' => $_SESSION['username']
            );

        return $this->db->insert('comments', $data);
    }

    public function commentQuery($id, $page = 1, $filter = 0)
    {
        if ($id) {
            $this->db->where(array('post_id' => $id, 'status' => 'checked'));
            $this->db->order_by('id', 'DESC');

            $query = $this->db->get('comments');

            return $query->result();
        } else {
            $this->db->select('p.id as pid, p.post_title, c.user, c.post_id, c.comment, c.time, c.id, c.status', false);
            $this->db->from('posts as p');
            $this->db->join('comments as c', 'c.post_id = p.id');
            $this->db->where($filter);
            $this->db->order_by('time', 'DESC');
            $this->db->limit(10, ($page - 1) * 10);

            $query = $this->db->get();
            return $query->result();
        }
    }

    public function entryCount($table, $where = 0)
    {
        if ($where) {
            $this->db->from($table);
            $this->db->where($where);

            return $this->db->count_all_results();
        } else {
            return $this->db->count_all($table);
        }
    }

    public function deleteTerm($term_id)
    {
        $data = array(
            'term_id' => 44,
        );

        $this->db->where('term_id', $term_id);
        $this->db->delete('terms');
        $this->db->update('relationship', $data, array('term_id' => $term_id));
    }

    public function editTerm($term_id, $term_name)
    {
        $data['term_name'] = $term_name;

        $this->db->where('term_id', $term_id);

        $this->db->update('terms', $data);
    }

    public function moveToTrash($table, $id)
    {
        $this->db->where('id', $id);

        if ($table == 'posts') {
            $col = 'post_status';
        } elseif ($table == 'comments') {
            $col = 'status';
        }

        $this->db->update($table, array($col => 'trash'));
    }

    public function outOfTrash($table, $id)
    {
        $this->db->where('id', $id);

        if ($table == 'posts') {
            $col = 'post_status';
            $value = 'public';
        } elseif ($table == 'comments') {
            $col = 'status';
            $value = 'checked';
        }

        $this->db->update($table, array($col => $value));
    }

    public function deleteItem($table, $id)
    {
        $this->db->where('id', $id);

        $this->db->delete($table);
    }

    public function changePassword()
    {
        $data['password'] = md5($this->input->post('newPassword'));

        $this->db->where('username', $_SESSION['username']);

        $this->db->update('users', $data);
    }

    public function passwordQuery()
    {
        $query = $this->db->get_where('users', array('username' => $_SESSION['username']));
        return $query->row();
    }

    public function userListQuery()
    {
        $query = $this->db->get('users');

        return $query->result();
    }
}

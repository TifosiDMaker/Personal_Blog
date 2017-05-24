<?php
class Admin extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('tifosi_model');
        $this->load->library(array('user_agent', 'pagination'));
        $this->load->helper(array('form', 'url'));
    }

    public function writeArticle($id = 0)
    {
        $this->load->library('form_validation');

        $data['title'] = 'Write Article';
        $data['term'] = $this->tifosi_model->termQuery(2);
        if ($id) {
            $article = $this->tifosi_model->articleQuery($id);
            $tag = $this->tifosi_model->getTerm($id, 1);
            $category = $this->tifosi_model->getTerm($id, 2);

            $a = '';
            foreach ($tag as $one) {
                $a .= $one->term_name.',';
            }
            $a = substr($a, 0, -1);

            $data['post_title'] = $article->post_title;
            $data['post_content'] = $article->post_content;
            $data['post_status'] = $article->post_status;
            $data['post_category'] = $category->term_name;
            $data['post_tag'] = $a;
        }

        $this->form_validation->set_rules('articleTitle', '标题', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('header', $data);
            $this->load->view('user_header');
            $this->load->view('admin/all_articles_js.php');
            $this->load->view('admin/admin_sidebar');
            if ($id) {
                $this->load->view('admin/edit_article');
            } else {
                $this->load->view('admin/write_article');
            }
            $this->load->view('footer');
        } else {
            $this->tifosi_model->writeArticle();
            $this->tifosi_model->delRelation();

            $tags = explode(',', $this->input->post('tags'));

            foreach ($tags as $tag) {
                if (!$this->tifosi_model->idQuery($tag, 1)) {
                    $this->tifosi_model->term($tag, 1);
                }
                $query_tag = $this->tifosi_model->idQuery($tag, 1);
                $this->tifosi_model->relation($query_tag);
            }

            $post_cate = $this->input->post('category');
            $query_cate = $this->tifosi_model->idQuery($post_cate, 2);
            $this->tifosi_model->relation($query_cate);

            $data['title'] = 'Success';

            $this->load->view('header', $data);
            $this->load->view('user_header');
            $this->load->view('success');
            $this->load->view('footer');
        }

    }

    public function loginsuccess()
    {
        $data['title'] = 'Success';

        $this->load->view('header', $data);
        $this->load->view('admin/signupsuccess');
        $this->load->view('footer');
    }

    public function terms($term)
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', '名称', 'required');

        $data['terms'] = $this->tifosi_model->termQuery($term);
        $data['term'] = $term;

        if ($term == 2) {
            $data['header'] = '分类';
            $data['title'] = '分类';
        } elseif ($term == 1) {
            $data['header'] = '标签';
            $data['title'] = '标签';
        }

        if ($this->admin_driver->sessionVali()) {
            if ($this->form_validation->run() == false) {
                $this->load->view('header', $data);
                $this->load->view('admin/confirm_box');
                $this->load->view('admin/all_articles_js.php');
                $this->load->view('user_header');
                $this->load->view('admin/admin_sidebar');
                $this->load->view('admin/terms');
                $this->load->view('footer');
            } else {

                $post_name = $this->input->post('name');
                $post_term = $this->input->post('term');
                $this->tifosi_model->term($post_name, $post_term);

                redirect($this->agent->referrer());
            }
        }
    }

    public function deleteTerm($term_id)
    {
        $this->tifosi_model->deleteTerm($term_id);

        redirect($this->agent->referrer());
    }

    public function editTerm()
    {
        $term_id = $this->input->post('term_id');
        $term_name = $this->input->post('term_name');

        $this->tifosi_model->editTerm($term_id, $term_name);

        redirect($this->agent->referrer());
    }

    public function allArticles($filter = 'all', $page = 0)
    {
        $config['base_url'] = base_url().'index.php?/admin/allArticles/'.$filter.'/';
        $config['first_url'] = base_url().'index.php?/admin/allArticles/'.$filter.'/1';

        $data['filter'] = $filter;

        if ($filter == 'all') {
            $filter = array('post_status !=' => 'trash');
        } else {
            $filter = array('post_status' => $filter);
        }

        $config['total_rows'] = $this->tifosi_model->entryCount('posts', $filter);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;

        $this->pagination->initialize($config);

        $data['title'] = 'All article';
        $data['article'] = $this->tifosi_model->articleQuery(false, $page, $filter);
        $data['links'] = $this->pagination->create_links();
        $data['count'] = array(
            'all' => $this->tifosi_model->entryCount('posts', array('post_status !=' => 'trash')),
            'public' => $this->tifosi_model->entryCount('posts', array('post_status' => 'public')),
            'private' => $this->tifosi_model->entryCount('posts', array('post_status' => 'private')),
            'draft' => $this->tifosi_model->entryCount('posts', array('post_status' => 'draft')),
            'trash' => $this->tifosi_model->entryCount('posts', array('post_status' => 'trash')),
        );

        $this->load->view('header', $data);
        $this->load->view('admin/all_articles_js.php');
        $this->load->view('user_header');
        $this->load->view('admin/admin_sidebar');
        $this->load->view('admin/all_articles');
        $this->load->view('footer');
    }

    public function comments($filter = 'all', $page = 1)
    {
        $config['base_url'] = base_url().'index.php?/admin/comment/'.$filter.'/';
        $config['first_url'] = base_url().'index.php?/admin/comment/'.$filter.'/';

        $data['filter'] = $filter;

        if ($filter =='all') {
            $filter = array('status !=' => 'trash');
        } else {
            $filter = array('status' => $filter);
        }

        $config['total_rows'] = $this->tifosi_model->entryCount('comments', $filter);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;

        $this->pagination->initialize($config);

        $data['title'] = 'Comments';
        $data['comment'] = $this->tifosi_model->commentQuery(false, $page, $filter);
        $data['links'] = $this->pagination->create_links();
        $data['count'] = array(
            'all' => $this->tifosi_model->entryCount('comments', array('status !=' => 'trash')),
            'checked' => $this->tifosi_model->entryCount('comments', array('status' => 'checked')),
            'uncheck' => $this->tifosi_model->entryCount('comments', array('status' => 'uncheck')),
            'trash' => $this->tifosi_model->entryCount('comments', array('status' => 'trash')),
        );

        $this->load->view('header', $data);
        $this->load->view('admin/all_articles_js');
        $this->load->view('user_header');
        $this->load->view('admin/admin_sidebar');
        $this->load->view('admin/comments');
        $this->load->view('footer');
    }

    public function account()
    {
        $data['title'] = 'Account Setting';
        $data['password'] = $this->tifosi_model->passwordQuery();

        $this->load->view('header', $data);
        $this->load->view('admin/all_articles_js');
        $this->load->view('user_header');
        $this->load->view('admin/admin_sidebar');
        $this->load->view('admin/accSet');
        $this->load->view('footer');
    }

    public function accSet()
    {
        $this->tifosi_model->changePassword();

        redirect($this->agent->referrer());
    }

    public function moveToTrash($table, $id)
    {
        $this->tifosi_model->moveToTrash($table, $id);

        redirect($this->agent->referrer());
    }

    public function outOfTrash($table, $id)
    {
        $this->tifosi_model->outOfTrash($table, $id);

        redirect($this->agent->referrer());
    }

    public function deleteItem($table, $id)
    {
        $this->tifosi_model->deleteItem($id);

        redirect($this->agent->referrer());
    }
}

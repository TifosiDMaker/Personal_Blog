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
        
        $data['title'] = 'Management';
        $data['term'] = $this->tifosi_model->term_query(2);
        if ($id) {
            $article = $this->tifosi_model->article_query($id);
            $tag = $this->tifosi_model->get_term($id, 1);
            $category = $this->tifosi_model->get_term($id, 2);
            
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
            $this->load->view('admin/admin_sidebar');
            if ($id) {
                $this->load->view('admin/edit_article');
            } else {
                $this->load->view('admin/write_article');
            }
            $this->load->view('footer');
        } else {
            $this->tifosi_model->write_article();

            $tags = explode(',', $this->input->post('tags'));

            foreach ($tags as $tag) {
                if (!$this->tifosi_model->id_query($tag, 1)) {
                    $this->tifosi_model->term($tag, 1);
                }
                $query_tag = $this->tifosi_model->id_query($tag, 1);
                $this->tifosi_model->relation($query_tag);
            }

            $post_cate = $this->input->post('category');
            $query_cate = $this->tifosi_model->id_query(post_cate, 2);
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

        $data['terms'] = $this->tifosi_model->term_query($term);
        $data['term'] = $term;

        if ($term == 2) {
            $data['header'] = '分类';
            $data['title'] = '分类';
        } elseif ($term == 1) {
            $data['header'] = '标签';
            $data['title'] = '标签';
        }

        if ($this->admin_driver->session_vali()) {
            if ($this->form_validation->run() == false) {
                $this->load->view('header', $data);
                $this->load->view('admin/confirm_box');
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
        $this->tifosi_model->delete_term($term_id);

        redirect($this->agent->referrer());
    }
    
    public function editTerm()
    {
        $term_id = $this->input->post('term_id');
        $term_name = $this->input->post('term_name');

        $this->tifosi_model->edit_term($term_id, $term_name);

        redirect($this->agent->referrer());
    }

    public function allArticles($filter = 'all', $page = 0)
    {
        $config['base_url'] = base_url().'index.php?/admin/all_articles/'.$filter.'/';
        $config['first_url'] = base_url().'index.php?/admin/all_articles/'.$filter.'/1';

        $data['filter'] = $filter;

        if ($filter == 'all') {
            $filter = array('post_status !=' => 'trash');
        } else {
            $filter = array('post_status' => $filter);
        }

        $config['total_rows'] = $this->tifosi_model->entry_count('posts', $filter);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;

        $this->pagination->initialize($config);

        $data['title'] = 'All article';
        $data['article'] = $this->tifosi_model->article_query(false, $page, $filter);
        $data['links'] = $this->pagination->create_links();
        $data['count'] = array(
            'all' => $this->tifosi_model->entry_count('posts', array('post_status !=' => 'trash')),
            'public' => $this->tifosi_model->entry_count('posts', array('post_status' => 'public')),
            'private' => $this->tifosi_model->entry_count('posts', array('post_status' => 'private')),
            'draft' => $this->tifosi_model->entry_count('posts', array('post_status' => 'draft')),
            'trash' => $this->tifosi_model->entry_count('posts', array('post_status' => 'trash')),
        );

        $this->load->view('header', $data);
        $this->load->view('admin/all_articles_js.php');
        $this->load->view('user_header');
        $this->load->view('admin/admin_sidebar');
        $this->load->view('admin/all_articles');
        $this->load->view('footer');
    }

    public function moveToTrash($id)
    {
        $this->tifosi_model->move_to_trash($id);

        redirect($this->agent->referrer());
    }

    public function outOfTrash($id)
    {
        $this->tifosi_model->out_of_trash($id);

        redirect($this->agent->referrer());
    }

    public function deleteArticle($id)
    {
        $this->tifosi_model->delete_article($id);

        redirect($this->agent->referrer());
    }
}


<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *Описание файла: Контролер по работе с Меню
 *
 * 
 * @Изменён 12.03.2012
 */
class Article extends CI_Controller {
    
    var $article_id;
    
    function show_articles(){
        
        $this->load->model('mdl_article');
        
        if($_POST){
            switch ($_POST['type']){
                case 'delete_article':
                    if($this->mdl_article->delete_article($_POST['article_id'] )){
                        echo 'true';
                    }else{
                        echo 'false';
                    }
                break;
                case 'published':
                    if($this->mdl_article->published($_POST['article_id'], $_POST['published'])){
                        echo 'true';
                    }else{
                        echo 'false';
                    }
                break;   
            }

        }else{
            $left_menu['data'] = $this->mdl_common->get_menu();
            $content['articles'] = $this->mdl_article->get_articles();
            $this->load->view('header');
            $this->load->view('left_menu',$left_menu);
            $this->load->view('article/show_articles',$content);
            $this->load->view('footer');   
        }
        
    }
    
    function create_article(){
        
        $this->load->model('mdl_article');
        if($_POST){
            if($this->mdl_article->create_article($_POST)){
                redirect('/article/show_articles/');
            }
        }else{
            $left_menu['data'] = $this->mdl_common->get_menu();
            $content['positions'] = $this->mdl_article->get_positions();
            $content['menu_items'] = $this->mdl_article->get_menu_items();
            $this->load->view('header');
            $this->load->view('left_menu',$left_menu);
            $this->load->view('article/create_article',$content);
            $this->load->view('footer');             
        }
        
    }
    
    function edit_article($article_id = ''){
        
        $this->load->model('mdl_article');
        
        if($_POST){
            if(!isset ($_POST['type'])){
                if($this->mdl_article->edit_article($_POST,$article_id)){
                    redirect('/article/show_articles/');
                }
            }else{                
                
            }          
        }else{
            $left_menu['data'] = $this->mdl_common->get_menu();
            $content['positions'] = $this->mdl_article->get_positions();
            $content['article'] = $this->mdl_article->get_article($article_id);
            $content['menu_items'] = $this->mdl_article->get_menu_items();
            $this->load->view('header');
            $this->load->view('left_menu',$left_menu);
            $this->load->view('article/edit_article',$content);
            $this->load->view('footer');            
        }
        
    }
    
    
    
        
}
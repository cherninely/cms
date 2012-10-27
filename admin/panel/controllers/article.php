<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
if(!isset($_SESSION['access']) || $_SESSION['access'] == false) header('Location: /'); 
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
            $content['articles'] = $this->mdl_article->get_articles();
            $this->load->view('header');
            $this->load->view('article/show_articles',$content);
            $this->load->view('footer');   
        }
        
    }
    
    function create_article(){
        
        $this->load->model('mdl_article');
        if($_POST){
            $id = $this->mdl_article->create_article($_POST);
            if($id){
                switch ($_POST['type']) {
                    case 'save':
                        redirect('/article/show_articles/');
                        break;
                    case 'apply':
                        redirect('/article/edit_article/'.$id.'/');
                        break;
                }
            }
        }else{
            
            $content['menu_items_in_block'] = $this->mdl_common->get_menu_items_in_block();
            $content['positions'] = $this->mdl_article->get_positions();
            $this->load->view('header');
            $this->load->view('article/create_article',$content);
            $this->load->view('footer');             
        }
        
    }
    
    function edit_article($article_id = ''){
        
        $this->load->model('mdl_article');
        
        if($_POST){
            if($this->mdl_article->edit_article($_POST,$article_id)){
                switch ($_POST['type']) {
                    case 'save':
                        redirect('/article/show_articles/');
                        break;
                    case 'apply':
                        redirect('/article/edit_article/'.$article_id.'/');
                        break;
                }
                redirect('/article/show_articles/');
            }          
        }else{
            $content['menu_items_in_block'] = $this->mdl_common->get_menu_items_in_block($article_id);
            $content['positions'] = $this->mdl_article->get_positions();
            $content['article'] = $this->mdl_article->get_article($article_id);
            $this->load->view('header');
            $this->load->view('article/edit_article',$content);
            $this->load->view('footer');            
        }
        
    }
    
    
    
        
}
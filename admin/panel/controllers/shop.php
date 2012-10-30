<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!isset($_SESSION['access']) || $_SESSION['access'] == false) header('Location: /'); 
/**
 *Описание файла: Контролер по работе с  новостями
 *
 * 
 * @Изменён 12.03.2012
 */
class News extends CI_Controller {
    
    var $news_item_id;
    
    
//    список новостей
    function show($cat_id = ''){
        
        $this->load->model('mdl_news');
        
        if($_POST){
            switch ($_POST['type']){
                case 'delete_news_item':
                    if($this->mdl_news->delete($_POST['news_item_id'] )){
                        echo 'true';
                    }else{
                        echo 'false';
                    }
                break;
                case 'published':
                    if($this->mdl_news->published($_POST['news_item_id'], $_POST['published'])){
                        echo 'true';
                    }else{
                        echo 'false';
                    }
                break;   
            }

        }else{
            $content['news'] = $this->mdl_news->get_news($cat_id);
            $content['cat_id'] = $cat_id;
            $content['cat_name'] = $this->mdl_news->get_cat($cat_id);
            $this->load->view('header');
            $this->load->view('news/show',$content);
            $this->load->view('footer');   
        }
        
    }
    
    function create($cat_id = ''){
        
        $this->load->model('mdl_news');
        if($_POST){
            if(isset ($_POST['type']) && $_POST['type'] == 'delete_img'){
                if(file_exists($_SERVER['DOCUMENT_ROOT'].'/i/uploaded/'.$_POST['img_name'])){
                    echo $this->mdl_news->deleteImgFromNews($_POST['img_name'],$_POST['id']);                    
                }else{
                    echo 'false';
                }
            }elseif(isset ($_POST['type']) && $_POST['type'] == 'add_img'){
                echo $this->mdl_news->addImgFromNews($_POST['img_name'],$_POST['id']);
            }elseif(isset ($_POST['type']) && $_POST['type'] == 'save'){
                if($this->mdl_news->create($_POST)){
                    redirect("/news/show/{$cat_id}/");                    
                }
            }elseif(isset ($_POST['type']) && $_POST['type'] == 'apply'){
                $id = $this->mdl_news->create($_POST);
                if($id){
                    redirect("/news/edit/{$id}/{$cat_id}/");
                }                
            }
        }else{
            $content['cat_id'] = $cat_id;
            $this->load->view('header');
            $this->load->view('news/create',$content);
            $this->load->view('footer');             
        }
        
    }
    
    function edit($news_item_id = '', $cat_id = ''){
        
        $this->load->model('mdl_news');
        
        if($_POST){
            if($this->mdl_news->edit($_POST, $news_item_id)){
                switch ($_POST['type']) {
                    case 'save':
                        redirect("/news/show/{$cat_id}/");
                        break;
                    case 'apply':
                        redirect("/news/edit/{$news_item_id}/{$cat_id}/");
                        break;
                }
            }          
        }else{
            $content['cat_id'] = $cat_id;
            $content['news'] = $this->mdl_news->get_news_item($news_item_id);
            $this->load->view('header');
            $this->load->view('news/edit',$content);
            $this->load->view('footer');          
        }
        
    }
    
    
    
    function show_news_cats(){        
        
        $this->load->model('mdl_news');
        
        if($_POST){
            
            switch ($_POST['type']){
                case 'delete_news_cat':
                    if($this->mdl_news->delete_cat($_POST['news_cat_id'] )){
                        echo 'true';
                    }else{
                        echo 'false';
                    }
                break;
                case 'published':
                    if($this->mdl_news->published_cat($_POST['news_cat_id'], $_POST['published'])){
                        echo 'true';
                    }else{
                        echo 'false';
                    }
                break;   
            }
            
        }else{
            $content['news_cats'] = $this->mdl_news->get_news_cats();
            $this->load->view('header');
            $this->load->view('news/news_cats/show',$content);
            $this->load->view('footer');          
        }
        
    }
    function create_cat(){
        
        $this->load->model('mdl_news');
        if($_POST){            
            if($this->mdl_news->create_cat($_POST)){
                redirect('/news/show_news_cats/');
            }            
        }else{
            $this->load->view('header');
            $this->load->view('news/news_cats/create');
            $this->load->view('footer');             
        }
        
    }
    
    
    function edit_cat($cat_id = ''){
        
        $this->load->model('mdl_news');
        
        if($_POST){
            if($this->mdl_news->edit_cat($_POST,$cat_id)){
                redirect('/news/show_news_cats/');
            }          
        }else{
            $content['cat'] = $this->mdl_news->get_cat($cat_id);
            $this->load->view('header');
            $this->load->view('news/news_cats/edit',$content);
            $this->load->view('footer');          
        }
        
    }
    
    
    
        
}
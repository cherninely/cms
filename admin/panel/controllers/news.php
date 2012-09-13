<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *Описание файла: Контролер по работе с  новостями
 *
 * 
 * @Изменён 12.03.2012
 */
class News extends CI_Controller {
    
    var $news_item_id;
    
    function show(){
        
        $this->load->model('mdl_news');
        $left_menu['data'] = $this->mdl_common->get_menu();
        
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
            $content['news'] = $this->mdl_news->get_news();
            $this->load->view('header');
            $this->load->view('left_menu',$left_menu);
            $this->load->view('news/show',$content);
            $this->load->view('footer');   
        }
        
    }
    
    function create(){
        
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
            }elseif($this->mdl_news->create($_POST)){
                redirect('/news/show/');
            }
        }else{
            $left_menu['data'] = $this->mdl_common->get_menu();
            $this->load->view('header');
            $this->load->view('left_menu',$left_menu);
            $this->load->view('news/create');
            $this->load->view('footer');             
        }
        
    }
    
    function edit($news_item_id = ''){
        
        $this->load->model('mdl_news');
        
        if($_POST){
            if(!isset ($_POST['type'])){
                if($this->mdl_news->edit($_POST, $news_item_id)){
                    redirect('/news/show/');
                }
            }else{                
                
            }          
        }else{
            $left_menu['data'] = $this->mdl_common->get_menu();
            $content['news'] = $this->mdl_news->get_news_item($news_item_id);
            $this->load->view('header');
            $this->load->view('left_menu',$left_menu);
            $this->load->view('news/edit',$content);
            $this->load->view('footer');          
        }
        
    }
    
    
    
        
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!isset($_SESSION['access']) || $_SESSION['access'] == false) header('Location: /'); 

/**
 *Описание файла: Контролер по работе с Галлереей
 *
 * 
 * @Изменён 12.03.2012
 */
class Gallery extends CI_Controller {
       
        /**
         *Описание функции: Страница создания категории галлереи.
         */
        public function create(){
            
            $this->load->model('mdl_gallery');
            if($_POST){
                $cat_id = $this->mdl_gallery->create_cat($_POST);   
                if($cat_id){
                    redirect('/gallery/show/');
                }
            }else{
                
                $ru_date['date'] = $this->mdl_common->russian_date();
                $this->load->view('header');
                $this->load->view('gallery/create',$ru_date);
                $this->load->view('footer'); 
                
            }
           
            
        }
        /**
         *Описание функции: Страница списка категорий галлереи.
         */
        public function show(){
            
             $this->load->model('mdl_gallery');
             
             if($_POST){
                switch ($_POST['type']){
                    case 'delete_cat_item':
                        if($this->mdl_gallery->delete_cat($_POST['cat_item_id'] )){
                            echo 'true';
                        }else{
                            echo 'false';
                        }
                    break;
                    case 'published':
                        if($this->mdl_gallery->published_cat($_POST['cat_item_id'], $_POST['published'])){
                            echo 'true';
                        }else{
                            echo 'false';
                        }
                    break;   
                }

             }else{
                $content['categories'] = $this->mdl_gallery->get_categories();
                $this->load->view('header');
                $this->load->view('gallery/show',$content);
                $this->load->view('footer');   
             } 
            
        }
         /**
         *Описание функции: Страница изменения категории.
         */
        public function edit($cat_id = ''){
            
            
            $this->load->model('mdl_gallery');
        
            if($_POST){
                if($this->mdl_gallery->save_cat_after_edit($_POST, $cat_id)){
                    redirect('/gallery/show/');
                }
            }else{                
                $content['data'] = $this->mdl_gallery->get_cat($cat_id);
                $this->load->view('header');
                $this->load->view('gallery/edit',$content);
                $this->load->view('footer');
            }
            
        }                     
        /**
         *Описание функции: Страница добавления
         */
        public function show_photos($cat_id = ''){
            
            $this->load->model('mdl_gallery');
            
            if($_POST){
                switch ($_POST['type']){
                    case 'delete_img':
                        if($this->mdl_gallery->delete_img($_POST['id'], $_POST['suffix'])){
                            echo 'true';
                        }else{
                            echo 'false';
                        }
                    break;  
                }
            }else{ 
                $content['cat_name'] = $this->mdl_gallery->get_cat_name($cat_id);
                $content['cat_id'] = $cat_id;
                $content['photos'] = $this->mdl_gallery->get_photos($cat_id);
                $this->load->view('header');
                $this->load->view('gallery/photos/show',$content);
                $this->load->view('footer');
            }
            
        }
        /**
         *Описание функции: Страница изображений галлереи
         */
        public function upload_photos($cat_id = ''){            
            
            $this->load->model('mdl_gallery');
            $this->load->library('class_gallery');
  
            if($_SERVER['REQUEST_METHOD'] != 'GET'){

                switch ($_SERVER['REQUEST_METHOD']) {
                    
                    case 'OPTIONS':
                        break;
                    case 'HEAD':
                    case 'GET':
                        $this->class_gallery->get();
                        break;
                    case 'POST':
                        if(isset ($_POST['file_name'])){
                            $this->class_gallery->delete();
                        }else{
                            $this->class_gallery->post($this->uri->rsegment(3));
                        }        
                        break;
                        
                }

            }else{

                $content['cat_name'] = $this->mdl_gallery->get_cat_name($cat_id);
                $content['cat_id'] = $cat_id;
                $this->load->view('header');
                $this->load->view('gallery/photos/upload',$content);
                $this->load->view('footer');

            }
                
                
            
        }
        
        
}
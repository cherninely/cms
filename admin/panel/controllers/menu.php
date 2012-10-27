<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!isset($_SESSION['access']) || $_SESSION['access'] == false) header('Location: /'); 
/**
 *Описание файла: Контролер по работе с Меню
 *
 * 
 * @Изменён 12.03.2012
 */
class Menu extends CI_Controller {
       
        var $menu;
        /**
         *Описание функции: Страница создания меню.
         */
        public function create_menu(){
            
        $this->load->model('mdl_menu');
            
            if($_POST){
                if($this->mdl_menu->create_menu($_POST)){
                    redirect('/menu/show_menus/');
                }
            }else{
                $content['positions'] = $this->mdl_common->get_positions();
                $content['menu_items_in_block'] = $this->mdl_common->get_menu_items_in_block();
                $this->load->view('header');
                $this->load->view('menu/create_menu',$content);
                $this->load->view('footer'); 
                
            }
            
        } 
        /**
         *Описание функции: Страница просмотра меню.
         */
        public function show_menus(){
            
            $this->load->model('mdl_menu');
            
            if($_POST){
                
                switch ($_POST['type']){
                    case 'delete_menu':
                        if($this->mdl_menu->delete_menu($_POST['menu_id'])){
                            echo 'true';
                        }else{
                            echo 'false';
                        }
                    break;
                    case 'published':
                        if($this->mdl_menu->published_menu($_POST['menu_id'], $_POST['published'])){
                            echo 'true';
                        }else{
                            echo 'false';
                        }
                    break;    
                }               
                
                
            }else{
                
                $content['menus'] = $this->mdl_menu->get_menus() ;
                $this->load->view('header');
                $this->load->view('menu/show_menus',$content);
                $this->load->view('footer'); 
                
            }
            
        }
         /**
         *Описание функции: Страница изменения пункта меню.
         */
        public function edit_menu($menu_id = ''){
            
            
        $this->load->model('mdl_menu');
        
            if($_POST){
                if($this->mdl_menu->save_menu_after_edit($_POST, $menu_id)){
                    redirect('/menu/show_menus/');
                }
            }else{                
                $content['data'] = $this->mdl_menu->get_menu($menu_id);
                $content['positions'] = $this->mdl_common->get_positions();
                $content['menu_items_in_block'] = $this->mdl_common->get_menu_items_in_block($menu_id);
                $this->load->view('header');
                $this->load->view('menu/edit_menu',$content);
                $this->load->view('footer');
            }
            
        }

        /**
         *Описание функции: Страница просмотра пунктов меню.
         */
        public function show_menu_items($menu = ''){
            
        $this->load->model('mdl_menu');
        
            if($_POST){
                switch ($_POST['type']){
                    case 'delete_menu_items':
                        if($this->mdl_menu->delete_menu_item($_POST['menu_item_id'])){
                            echo 'true';
                        }else{
                            echo 'false';
                        }
                    break;
                    case 'published':
                        if($this->mdl_menu->published($_POST['menu_item_id'], $_POST['published'])){
                            echo 'true';
                        }else{
                            echo 'false';
                        }
                    break;
                    case 'change_order_items':
                        $data_for_return = $this->mdl_menu->change_order_items($_POST['data']);
                        if(is_array($data_for_return)){
                            echo json_encode($data_for_return);
                        }else{
                            echo 'false';
                        }
                    break;    
                }
                
            }else{
                $content['menu_items'] = $this->mdl_menu->get_menu_items($menu);
                $content['page_information'] = $this->mdl_menu->get_menu_information($menu);
                $this->load->view('header');
                $this->load->view('menu/show_menu_items', $content);
                $this->load->view('footer');   
            }
        }
         /**
         *Описание функции: Страница создания пункта меню.
         */
        public function create_menu_item($menu_item_id = ''){
            
            
        $this->load->model('mdl_menu');
        
            if($_POST){
                if($this->mdl_menu->creat_menu_item($_POST)){
                    redirect('/menu/show_menu_items/'.$menu_item_id.'/');
                }
            }else{
                $content['menu_id'] = $menu_item_id;
                $content['level'] = $this->mdl_menu->get_appropriate_menu_level($menu_item_id);
                $content['parents'] = $this->mdl_menu->get_parent_menu_item($menu_item_id);
                $this->load->view('header');
                $this->load->view('menu/create_menu_item',$content);
                $this->load->view('footer');
            }
            
        }
         /**
         *Описание функции: Страница изменения пункта меню.
         */
        public function edit_menu_item($menu_id = '', $menu_item_id = ''){
            
            
        $this->load->model('mdl_menu');
        
            if($_POST){
                switch ($_POST['type']){
                    case 'save_menu_item':
                        if($this->mdl_menu->save_menu_item($_POST, $menu_item_id)){
                            redirect('/menu/show_menu_items/'.$menu_id.'/');
                        }
                    break; 
                }
            }else{                
                $content['data'] = $this->mdl_menu->get_menu_item($menu_item_id);
                $content['modules'] = $this->mdl_menu->get_order_items($menu_item_id);
                $content['parents'] = $this->mdl_menu->get_parent_menu_item($menu_id);
                $this->load->view('header');
                $this->load->view('menu/edit_menu_item',$content);
                $this->load->view('footer');
            }
            
        }
        
}
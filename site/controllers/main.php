<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index(){ //главный контроллер
            
            $uri_segment1 = ($this->uri->segment(1)) ? $this->uri->segment(1) : 'main';				
            
            if($_POST){
                $this->_ajax_controller($_POST);
            }
            
            $this->load->model('mdl_loader');
               
                    
            $modules_per_page = $this->mdl_loader->get_modules_per_page($uri_segment1); //получение модулей для страницы

            foreach($this->mdl_loader->get_positions() as $position){ // создаем позиции, что бы не было ошибки в темплейте с пустой переменной
                $data[$position] = '';
            }

            foreach($modules_per_page as $module){

                $module_number = 'module'.$module['module_number']; // какой модуль будем выводить
                $this->load->library($module['module_type'].'/'.$module['module_type']);
                $data[$module['position_name']] .= $this->$module['module_type']->$module_number($module,$uri_segment1,$this->uri->ruri_to_assoc());//подгружаем библиотеки (модули)
                $data['header'] .= $this->$module['module_type']->load_files();

            }


            $is_module = $this->mdl_loader->is_module($uri_segment1); 
            if($is_module){//если это страница с компонентом

                 $module_type = $this->mdl_loader->get_module_name($is_module[0]['module_page_id']);

                 $this->load->library($module_type[0]['module_type']);
                 $data['content'] .= $this->$module_type[0]['module_type']->core1($uri_segment1,$this->uri->ruri_to_assoc(4));
                 $data['header'] .= $this->$module_type[0]['module_type']->load_files();

            }


            $this->load->view('template',$data); //загружаем все в шаблон
            
	}
        
        
        function _ajax_controller($post){
            
            $this->load->library($post['type'].'/'.$post['type']);
            echo json_encode($this->$post['type']->ajax($post['search_text']));
            exit;
            
        }
}

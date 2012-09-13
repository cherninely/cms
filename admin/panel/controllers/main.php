<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *Описание файла: Основной контроле
 *
 * 
 * @Изменён 12.03.2012
 */
class Main extends CI_Controller {

	public function index(){    
                        
//            $left_menu['data'] = $this->mdl_common->get_menu();
            $this->load->view('header');
            $this->load->view('left_menu');
            $this->load->view('content');
            $this->load->view('footer');
            
	}
        
}
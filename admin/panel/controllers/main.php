<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *Описание файла: Основной контроле
 *
 * 
 * @Изменён 12.03.2012
 */
class Main extends CI_Controller {

	public function index(){    
                        
            if(!isset($_SESSION['access']) || $_SESSION['access'] == false){
                
                if( $_POST && isset ($_POST['login'])  && isset ($_POST['password'])){
                    $this->load->model('mdl_common');
                    $result = $this->mdl_common->login($_POST);
                    if(!empty ($result)){
                        $_SESSION['access'] = true;
                        header( "Location: ".str_replace("index.php","",$_SERVER['PHP_SELF']) );
                    }
                }
                
                $this->load->view('login');
                
            }else{
                
                $this->load->view('header');
                $this->load->view('content');
                $this->load->view('footer');
                
            }
            
            
	}
        
}
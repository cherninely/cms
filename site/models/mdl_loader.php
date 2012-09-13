<?php

/**
 *Описание файла: Модель для работы с Меню.
 *
 * 
 * @Изменён 
 */
 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mdl_loader extends CI_Model {

    function get_positions(){
        
        $this->db->select("position_name");
        $this->db->from("positions");
        $query = $this->db->get();
        $results = $query->result_array();
        foreach ($results as $item){
            $data[] = $item['position_name'];
        }
        return $data;
        
    } 
    
    function get_modules_per_page($page){
                
        $this->db->select("order, module_type, position_name, module_id, module_number");
        $this->db->from("connections");
        $this->db->where("menu_item_id","all");
        $this->db->or_where("menu_items.title",$page);
        $this->db->join('positions',"connections.position_id = positions.id");
        $this->db->join('modules',"connections.modules_type_id = modules.id");
        $this->db->join('menu_items',"connections.menu_item_id = menu_items.id",'left');
        $query = $this->db->get();
        $results = $query->result_array();
        
        return $results;
        
    }
/** 
 * Компонент ли эта страница или нет 
 */
    function is_module($page){
        
        $query = $this->db->select('module_page_id')->where('title',$page)->where('module_page_id !=',0)->get('menu_items');
        $result = $query->result_array();
        return (empty ($result)) ? false : $result;
    }
    
    
    function get_module_name($id){        
        
        $query = $this->db->select('module_type')->where('id',$id)->get('modules');
        return $query->result_array();
        
    }
    

}


?>
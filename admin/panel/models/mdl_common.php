<?php

/**
 *Описание файла: Модель для работы с Меню.
 *
 * 
 * @Изменён 
 */
 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mdl_common extends CI_Model {

    /**
     *Описание функции: Получение русской даты
     */
    function russian_date(){
        $date=explode(".", date("d.m.Y"));
        switch ($date[1]){
        case 1: $m='января'; break;
        case 2: $m='февраля'; break;
        case 3: $m='марта'; break;
        case 4: $m='апреля'; break;
        case 5: $m='мая'; break;
        case 6: $m='июня'; break;
        case 7: $m='июля'; break;
        case 8: $m='августа'; break;
        case 9: $m='сентября'; break;
        case 10: $m='октября'; break;
        case 11: $m='ноября'; break;
        case 12: $m='декабря'; break;
        }
        return $date[0].' '.$m.' '.$date[2];
    }
    
     /**
     *Описание функции: вход в админку
     */
    function login($post){
        
        $this->db->select('*');
        $this->db->where('login',$post['login']);
        $this->db->where('password',$post['password']);
        $query = $this->db->get('users');
        return $query->result_array();
        
    }
    
    
     /**
     *Описание функции: получение всех страниц сайта
     */
    function get_all_pages(){
        
        $this->db->select('menus.menu_name, menus.id menu_id, menu_items.ru_title, menu_items.id, menu_items.parentid');
        $this->db->join('menus','menu_items.menu_id = menus.id');
        $query = $this->db->get('menu_items');
        $menu_items_not_sorted = $query->result_array();
        foreach ($menu_items_not_sorted as $menu_item){
            $menu_items[$menu_item['menu_name']][] = $menu_item;
        }
        return $menu_items;
        
    }
     /**
     *Описание функции: получение блока выбора пунтов меню для вывода
     */
    function get_menu_items_in_block($module_id = ''){
        
        $all_pages = $this->get_all_pages();   
        if(!empty ($module_id)){
            $active_pages = $this->get_active_pages($module_id);//на каких страницах выводится  модуль
        }
        $html = "<div id='positions'><ul class='nav nav-tabs'>";
        $i = 0;
        foreach ($all_pages as $key => $menu) {
            $active = (!$i)?"class='active'":"";
            $html .= "<li {$active}><a href='#item{$all_pages[$key][0]['menu_id']}' data-toggle='tab'>{$key}</a></li>";
            $i++;
        }
        $html .= "</ul>";
        
        $html .= "<div class='tab-content'>";
        $i = 0;
        foreach ($all_pages as $key => $menu) {  
            $active = (!$i)?" active":"";
            $html .= "<div class='tab-pane{$active}' id='item{$all_pages[$key][0]['menu_id']}'>";
            foreach ($menu as $item){          
                $active_item =(isset ($active_pages) && !empty ($active_pages)) ? (in_array($item['id'], $active_pages))? 'checked' :''  : '';         
                $html .= "<div><label><input type='checkbox' name='pages[]' {$active_item}  value='{$item['id']}' />&nbsp;- {$item['ru_title']}</label></div>";
            }
            $html .= "</div>";
            $i++;
        }
        $html .= '</div>';
        $html .= '</div>';
        
        return $html;
        
    }    
     /**
     *Описание функции: получение активных пунтов меню модуля
     */
    function get_active_pages($module_id){
        
        $query = $this->db->select('menu_item_id')->where('module_id',$module_id)->get('connections');
        $data = $query->result_array();
        if(!empty ($data)){
            return json_decode(array_shift(array_values(array_shift(array_values($data)))));            
        }else{
            return '';
        }
        
        
    }
    
        /**
     *Описание функции: Получение позиций вывода в шаблоне
     */
    function get_positions(){
        
        $this->db->select("*");
        $this->db->from("positions");
        $query = $this->db->get();
        return $query->result_array();
    }
    
}


?>
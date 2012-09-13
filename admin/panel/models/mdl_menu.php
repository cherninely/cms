<?php

/**
 *Описание файла: Модель для работы с Меню.
 *
 * 
 * @Изменён 13.10.2010
 */
 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mdl_menu extends CI_Model {
    /**
     *Описание функции: Получение всех пунктов меню.
     */
    function get_menu_items($menu){
        
        $what_to_search = '
            menu_items.id menu_item_id,
            menu_items.ru_title title,
            menu_items.published published,
            menu_items.level level,
            menu_items.main main,
            menu_items.parentid parentid, 
            menus.menu_name menu_name,
            menus.id menu_id'; 
        
        $this->db->select($what_to_search);
        $this->db->from('menu_items');
        $this->db->order_by('menu_items.level','asc');
        $this->db->join('menus','menu_items.menu_id = menus.id','right');
        $this->db->where('menu_items.menu_id',$menu);
        $this->db->where('menu_items.parentid',0);
        $query = $this->db->get();
        $menu_items = $query->result_array();
        
        foreach($menu_items as $key => $menu_item){
            $this->db->select($what_to_search);
            $this->db->from('menu_items');
            $this->db->order_by('menu_items.level','asc');
            $this->db->join('menus','menu_items.menu_id = menus.id','right');
            $this->db->where('menu_items.menu_id',$menu);
            $this->db->where('menu_items.parentid',$menu_item['menu_item_id']);
            $query = $this->db->get();
            $sub_menu_items = $query->result_array();
            if(!empty ($sub_menu_items)){
                $menu_items[$key]['sub_menu_items'] = $sub_menu_items;
            }
        }
        return $menu_items;
        
    }
    /**
     *Описание функции: Получение информации о меню.
     */
    function get_menu_information($menu){
        
        $this->db->select('menus.menu_name, menus.id');
        $this->db->from('menus');
        $this->db->where('menus.id',$menu);
        $query = $this->db->get();
        return $query->result_array();   
    }
    /**
     *Описание функции: Получение максимального порядка меню
     */
    function get_appropriate_menu_level($menu_id){
        
        $this->db->select_max('level');
        $this->db->from('menu_items');
        $this->db->where('menu_id',$menu_id);
        $query = $this->db->get();
        $pre_result = $query->result_array();
        $result = $pre_result[0]['level'] + 1;
        return $result;
        
    }
    /**
     *Описание функции: Получение списка всех меню для выбора родителя
     */
    function get_parent_menu_item($menu_id){
        
        $query = $this->db->select('id, ru_title')->where('parentid',0)->where('menu_id',$menu_id)->from('menu_items')->get();
        return $query->result_array(); 
        
    }
    /**
     *Описание функции: Создание пункта меню
     */
    function creat_menu_item($data_to_insert){
        
        return $this->db->insert('menu_items',$data_to_insert);
        
    }
    /**
     *Описание функции: Удаление пункта меню
     */
    function delete_menu_item($menu_item_id){
        $this->db->select('menu_items.main');
        $this->db->where('menu_items.id',$menu_item_id);
        $this->db->where('menu_items.main',1);
        $query = $this->db->get('menu_items');
        
        if(count($query->result_array()) == 0){
            
            return $this->db->delete('menu_items', array('id' => $menu_item_id));
            
        }else{
            
            return false;
            
        }
                
    }
    /**
     *Описание функции: Получение меню для редактирования
     */
    function get_menu($menu_id){
        
        $query = $this->db->select('menus.menu_name')->from('menus')->where('menus.id',$menu_id)->get();
        return $query->result_array();
        
    }    
    /**
     *Описание функции: Сохранение меню после редактирования
     */
    function save_menu_after_edit($data, $menu_id){
        $this->db->where('id', $menu_id);
        return $this->db->update('menus', $data);      
    }
    /**
     *Описание функции: Удаление меню
     */
    function delete_menu($menu_id){
                    
        $this->db->select('menu_items.main');
        $this->db->where('menu_items.menu_id',$menu_id);
        $this->db->where('menu_items.main',1);
        $query = $this->db->get('menu_items');
        
        if(count($query->result_array()) == 0){
            
            $this->db->where('menu_id', $menu_id);
            $deleted = $this->db->delete('menu_items');
            if($deleted){//Если были удалены все пункты меню то удаляем и само меню
                
                return $this->db->delete('menus', array('id' => $menu_id));
                
            }else{
                return false;
            }
            
        }else{
            return false;
        }
//        return $this->db->delete('menus', array('id' => $menu_id));
                
    }
    /**
     *Описание функции: Опубликование пункта меню
     */
    function published($menu_item_id, $published){
        
        $this->db->where('id', $menu_item_id);
        return $this->db->update('menu_items', array('published' => $published)); 
        
    }    /**
     *Описание функции: Опубликование меню
     */
    function published_menu($menu_id, $published){
        
        $this->db->where('id', $menu_id);
        return $this->db->update('menus', array('published' => $published)); 
        
    }
    /**
     *Описание функции: Изменение порядка пунктов меню
     */
    function change_order_items($data){
        
        foreach($data as $key => $item){
            $level = $key + 1;
            $item_id = explode("_", $item);            
            $this->db->where('id', $item_id[1]);
            $this->db->update('menu_items', array('level' => $level));
            $data_for_return[$level] = $item_id[1];
        }  
        return $data_for_return;
        
    }
    /**
     *Описание функции: Получение пункта меню
     */
    function get_menu_item($menu_item_id){
        
        $this->db->select('*');
        $this->db->where('id',$menu_item_id);
        $this->db->from('menu_items');
        $query = $this->db->get();
        return $query->result_array();
        
    }
    /**
     *Описание функции: Сохранение пункта меню
     */
    function save_menu_item($data, $menu_item_id){
        unset($data['type']);
        $this->db->where('id', $menu_item_id);
        return $this->db->update('menu_items', $data); 
        
    }
    /**
     *Описание функции: Создание меню
     */
    function create_menu($data_to_insert){
        
        if($this->db->insert('menus',$data_to_insert)){
            $inserted_menu_id = $this->db->insert_id();
//            return $this->db->insert('modules',$data_to_insert);
            return $inserted_menu_id;
        }else{
            return false;
        }
        
    }
    /**
     *Описание функции: Вывод модулей на странице
     */
    function get_modules_on_page($menu_item_id){
        //DO_ELI: возможно стоит удалить
        //получение списка всех модулей
        $this->db->select('*');
        $this->db->from('modules');
        $query = $this->db->get();
        $modules = $query->result_array();
        
        foreach($modules as $module){
            if($module['module_name'] == 'article'){//если статья
                $this->db->select('modules');
                $this->db->from('menu_items');
                $this->db->where('id',$menu_item_id);
                $query = $this->db->get();
                $data_from_menu_items = $query->result_array();
                $if_set_articles = json_decode($data_from_menu_items[0]['modules']);
                if(is_array($if_set_articles)){//если это массив
                    if(in_array($module['module_name'], $if_set_articles)){//если к пункту меню закреплена хоть одна статья
                        $table_name = $module['module_name'].'s';
                        $this->db->select("{$table_name}.order , {$table_name}.id, {$table_name}.order, {$table_name}.position_id, positions.position_name");
                        $this->db->from("{$table_name}");
                        $this->db->join('positions',"positions.id = {$table_name}.position_id");
                        $this->db->order_by("{$table_name}.order",'asc');
                        $this->db->where("{$table_name}.menu_item_id",$menu_item_id);
                        $query = $this->db->get();
                        $articles = $query->result_array();
                        foreach($articles as $key => $article){
                            $result_articles[$key][$module['module_name']] = $article;
                        }
                        $all_modules_on_page =  $result_articles;
                    }else{
                        continue;
                    }
                }else {
                    continue;
                }                
            }else{
//                $this->db->select("{$table_name}.order, ");
            }
        }//end foreach
        
        return $modules;
        
    }
        /**
     *Описание функции: Получение блока сортировки
     */
    function get_order_items($menu_item_id){
        $this->db->select('module_type, connections.order, connections.id');
        $this->db->from('connections');
        $this->db->join('modules',"modules.id = connections.module_id");
        $this->db->where('connections.menu_item_id',$menu_item_id);
        $query = $this->db->get();
        return $query->result_array();
    }
     /**
     *Описание функции: Получение блока сортировки
     */
    function get_menus(){
        
        $this->db->select('*');
        $this->db->from('menus');
        $query = $this->db->get();
        return $query->result_array();
        
    }
    
}

?>
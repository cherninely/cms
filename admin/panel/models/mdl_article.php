<?php

/**
 *Описание файла: Модель для работы с Меню.
 *
 * 
 * @Изменён 13.10.2010
 */
 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mdl_article extends CI_Model {
    /**
     *Описание функции: Получение всех статей.
     */ 
    function get_articles(){
        
        $this->db->select("id, article_name, published");
        $this->db->from("articles");
        $query = $this->db->get();
        return $query->result_array();
        
    }
    /**
     *Описание функции: Удаление статьи
     */
    function delete_article($article_id){
        
        if($this->db->delete('articles', array('id' => $article_id))){
            $this->db->select('id');
            $this->db->from('modules');
            $this->db->where('module_type','article');
            $query = $this->db->get();
            $module_type_id = $query->result_array();
            return $this->db->delete('connections', array('module_id' => $article_id, 'modules_type_id' => $module_type_id[0]['id']));
        }
                
    }
    /**
     *Описание функции: Опубликование статьи
     */
    function published($article_id, $published){
        
        $this->db->where('id', $article_id);
        return $this->db->update('articles', array('published' => $published)); 
        
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
    /**
     *Описание функции: Получение всех пунктов меню.
     */
    function get_menu_items(){
        
        $this->db->select('
            menus.menu_name,
            menu_items.id menu_id,
            ru_title
            ');
        $this->db->from('menus');
        $this->db->join('menu_items','menus.id = menu_items.menu_id');
        $query = $this->db->get();
        $all_items = $query->result_array();
        foreach($all_items as $key => $item){
            $data[$item['menu_name']][$key]['menu_id'] = $item['menu_id'];
            $data[$item['menu_name']][$key]['ru_title'] = $item['ru_title'];
        }
        return $data;
        
    }    
    /**
     *Описание функции: Создание новой статьи
     */
    function create_article($data_to_insert){    
        if($this->db->insert('articles',$data_to_insert['article'])){
            $data_to_insert['connection']['module_id'] = $this->db->insert_id();
            if($this->db->insert('connections',$data_to_insert['connection'])){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }    
    /**
     *Описание функции: Получение статьи
     */
    function get_article($article_id){
        
        $this->db->select("articles.*, positions.position_name, connections.*, menu_items.title");
        $this->db->from('articles');
        $this->db->join('connections','connections.module_id = articles.id','left');
        $this->db->join('positions','positions.id = connections.position_id','left');
        $this->db->join('menu_items','menu_items.id = connections.menu_item_id','left');
        $this->db->where('articles.id',$article_id);
        $query = $this->db->get();
        return $query->result_array();
        
    }   
    /**
     *Описание функции: Создание новой статьи
     */
    function edit_article($data_to_update,$article_id){
//        return $data_to_update;
        $this->db->where('id',$article_id);      
        if($this->db->update('articles',$data_to_update['article'])){
            $data_to_update['connection']['module_id'] = $article_id;
            $this->db->where('modules_type_id',$data_to_update['connection']['modules_type_id']);  
            $this->db->where('module_id',$article_id);
            if($this->db->update('connections',$data_to_update['connection'])){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }   
    /**
     *Описание функции: Пометка пункта меню о том, что на к нему закреплена как минимум 1 статья ["menu"]
     */ 
    //TODO: Возможно стоит убрать
    function set_article_to_menu_item($menu_item_id){
        $this->db->select('modules');
        $this->db->from('menu_items');
        $this->db->where('id',$menu_item_id);
        $query = $this->db->get();
        $result = $query->result_array();
        if($result[0]['modules'] == ''){
            $this->db->where('id',$menu_item_id);
            return $this->db->update('menu_items',  array('modules' => json_encode(array('article'))));            
        }else{
            $decoded = json_decode($result[0]['modules']);
            if(!in_array('article', $decoded)){
                $decoded[] = 'article';
                $this->db->where('id',$menu_item_id);
                return $this->db->update('menu_items',  array('modules' => json_encode($decoded))); 
            }else{
                return true;
            }   
        }
    }
}   

?>
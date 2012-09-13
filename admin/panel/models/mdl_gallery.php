<?php

/**
 *Описание файла: Модель для работы с галлереей.
 *
 * 
 * @Изменён 13.10.2010
 */
 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mdl_gallery extends CI_Model {
    
    /**
     *Получаем все категории галлереи
     */
    function get_categories(){
        
        $this->db->select("*");
        $this->db->from("gallery_cats");
        $query = $this->db->get();
        return $query->result_array();
        
    }
    /**
     *Описание функции: Опубликование категории галлереи
     */
    function published_cat($cat_item_id, $published){
        
        $this->db->where('id', $cat_item_id);
        return $this->db->update('gallery_cats', array('published' => $published)); 
        
    }
     /**
     *Описание функции: Удаление категории галлереи
     */
    function delete_cat($cat_item_id){
        
       return $this->db->delete('gallery_cats', array('id' => $cat_item_id));
                
    }
    /**
     *Описание функции: Создание категории
     */
    function create_cat($data_to_insert){
        
        if($this->db->insert('gallery_cats',$data_to_insert)){
            $inserted_cat_id = $this->db->insert_id();
//            return $this->db->insert('modules',$data_to_insert);
            return $inserted_cat_id;
        }else{
            return false;
        }
        
    }
    /**
     *Описание функции: Получение категории для редактирования
    */
    function get_cat($id){
        
        $query = $this->db->select('name, published')->from('gallery_cats')->where('id',$id)->get();
        return $query->result_array();
        
    }   
    /**
     *Описание функции: Сохранение меню после редактирования
     */
    function save_cat_after_edit($data, $id){
        $this->db->where('id', $id);
        return $this->db->update('gallery_cats', $data);      
    }   
    /**
     *Описание функции: Получение название категории
     */
    function get_cat_name($cat_id){
        
        $query = $this->db->select('name')->from('gallery_cats')->where('id',$cat_id)->get();
        return $query->result_array();
        
    } 
    
    
}

?>
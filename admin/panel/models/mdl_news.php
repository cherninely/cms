<?php

/**
 *Описание файла: Модель для работы с Меню.
 *
 * 
 * @Изменён 13.10.2010
 */
 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mdl_news extends CI_Model {
    
    /**
     *Описание функции: Получение всех статей.
     */ 
    function get_news($cat_id){
        
        $this->db->select("id, name, published, create_date");
        $this->db->where('cat_id',$cat_id);
        $this->db->from("news");
        $query = $this->db->get();
        return $query->result_array();
        
    }
    /**
     *Описание функции: Удаление новости
     */
    function delete($news_item_id){
        
       return $this->db->delete('news', array('id' => $news_item_id));
                
    }
    /**
     *Описание функции: Опубликование новости
     */
    function published($news_item_id, $published){
        
        $this->db->where('id', $news_item_id);
        return $this->db->update('news', array('published' => $published)); 
        
    }   
    /**
     *Описание функции: Создание новой новости
     */
    function  create($data_to_insert){  
        
        if(!isset($data_to_insert['news']['published'])){
            $data_to_insert['news']['published'] = 0;
        }elseif($data_to_insert['news']['published'] == 'on'){
            $data_to_insert['news']['published'] = 1;
        }
        
        if($this->db->insert('news ',$data_to_insert['news'])){
            return $this->db->insert_id();
        }else{
            return false;
        }
        
    }    
    /**
     *Описание функции: Получение новости
     */
    function get_news_item($news_item_id){
        
        $this->db->select("*");
        $this->db->from('news');
        $this->db->where('news.id',$news_item_id);
        $query = $this->db->get();
        return $query->result_array();
        
    }   
    /**
     *Описание функции: Создание новой новости
     */
    function edit($data_to_update,$news_id){
        
        if(!isset($data_to_update['news']['published'])){
            $data_to_update['news']['published'] = 0;
        }elseif($data_to_update['news']['published'] == 'on'){
            $data_to_update['news']['published'] = 1;
        }
        
        $this->db->where('id',$news_id);      
        if($this->db->update('news',$data_to_update['news'])){
            return true;
        }else{
            return false;
        }
    }   
    /**
     *Описание функции: Удаление картинки из новостей
     */
    function deleteImgFromNews($img_name, $id){
        
        if( unlink($_SERVER['DOCUMENT_ROOT'].'/i/uploaded/'.$img_name) ){                        
            
            if( $this->db->where('id', $id)->update('news',array('preview_img' => '')) ){
                return 'true';  
            }                              
        
        }
    }  
    /**
     *Описание функции: Добавление картинки из новостей
     */
    function addImgFromNews($img_name, $id){
        
        if( $this->db->where('id', $id)->update('news',array('preview_img' => $img_name)) ){
            return 'true';  
        }else{
            return 'false';
        }
    }
    /**
     *Описание функции: Получение списка категорий новостей
     */
    function get_news_cats(){
        
        $this->db->select("*");
        $this->db->from('news_cats');
        $query = $this->db->get();
        return $query->result_array();
        
    }
    /**
     *Описание функции: Опубликование категории
     */
    function published_cat($news_cat_id, $published){
        
        $this->db->where('id', $news_cat_id);
        return $this->db->update('news_cats', array('published' => $published)); 
        
    }
    /**
     *Описание функции: Удаление категории
     */
    function delete_cat($news_cat_id){
        
       return $this->db->delete('news_cats', array('id' => $news_cat_id));
                
    }   
    /**
     *Описание функции: Создание категории
     */
    function create_cat($data_to_insert){  
                
        if(!isset($data_to_insert['published'])){
            $data_to_insert['published'] = 0;
        }elseif($data_to_insert['published'] == 'on'){
            $data_to_insert['published'] = 1;
        }
        
        if($this->db->insert('news_cats',$data_to_insert)){
            return true;
        }else{
            return false;
        }
        
    }   
    /**
     *Описание функции: Получение категории
     */
    function get_cat($id){
        
        $this->db->select("*");
        $this->db->from('news_cats');
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->result_array();
        
    }   
    /**
     *Описание функции: Изменение категории
     */
    function edit_cat($data_to_update,$id){
        
        if(!isset($data_to_update['published'])){
            $data_to_update['published'] = 0;
        }elseif($data_to_update['published'] == 'on'){
            $data_to_update['published'] = 1;
        }
        
        $this->db->where('id',$id);      
        if($this->db->update('news_cats',$data_to_update)){
            return true;
        }else{
            return false;
        }
    }   
    /**
     *Описание функции: Получение категорий
     */
    function get_cats(){
        
        $this->db->select("*");
        $this->db->from('news_cats');
        $query = $this->db->get();
        return $query->result_array();
        
    }
    
    
    
    
}   

?>
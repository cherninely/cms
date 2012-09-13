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
    function get_news(){
        
        $this->db->select("id, name, published, create_date");
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
        
        if($this->db->insert('news ',$data_to_insert['news'])){
            return true;
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
//        return $data_to_update;
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
    
    
    
    
}   

?>
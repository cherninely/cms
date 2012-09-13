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
     *Описание функции: Получение списка всех меню
     */
    function get_menu(){
        
        $this->db->select('*');
        $this->db->from('menus');
        $query = $this->db->get();
        return $query->result_array();
    }
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

}


?>
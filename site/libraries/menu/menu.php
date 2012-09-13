<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Menu {
    
    function load_files(){
        
        $files=<<<files
   
   
        
files;
        
        return $files;
        
    }

    function module1($module,$page){
        
        $CI =& get_instance();
        $CI->db->select("*");
        $CI->db->from("menu_items");
        $CI->db->where('menu_items.menu_id',$module['module_id']);
        $CI->db->where('menu_items.published','1');
        $CI->db->where('menu_items.parentid',0);
        $CI->db->order_by('level');
        $query = $CI->db->get();
        $parent_menu_item = $query->result_array();
        
        foreach($parent_menu_item as $key => $menu_item){
            $CI->db->select("*");
            $CI->db->from("menu_items");
            $CI->db->where('menu_items.menu_id',$module['module_id']);
            $CI->db->where('menu_items.published','1');
            $CI->db->where('menu_items.parentid',$menu_item['id']);
            $CI->db->order_by('level');
            $query = $CI->db->get();
            $sub_menu_items = $query->result_array();
            if(!empty ($sub_menu_items)){
                $parent_menu_item[$key]['sub_menu_items'] = $sub_menu_items;
            }
        }
        return $this->template($parent_menu_item,$page);
        
    }
    
    function template($data,$page){
        
        $tmpl = "<ul id=\"mdl_menu_{$data[0]['menu_id']}\">";
        foreach($data as $item){
            $active = ($item['title'] == $page) ? 'id="mdl_active"' : '';
            $dropdown = (isset ($item['sub_menu_items'])) ? 'drop' : 'none';
            if(isset ($item['sub_menu_items'])){                
                $tmpl .= "<li {$active} class=\"mdl_{$dropdown}\"><a alt=\"{$item['ru_title']}\" href=\"javascript:void(0)\">{$item['ru_title']}</a>";//если сабменю то неактивно
                $tmpl .= "<ul class=\"mdl_submenu_{$data[0]['menu_id']}\">";
                foreach($item['sub_menu_items'] as $sub_menu_item){
                    $active = ($sub_menu_item['title'] == $page) ? 'id="mdl_active"' : '';
                    $tmpl .= "<li {$active}><a alt=\"{$sub_menu_item['ru_title']}\" href=\"/{$sub_menu_item['title']}/\">{$sub_menu_item['ru_title']}</a>";
                }
                $tmpl .= '</ul>';
            }else{
                $tmpl .= "<li {$active} class=\"mdl_{$dropdown}\"><a alt=\"{$item['ru_title']}\" href=\"/{$item['title']}/\">{$item['ru_title']}</a>";
            }            
            $tmpl .= "</li>";
        }
        $tmpl .= '</ul>';
        
        return $tmpl;
    }
}

?>
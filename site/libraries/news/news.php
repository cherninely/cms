<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class News {

    var $items_per_page = 2;
    
    function load_files(){
        
        $files=<<<files
   
        
files;
        
        return $files;
        
    }
    
    function core1($page,$news_page){
                
        $CI =& get_instance();
        
        if(!is_numeric(key($news_page))){
            
            if(!isset($news_page['page']) || empty ($news_page['page'])) $news_page['page'] = 1;
            $CI->db->select("*");
            $CI->db->from("news");
            $CI->db->where('news.published','1');
            $query = $CI->db->get();
            return @$this->template1($query->result_array(),$news_page,$page);
            
        }else{
            
            $CI->db->select("name, create_date, full_text");
            $CI->db->from("news");
            $CI->db->where('news.published','1');
            $CI->db->where('news.id',key($news_page));
            $query = $CI->db->get();
            return @$this->template2($query->result_array(), $page);        
            
        }
        
    }
    
    
    function template1($data,$news_page,$page){       
        
        $last_item = $this->items_per_page * $news_page['page'];
        $first_item = $last_item - $this->items_per_page;
        $all_pages = ceil(count($data)/$this->items_per_page);
        $data_prepared = array_slice($data, $first_item, $last_item);
        $tmpl = '<div id="mdl_news_container">';
            $tmpl .= "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">";
                         $tmpl .= "<tr><td class=\"mdl_headline\" colspan=\"10\"><div>Новости</div></td></tr>";
            foreach ($data_prepared as $value){
                $tmpl .= "<tr class=\"mdl_news_item\" id=\"news_item_{$value['id']}\">";
                    $tmpl .= "<td class=\"mdl_preview_img\"><a href=\"/news/{$value['id']}/\"><img src=\"/i/uploaded/{$value['preview_img']}\" /></a></td>";
                    $tmpl .= "<td width=\"10px;\"></td>";
                    $tmpl .= "<td valign=\"top\"  class=\"mdl_news_info\">";
                        $tmpl .= "<div class=\"mdl_fisrt_line\">";
                            $tmpl .= "<div class=\"mdl_headline\"><a href=\"/news/{$value['id']}/\">{$value['name']}</a></div>";
                            $tmpl .= "<div class=\"mdl_date\">{$value['create_date']}</div>";                    
                        $tmpl .= "</div>";
                        $tmpl .= "<div class=\"mdl_preview_text\">{$value['preview_text']}</div>";
                    $tmpl .= "</td>";
                $tmpl .= "</tr>";
                $tmpl .= '<tr class="mdl_spacer"><td colspan="10"></td></tr>';
            }
            $tmpl .= "</table>";      
            $tmpl .= '<table id="mdl_pagination"><tr>';
            $before = $news_page['page'] - 1;
            $tmpl .= ($before == 0) ? "<td id=\"mdl_before\">← Назад</td>" : "<td id=\"mdl_before\">← <a href=\"/$page/page/{$before}/\">Назад</a></td>";
            for($i = 1; $i<= $all_pages; $i++){
                $tmpl .= ($news_page['page'] == $i) ? "<td class=\"mdl_pag\">{$i}</td>" : "<td class=\"mdl_pag\"><a href=\"/$page/page/{$i}/\">{$i}</a></td>";
            }            
            $after = $news_page['page'] + 1;
            $tmpl .= ($after > $all_pages) ? "<td id=\"mdl_after\">Вперед →</td>" : "<td id=\"mdl_after\"><a href=\"/$page/page/{$after}/\">Вперед</a> →</td>";
            $tmpl .= '</tr></table>';
        $tmpl .= '</div>';
        return $tmpl;
        
    }
    
    
    function template2($data, $page){
        
        $tmpl = '<div id="mdl_news_container_full">';
            $tmpl .= '<div id="mdl_line">';
                $tmpl .= "<div id=\"mdl_headline\">{$data[0]['name']}</div>";
                $tmpl .= "<div id=\"mdl_date\">{$data[0]['create_date']}</div>";
            $tmpl .= '</div>';
                $tmpl .= "<div id=\"mdl_text\">{$data[0]['full_text']}</div>";
        $tmpl .= '</div>';
//        echo '<pre>';
//        print_r($data);
        
        return $tmpl;
        
    }
}

?>
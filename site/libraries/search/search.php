<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Search {
    
    var $default_text_search = 'Поиск...';
    
    function load_files(){
        
        $files=<<<files
   
   
        
files;
        
        return $files;
        
    }

    function module1($page){
        
        return @$this->template($page);
        
    }
    
    
    function template($page){
        
        $js = file_get_contents(dirname(__FILE__).'/search.js');
        
        $tmpl =<<<TMP
        <script type="text/javascript">
        {$js}
        </script>
        <input id="mdl_search" name="search"  maxlength="30" alt="{$this->default_text_search}" type="text" size="30" value="{$this->default_text_search}" onblur="if(this.value=='') this.value='{$this->default_text_search}';" onfocus="if(this.value=='{$this->default_text_search}') this.value='';">
        <div id="mdl_dropdown_search"></div>
TMP;

        return $tmpl;
    }
    
    function ajax($request){
        
        $CI =& get_instance();
        $query = $CI->db->select('module_type')->get('modules');
        $modules = $query->result_array();
        
        foreach($modules as $module){
             switch ($module['module_type']){
                 case 'article':
                      $res = $this->search_in_article($request);
                      if($res != false) $data[] = $res;  
                 break;
//                 case 'news':
//                      $data[$module['module_type']] = $this->search_in_news($request);
//                 break;
                 default: continue;break;
             }
        }
        if(isset ($data)){            
//            echo '<pre>';
//            print_r($data);
            return $data;
        }else{
            return false;
        }
        
    }
    
    function search_in_article($request){
        
        $CI =& get_instance();
        $query = $CI->db->select('id, article_name')->like('article_name',$request)->or_like('text',$request)->get('articles');
        $articles = $query->result_array();
        
        if(!empty ($articles)){
            $tmpl = '<div class="mdl_search_headline"><span>Страницы сайта</span></div>';
            foreach($articles as $article){
                $CI->db->select('ru_title, title');
                $CI->db->where('module_id',$article['id']);
                $CI->db->join('menu_items','menu_items.id = connections.menu_item_id','left');
                $query = $CI->db->get('connections');
                $temp = $query->result_array();

                $tmpl .= "<div class=\"mdl_search_results\"><span><a href=\"/{$temp[0]['title']}/\">{$temp[0]['ru_title']}</a></span></div>";
            }
            return $tmpl;
        }else{
            return false;
        }
        
        
    }
    
    function search_in_news($request){
        
        return 'news';
        
    }
}

?>
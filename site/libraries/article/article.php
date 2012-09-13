<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Article {
    
    function load_files(){
        
        $files=<<<files
   
   
        
files;
        
        return $files;
        
    }

    function module1($data, $page){
        
        $CI =& get_instance();
        
        $CI->db->select("*");
        $CI->db->from("articles");
        $CI->db->where('articles.id',$data['module_id']);
        $CI->db->where('articles.published','1');
        $query = $CI->db->get();
        return @$this->template($query->result_array());
        
    }
    
    
    function template($data){
        
        $show_headline = ($data[0]['show_headline']) ? "<div class=\"mdl_headline\">{$data[0]['article_name']}</div>" : " ";
        $tmpl=<<<TMP
        <div class="mdl_article" id="mdl_article_{$data[0]['id']}">
            $show_headline
            <div class="mdl_text">{$data[0]['text']}</div>
        </div>
TMP;

        return $tmpl;
    }
}

?>
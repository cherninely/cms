<?php if (!defined('BASEPATH')) exit('Нет доступа к скрипту'); 

class Gallery {

    protected $options = array(
        'files_dir' => '/i/gallery/files/',
        'thumbnail-dir' => '/i/gallery/thumbnails/'
    );
    
    function load_files(){
        
    $CI =& get_instance();   
    
$files=<<<files
   <script type="text/javascript" src="/site/libraries/gallery/jquery.fancybox-1.3.4.pack.js"></script>
   <link href="/site/libraries/gallery/jquery.fancybox-1.3.4.css" rel="stylesheet" type="text/css">
   <link href="/site/libraries/gallery/style.css" rel="stylesheet" type="text/css">
   <script type="text/javascript" src="/site/libraries/gallery/script.js"></script>      
files;
        
        return $files;
        
    }
    
    function core1($page,$gallery_pages){
                
        $CI =& get_instance();
        
        if(empty ($gallery_pages)){
            
            $CI->db->select('id, name, create_date');
            $CI->db->where('published',1);
            $query = $CI->db->get('gallery_cats');
            $result = $query->result_array();
            
            if(!empty ($result)){
                foreach ($result  as $cat) {
                    $CI->db->where('parent_cat_id',$cat['id']);
                    if($CI->db->count_all_results('gallery_images') > 0){
                        $active_cats[] = $cat;
                    }
                }
            }
            
            if(empty($active_cats)){
                $active_cats = 0;
            }            
            
            return $this->template1($active_cats,$page);
            
        }else if(isset ($gallery_pages['cat']) && !empty ($gallery_pages['cat'])){
            
            $CI->db->select('id, suffix');
            $CI->db->where('parent_cat_id',$gallery_pages['cat']);
            $query = $CI->db->get('gallery_images');
            $images = $query->result_array();
            
            if(!empty ($images)){
                
                $CI->db->select('name,');
                $CI->db->where('id',$gallery_pages['cat']);
                $query = $CI->db->get('gallery_cats');
                $category = $query->result_array();
                
                return $this->template2($images,$category, $page);
            
            }
                        
            
        }
        
    }
    
/** 
 * Шаблон раздела категорий
 */  
    function template1($data,$page){      
        
        $CI =& get_instance();
        
        if($data != 0){
            foreach ($data as $key =>  $cat) {   
                $CI->db->select('id, suffix');
                $CI->db->where('parent_cat_id',$cat['id']);
                $CI->db->order_by('parent_cat_id','random');
                $CI->db->limit(1);
                $query = $CI->db->get('gallery_images');
                $rand_img = $query->result_array();
                if(!empty ($rand_img)){
                    $data[$key]['preview'] = $rand_img[0];
                }
                
            }
        }       
        
        $tmpl = '<div id="mdl_gallery">';
        
        $tmpl .= '<div class="mdl_headline" style="width:100%;">Галлерея</div>';
        
        if(!empty ($data)){
            
            foreach($data as $cat){
            
                $tmpl .= "<div class=\"mdl_category\" id=\"mdl_cat_{$cat['id']}\">";
                    $tmpl .= "<a href=\"/{$page}/cat/{$cat['id']}/\"><img src=\"{$this->options['thumbnail-dir']}{$cat['preview']['id']}.{$cat['preview']['suffix']}\" /></a><br/>";
                    $tmpl .= "<p><a href=\"/{$page}/cat/{$cat['id']}/\">{$cat['name']}</a></p>";
                $tmpl .= "</div>";

            }
            
        }
        
        
        $tmpl .= '</div>'; 
        
        return $tmpl;
        
    }
 /** 
 * Шаблон вывода изображений 
 */   
    function template2($images, $category, $page){
                
        $tmpl = '<div id="mdl_gallery">';
            $tmpl .= "<div class=\"header\">";
                $tmpl .= "<div class=\"mdl_headline\">{$category[0]['name']}</div>";
                $tmpl .= "<div class=\"mdl_back\"><a href=\"/{$page}/\">Назад</a></div>";            
            $tmpl .= "</div>";
        foreach ($images as  $image) {
            
            $tmpl .= "<a rel=\"mdl_image\" title=\"\" href=\"{$this->options['files_dir']}{$image['id']}.{$image['suffix']}\" class=\"mdl_image\">"; 
                $tmpl .= "<img src=\"{$this->options['files_dir']}{$image['id']}.{$image['suffix']}\" />";
            $tmpl .= "</a>"; 
            
        }
        
        $tmpl .= '</div>'; 
        
        return $tmpl;
        
    }

}

?>
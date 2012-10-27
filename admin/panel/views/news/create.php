<script type="text/javascript">
  $(document).ready(function(){
    core_news.checkboxStyle();      
  });
 </script>
<?
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
    echo $date[0].' '.$m.' '.$date[2];
}
?>  
<script type="text/javascript">
      $(document).ready(function(){
        core_news.load_ckeditor("news_redactor"); 
        core_news.load_ckeditor2("news_redactor2"); 
        core_news.upload_img();
      });
  </script>
<div style="width: 100%;float: left;height: 40px;font-weight: bold; font-size: 20px;margin-top: 20px;">
    Создать новость
</div>
<form id="form" action="<?=current_url()?>/" method="post">
    <a href="<?=base_url()?>news/show/<?=$cat_id?>/" style="float: right;" class="btn btn-danger"  >Отменить</a>
    <div style="float: right;margin-right: 20px;" class="btn" onclick="core_news.save('save')" >Сохранить</div>
    <div style="float: right;margin-right: 20px;" class="btn" onclick="core_news.save('apply')" >Применить</div>
    <div id="fields_with_errors1">
       <input name="news[name]" maxlength="40" type="text"  value="Введите название новости" onblur="if (this.value=='') this.value='Введите название новости';" onfocus="if (this.value=='Введите название новости') this.value='';"/>
       <div class="help-inline" for="inputError" id="error" style="display: none;">
           Пожалуйста, введите название новости
       </div>
    </div>
    <div class="checkbox">
        <label class="control-label">Опубликовать материал ?</label>
        <div class="controls">
            <div class="on_off">
                <input type="checkbox" name="news[published]" checked="checked" />
            </div>
        </div>        
    </div>
    <input type="hidden" name="news[preview_text]" value="" />
    <input type="hidden" name="news[cat_id]" value="<?=$cat_id?>" />
    <input type="hidden" name="news[full_text]" value="" />
    <input type="hidden" name="news[preview_img]" value="" />
    <input type="hidden" name="news[create_date]" value="<?=russian_date()?>" />
    <input type="hidden" name="type" value="" />
    <div id="fields_with_errors4">
        <div style="float: left; width: 100%;">Вступление новости</div>
        <div id="uploader">
            <div for="inputError" id="upload_error">Невозможно загрузить больше изображений</div>
            <a id="pickfiles" href="javascript:void(0);">Добавить изображение |</a>
            <a id="uploadfiles" href="javascript:void(0);">Загрузить иозображение |</a> 
            <a id="deletfile" href="javascript:void(0);">Удалить изображение</a> <br/>
            <div id="no_img">Загрузите картинку</div>
        </div>        
        <div id="filelist"> </div>
        <div id="news_redactor"></div>   
        <div class="help-inline"  for="inputError" id="error" style="display: none;">
           Новость не может быть пустой !
        </div>     
    </div>     
    <div style="float: left; width: 100%;">Полная новость</div>
    <div id="fields_with_errors4" style="width: 100%; float: left; ">       
        <div style="margin-top: 15px;float: left;" id="news_redactor2"></div>  
    </div>
</form>
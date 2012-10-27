<script type="text/javascript">
      $(document).ready(function(){
        core_news.load_ckeditor("news_redactor"); 
        core_news.load_ckeditor2("news_redactor2"); 
        core_news.upload_img();
        core_news.checkboxStyle(); 
      });
  </script>
<div style="width: 100%;float: left;height: 40px;font-weight: bold; font-size: 20px;margin-top: 20px;">
    Редактировать новость
</div>
<form id="form" action="<?=current_url()?>/" method="post">
    <a href="<?=base_url()?>news/show/<?=$cat_id?>/" style="float: right;" class="btn btn-danger"  >Отменить</a>
    <div style="float: right;margin-right: 20px;" class="btn" onclick="core_news.save('save')" >Сохранить</div>
    <div style="float: right;margin-right: 20px;" class="btn" onclick="core_news.save('apply')" >Применить</div>
    <div id="fields_with_errors1">
       <input name="news[name]" maxlength="40" type="text"  value="<?=$news[0]['name']?>" onblur="if (this.value=='') this.value='Введите название новости';" onfocus="if (this.value=='Введите название новости') this.value='';"/>
       <div class="help-inline" for="inputError" id="error" style="display: none;">
           Пожалуйста, введите название новости
       </div>
    </div>
    <div class="checkbox">
        <label class="control-label">Опубликовать материал ?</label>
        <div class="controls">
            <? $published = ($news[0]['published'] == 1) ? 'checked=""' : ''; ?>
            <div class="on_off">
                <input type="checkbox" name="news[published]" <?=$published?> />
            </div>
        </div>        
    </div>
    <input type="hidden" name="news[preview_text]" value="" />
    <input type="hidden" name="news[cat_id]" value="<?=$cat_id?>" />
    <input type="hidden" name="news[full_text]" value="" />
    <input type="hidden" name="news[preview_img]" value="" />
    <input type="hidden" name="news[create_date]" value="<?=$news[0]['create_date']?>" />
    <input type="hidden" name="type" value="" />
    <div id="fields_with_errors4">
        <div style="float: left; width: 100%;">Вступление новости</div>
        <?if(!empty ($news[0]['preview_img'])):?>
            <div id="uploader">
                <div for="inputError" id="upload_error">Невозможно загрузить больше изображений</div>
                <a style="display: none;" id="pickfiles" href="javascript:void(0);">Добавить изображение |</a>
                <a style="display: none;" id="uploadfiles" href="javascript:void(0);">Загрузить иозображение |</a> 
                <a style="display: block;" id="deletfile" href="javascript:void(0);">Удалить изображение</a> <br/>
                <div id="no_img">Загрузите картинку</div>
            </div>   
            <div id="filelist">
                <img width="320px" src="/i/uploaded/<?=$news[0]['preview_img']?>" alt="<?=$news[0]['preview_img']?>"/> 
            </div>
        <?else:?>
            <div id="uploader">
                <div for="inputError" id="upload_error">Невозможно загрузить больше изображений</div>
                <a id="pickfiles" href="javascript:void(0);">Добавить изображение |</a>
                <a id="uploadfiles" href="javascript:void(0);">Загрузить иозображение |</a> 
                <a id="deletfile" href="javascript:void(0);">Удалить изображение</a> <br/>
                <div id="no_img">Загрузите картинку</div>
            </div> 
            <div id="filelist"> </div>
        <?endif;?>
        
        <div id="news_redactor"><?=$news[0]['preview_text']?></div>   
        <div class="help-inline"  for="inputError" id="error" style="display: none;">
           Новость не может быть пустой !
        </div>     
    </div>     
    <div style="float: left; width: 100%;">Полная новость</div>
    <div id="fields_with_errors4" style="width: 100%; float: left; ">       
        <div style="margin-top: 15px;float: left;" id="news_redactor2"><?=$news[0]['full_text']?></div>  
    </div>
</form>
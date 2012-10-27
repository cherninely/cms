<script type="text/javascript">
  $(document).ready(function(){
    core_gallery.checkboxStyle();      
  });
 </script>
 <div style="width: 100%;float: left;height: 40px;font-weight: bold; font-size: 20px;margin-top: 20px;">
    Редактирование категории галереи
</div>
<form id="form" action="<?=current_url()?>/" method="post">
    <a href="<?=base_url()?>gallery/show/" style="float: right;" class="btn btn-danger"  >Отменить</a>
    <div style="float: right;margin-right: 20px;" class="btn" onclick="core_gallery.save_cat()" >Сохранить</div>
    <div id="fields_with_errors1">
       <input name="name" maxlength="40" type="text"  value="<?=$data[0]['name']?>" onblur="if (this.value=='') this.value='Введите название категории';" onfocus="if (this.value=='Введите название категории') this.value='';"/>
       <div class="help-inline" for="inputError" id="error" style="display: none;">
           Пожалуйста, введите название категории
       </div>
    </div>
    <div class="checkbox">
        <label class="control-label">Опубликовать категорию ?</label>
        <div class="controls">
            <? $published = ($data[0]['published'] == 1) ? 'checked="checked"' : ''; ?>             
            <div class="on_off">
                <input type="checkbox" name="published" <?=$published?> />
            </div>
        </div>        
    </div>
    <div id="fields_with_errors4">
        <div id="article_redactor"></div>   
        <div class="help-inline"  for="inputError" id="error" style="display: none;">
           Статья не может быть пустой !
        </div>     
    </div>
</form>
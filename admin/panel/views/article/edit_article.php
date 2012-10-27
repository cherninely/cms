<script type="text/javascript">
      $(document).ready(function(){
        core_article.load_ckeditor("article_redactor"); 
        core_article.checkboxStyle();      
      });
  </script>
<div style="width: 100%;float: left;height: 40px;font-weight: bold; font-size: 20px;margin-top: 20px;">
    Редактировать статью
</div>
  <form id="form" action="<?=current_url()?>/" method="post">
    <a href="<?=base_url()?>article/show_articles/" style="float: right;" class="btn btn-danger"  >Отменить</a>
    <div style="float: right;margin-right: 20px;" class="btn" onclick="core_article.save_article('save')" >Сохранить</div>
    <div style="float: right;margin-right: 20px;" class="btn" onclick="core_article.save_article('apply')" >Применить</div>
    <div style="float: right;margin-right: 40px;"><?=$menu_items_in_block?></div>
    <div id="fields_with_errors1">
       <input name="article[article_name]" maxlength="40" type="text"  value="<?=$article[0]['article_name']?>" onblur="if (this.value=='') this.value='Введите название статьи';" onfocus="if (this.value=='Введите название статьи') this.value='';"/>
       <div class="help-inline" for="inputError" id="error" style="display: none;">
           Пожалуйста, введите название статьи
       </div>
    </div>
    <div id="fields_with_errors2">
        <select name="connection[position_id]">
            <option value="0">Выберите, где вывести</option>
            <? foreach($positions as $position):?>
            <? $selected = ($article[0]['position_id'] == $position['id']) ? 'selected' : '' ?>
            <option <?=$selected?> value="<?=$position['id']?>"><?=$position['position_name']?></option>
            <?endforeach;?>
        </select>
        <div class="help-inline" for="inputError" id="error" style="display: none;">
           Пожалуйста, выберите место, в котором вывести статью
        </div>
    </div>
    <div class="checkbox">
        <label class="control-label">Опубликовать материал ?</label>
        <div class="controls">
            <? $published = ($article[0]['published'] == 1) ? 'checked="checked"' : ''; ?>
            <div class="on_off">
                <input type="checkbox" name="article[published]" <?=$published?>/>
            </div>
        </div>        
    </div>
    
    <div class="checkbox">
        <label class="control-label">Отобразить заголовок ?</label>
        <div class="controls">
            <? $show = ($article[0]['show_headline'] == 1) ? 'checked="checked"' : ''; ?>
            <div class="on_off">
                <input type="checkbox" name="article[show_headline]" <?=$show?>/>
            </div>
        </div>        
    </div>
    <input type="hidden" name="article[text]" value="" />
    <input type="hidden" name="connection[modules_type_id]" value="<?=$article[0]['modules_type_id']?>" />
    <input type="hidden" name="connection[order]" value="0" />
    <input type="hidden" name="type" value="" />
    <div id="fields_with_errors4">
        <div id="article_redactor"><?=$article[0]['text']?></div>   
        <div class="help-inline"  for="inputError" id="error" style="display: none;">
           Статья не может быть пустой !
        </div>     
    </div>
</form>
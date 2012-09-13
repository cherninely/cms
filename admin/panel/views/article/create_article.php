<script type="text/javascript">
      $(document).ready(function(){
        core_article.load_ckeditor("article_redactor"); 
      });
  </script>
<div style="width: 100%;float: left;height: 40px;font-weight: bold; font-size: 20px;margin-top: 20px;">
    Создать статью
</div>
<form id="form" action="<?=current_url()?>/" method="post">
    <a href="<?=base_url()?>article/show_articles/" style="float: right;" class="btn btn-danger"  >Отменить</a>
    <div style="float: right;margin-right: 20px;" class="btn" onclick="core_article.save_article()" >Сохранить</div>
    <div id="fields_with_errors1">
       <input name="article[article_name]" maxlength="40" type="text"  value="Введите название статьи" onblur="if (this.value=='') this.value='Введите название статьи';" onfocus="if (this.value=='Введите название статьи') this.value='';"/>
       <div class="help-inline" for="inputError" id="error" style="display: none;">
           Пожалуйста, введите название статьи
       </div>
    </div>
    <div id="fields_with_errors3">
        <select name="connection[menu_item_id]">
            <option value="0">Выберите, куда прикрепить</option>
            <? foreach($menu_items as $menu_name => $menu_items):?>
            <option style="color:green;" value="0" disabled><?=$menu_name?></option>
                <? foreach($menu_items as $menu_item):?>
            <option value="<?=$menu_item['menu_id']?>"><?=$menu_item['ru_title']?></option>
                <?endforeach;?>
            <?endforeach;?>
        </select>
        <div class="help-inline" for="inputError" id="error" style="display: none;">
           Пожалуйста, выберите место, в котором вывести статью
        </div>
    </div>
    <div id="fields_with_errors2">
        <select name="connection[position_id]">
            <option value="0">Выберите, где вывести</option>
            <? foreach($positions as $position):?>
            <option value="<?=$position['id']?>"><?=$position['position_name']?></option>
            <?endforeach;?>
        </select>
        <div class="help-inline" for="inputError" id="error" style="display: none;">
           Пожалуйста, выберите место, в котором вывести статью
        </div>
    <div>
        <label class="control-label">Опубликовать материал ?</label>
        <div class="controls">
              <label class="radio">
                <input type="radio" name="article[published]" value="1" checked="">
                Да
              </label>
              <label class="radio">
                <input type="radio" name="article[published]" value="0">
                Нет
              </label>
        </div>        
    </div>
    <div>
        <label class="control-label">Отобразить заголовок ?</label>
        <div class="controls">
              <label class="radio">
                <input type="radio" name="article[show_headline]" value="1" checked="">
                Да
              </label>
              <label class="radio">
                <input type="radio" name="article[show_headline]" value="0">
                Нет
              </label>
        </div>        
    </div>
    <input type="hidden" name="article[text]" value="" />
    <input type="hidden" name="connection[modules_type_id]" value="1" />
    <input type="hidden" name="connection[order]" value="0" />
    <div id="fields_with_errors4">
        <div id="article_redactor"></div>   
        <div class="help-inline"  for="inputError" id="error" style="display: none;">
           Статья не может быть пустой !
        </div>     
    </div>
</form>
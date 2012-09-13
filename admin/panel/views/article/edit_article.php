<script type="text/javascript">
      $(document).ready(function(){
        core_article.load_ckeditor("article_redactor"); 
        core_article.load_items_in_order();         
      });
  </script>
<div style="width: 100%;float: left;height: 40px;font-weight: bold; font-size: 20px;margin-top: 20px;">
    Редактировать статью
</div>
<form id="form" action="<?=current_url()?>/" method="post">
    <a href="<?=base_url()?>article/show_articles/" style="float: right;" class="btn btn-danger"  >Отменить</a>
    <div style="float: right;margin-right: 20px;" class="btn" onclick="core_article.save_article()" >Сохранить</div>
    <div id="fields_with_errors1">
       <input name="article[article_name]" maxlength="40" type="text"  value="<?=$article[0]['article_name']?>" onblur="if (this.value=='') this.value='Введите название статьи';" onfocus="if (this.value=='Введите название статьи') this.value='';"/>
       <div class="help-inline" for="inputError" id="error" style="display: none;">
           Пожалуйста, введите название статьи
       </div>
    </div>
    <div id="fields_with_errors3">
        <select onchange="core_article.load_items_in_order()" name="connection[menu_item_id]">
            <option value="0">Выберите, куда прикрепить</option>
            <? foreach($menu_items as $menu_name => $menu_items):?>
            <option style="color:green;" value="0" disabled><?=$menu_name?></option>
                <? foreach($menu_items as $menu_item):?>
            <? $selected = ($article[0]['menu_item_id'] == $menu_item['menu_id']) ? 'selected' : '' ?>
            <option <?=$selected?> value="<?=$menu_item['menu_id']?>"><?=$menu_item['ru_title']?></option>
                <?endforeach;?>
            <?endforeach;?>
        </select>
        <div class="help-inline" for="inputError" id="error" style="display: none;">
           Пожалуйста, выберите место, в котором вывести статьюs
        </div>
    </div>
    <div id="fields_with_errors2">
        <select  onchange="core_article.load_items_in_order()" name="connection[position_id]">
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
    <div>
        <label class="control-label">Опубликовать материал ?</label>
        <div class="controls">
            <? $published = ($article[0]['published'] == 1) ? 'checked=""' : ''; ?>
            <? $unpublished = ($article[0]['published'] != 1) ? 'checked=""' : ''; ?>
              <label class="radio">
                <input type="radio" name="article[published]" value="1" <?=$published?> >
                Да
              </label>
              <label class="radio">
                <input type="radio" name="article[published]" value="0" <?=$unpublished?> >
                Нет
              </label>
        </div>        
    </div>
    
    <div>
        <label class="control-label">Отобразить заголовок ?</label>
        <div class="controls">
            <? $show = ($article[0]['show_headline'] == 1) ? 'checked=""' : ''; ?>
            <? $unshow = ($article[0]['show_headline'] != 1) ? 'checked=""' : ''; ?>
              <label class="radio">
                <input type="radio" name="article[show_headline]" value="1" <?=$show?> >
                Да
              </label>
              <label class="radio">
                <input type="radio" name="article[show_headline]" value="0" <?=$unshow?> >
                Нет
              </label>
        </div>        
    </div>
    <input type="hidden" name="article[text]" value="" />
    <input type="hidden" name="connection[modules_type_id]" value="<?=$article[0]['modules_type_id']?>" />
    <input type="hidden" name="connection[order]" value="0" />
    <div id="fields_with_errors4">
        <div id="article_redactor"><?=$article[0]['text']?></div>   
        <div class="help-inline"  for="inputError" id="error" style="display: none;">
           Статья не может быть пустой !
        </div>     
    </div>
</form>
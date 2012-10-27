<div style="width: 100%;float: left;height: 40px;font-weight: bold; font-size: 20px;margin-top: 20px;">
    Добавить пункт меню
</div>
<form id="form" action="<?=current_url()?>/" method="post">
    <a href="<?=base_url()?>menu/show_menu_items/<?=$menu_id?>/" style="float: right;" class="btn btn-danger"  >Отменить</a>
    <div style="float: right;margin-right: 20px;" class="btn" onclick="core_menu.save_menu_item()" >Сохранить</div>
    <div>
        <input type="text" name="ru_title"  value="Введите название меню" onblur="if (this.value=='') this.value='Введите название меню';" onfocus="if (this.value=='Введите название меню') this.value='';" />
    </div>
    <div id="fields_with_errors1">
       <input name="title" maxlength="40" type="text"  value="Введите адресс меню" onblur="if (this.value=='') this.value='Введите адресс меню';" onfocus="if (this.value=='Введите адресс меню') this.value='';"/>
       <div class="help-inline" for="inputError" id="error1" style="display: none;">
           Пожалуйста, введите адресс меню
       </div>
    </div>
    <div>
        <select name="parentid">
            <option value="0">-- станет родителем --</option>
            <? foreach($parents as $menu_item): ?>
            <option value="<?=$menu_item['id']?>"><?=$menu_item['ru_title']?></option>
            <?  endforeach;?>
        </select>
    </div>
   <div id="article_redactor"></div>
   <input type="hidden" name="menu_id" value="<?=$menu_id?>" />
   <input type="hidden" name="published" value="0" />
   <input type="hidden" name="level" value="<?=$level?>" />
</form>
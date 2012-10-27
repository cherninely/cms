<div style="width: 100%;float: left;height: 40px;font-weight: bold; font-size: 20px;margin-top: 20px;">
    Создать меню
</div>
<form id="form" action="<?=current_url()?>/" method="post">
    <a href="<?=base_url()?>/menu/show_menus/" style="float: right;" class="btn btn-danger"  >Отменить</a>
    <div style="float: right;margin-right: 20px;" class="btn" onclick="core_menu.save_menu()" >Сохранить</div>
    <div id="fields_with_errors">
       <input name="menu[menu_name]" maxlength="40" type="text"  value="Введите название меню" onblur="if (this.value=='') this.value='Введите название меню';" onfocus="if (this.value=='Введите название меню') this.value='';"/>
       <div class="help-inline" for="inputError" id="error" style="display: none;">
           Пожалуйста, введите название меню
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
    </div> 
    <div style="margin-top: 10px;float: left;"><?=$menu_items_in_block?></div>    
    <input type="hidden" name="connection[modules_type_id]" value="2" />
    <input type="hidden" name="connection[order]" value="0" />
    <input type="hidden" name="menu[published]" value="0" />
</form>
<?
//echo '<pre>';
//print_r($positions);
?>
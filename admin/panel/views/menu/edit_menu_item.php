<?
//echo '<pre>';
//print_r($data);
?>
<div style="width: 100%;float: left;height: 40px;font-weight: bold; font-size: 20px;margin-top: 20px;">
    Изменить пункт меню
</div>
<form id="form" action="<?=current_url()?>/" method="post">
    <a href="<?=base_url()?>menu/show_menu_items/<?=$data[0]['menu_id']?>/" style="float: right;" class="btn btn-danger"  >Отменить</a>
    <div style="float: right;margin-right: 20px;" class="btn" onclick="core_menu.save_menu_item()" >Сохранить</div>
    <div id="fields_with_errors1">
       <input name="title" maxlength="40" type="text"  value="<?=$data[0]['title']?>"/>
       <div class="help-inline" for="inputError" id="error1" style="display: none;">
           Пожалуйста, введите название меню
       </div> 
        <div>
            <input type="text" name="ru_title"  value="<?=$data[0]['ru_title']?>" />
        </div>   
        <div>
            <select name="parentid">
                <option value="0">-- станет родителем --</option>
                <? foreach($parents as $menu_item): ?>
                <option <?=($menu_item['id'] == $data[0]['parentid']) ? 'selected' : ''?> value="<?=$menu_item['id']?>"><?=$menu_item['ru_title']?></option>
                <?  endforeach;?>
            </select>
        </div>
       <div style="float: right;margin-right: 200px;">
        <table class="table table-striped table-bordered table-condensed" cellspadding="0" cellspacing="0">
              <thead>     
                <tr> 
                    <th style="text-align: center;">
                        Тип модуля
                    </th>
                    <th style="text-align: center; width: 20px;">
                        Порядок
                    </th>        
                </tr>
                </thead>
                <tbody>
                </tbody>
        </table>
    </div>
    </div>
   <div id="article_redactor"></div>
   <input type="hidden" name="menu_id" value="<?=$data[0]['menu_id']?>" />
   <input type="hidden" name="type" value="save_menu_item" />
   <input type="hidden" name="published" value="<?=$data[0]['published']?>" />
   <input type="hidden" name="level" value="<?=$data[0]['level']?>" />
</form>
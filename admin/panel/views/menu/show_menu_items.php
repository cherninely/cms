<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        core_menu.load_menu_sort();
        core_menu.change_order_items(); 
    });
</script>
<div style="width: 100%;float: left;height: 40px;font-weight: bold; font-size: 20px;margin-top: 20px;">
    Меню «<?=$page_information[0]['menu_name'];?>»
</div>
<table id="sort" class="table table-striped table-bordered table-condensed" cellspadding="0" cellspacing="0">
  <thead>
      <tr>
        <td colspan="100"><a href="<?=base_url()?>menu/create_menu_item/<?=$page_information[0]['id'];?>/">Добавить пункт меню</a></td>
    </tr>     
    <tr> 
  
        <th style="text-align: center;">
            Заголовок пункта меню
        </th>
        <th>
            Редактировать
        </th>
        <th style="text-align: center;">
            Главная
        </th>
        <th style="text-align: center; width: 20px;">
            Состояние
        </th>
        <th style="text-align: center;width: 20px;">
            Порядок
        </th>  
        <th style="text-align: center;width: 20px;">
            Удалить
        </th>        
    </tr>
    </thead>
    <tbody id="sortable">
    <?php foreach ($menu_items as $item): ?>
    <tr id="item_<?=$item['menu_item_id']?>">
        <td style="vertical-align: middle; height: 40px;"><?=$item['title']?></td>
        <td style="text-align: center;vertical-align: middle;width: 20px;"><a href="<?=base_url()?>menu/edit_menu_item/<?=$page_information[0]['id'];?>/<?=$item['menu_item_id']?>/"><i class="icon-edit"></i></a></td>
        <td style="text-align: center;vertical-align: middle;width: 20px;">
            <? if($item['main']): ?>
            <i class="icon-ok"></i>
             <? else: ?>
            <?php endif; ?>
        </td>
        <td style="text-align: center;vertical-align: middle; width: 20px;">
            <a id="published_<?=$item['menu_item_id']?>" href="#">
                <img onclick="core_menu.published(<?=$item['menu_item_id']?>,<?=$item['published']?>)" src="<?=base_url()?>i/menu/<?=($item['published']) ?  'published' : 'unpublished'?>.png" />
            </a>
        </td>
        <td id="level" style="text-align: center;vertical-align: middle;width: 20px;">
            <?=$item['level']?>
        </td>
        <td style="text-align: center;vertical-align: middle;width: 20px;">
            <a href="#">
<!--                    <i onclick="$('#delete_menu_item_warning').modal()" class="icon-remove"></i>-->
                    <i onclick="core_menu.delete_menu_items(<?=$item['menu_item_id']?>)" class="icon-remove"></i>
            </a>
        </td>
    </tr>
    <?if(isset ($item['sub_menu_items'])):?>
        <?php foreach ($item['sub_menu_items'] as $sub_menu_item): ?>
        <tr id="item_<?=$sub_menu_item['menu_item_id']?>">
            <td style="vertical-align: middle; height: 40px;"><span style="padding-right: 10px;" class="icon-arrow-up"></span><?=$sub_menu_item['title']?></td>
            <td style="text-align: center;vertical-align: middle;width: 20px;"><a href="<?=base_url()?>menu/edit_menu_item/<?=$page_information[0]['id'];?>/<?=$sub_menu_item['menu_item_id']?>/"><i class="icon-edit"></i></a></td>
            <td style="text-align: center;vertical-align: middle;width: 20px;">
                <? if($sub_menu_item['main']): ?>
                <i class="icon-ok"></i>
                 <? else: ?>
                <?php endif; ?>
            </td>
            <td style="text-align: center;vertical-align: middle; width: 20px;">
                <a id="published_<?=$sub_menu_item['menu_item_id']?>" href="#">
                    <img onclick="core_menu.published(<?=$sub_menu_item['menu_item_id']?>,<?=$sub_menu_item['published']?>)" src="<?=base_url()?>i/menu/<?=($sub_menu_item['published']) ?  'published' : 'unpublished'?>.png" />
                </a>
            </td>
            <td id="level" style="text-align: center;vertical-align: middle;width: 20px;">
                <?=$sub_menu_item['level']?>
            </td>
            <td style="text-align: center;vertical-align: middle;width: 20px;">
                <a href="#">
    <!--                    <i onclick="$('#delete_menu_item_warning').modal()" class="icon-remove"></i>-->
                        <i onclick="core_menu.delete_menu_items(<?=$sub_menu_item['menu_item_id']?>)" class="icon-remove"></i>
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    <?  endif;?>
    <?php endforeach; ?>
    </tbody>
</table>
<!---Модальные окна------------------------------------------------------------------------->
<div class="modal hide fade" id="delete_menu_item_warning">
  <div class="modal-header">
    <button class="close" data-dismiss="modal">×</button>
    <h3 style="color:red">Предупреждение!</h3>
  </div>
  <div class="modal-body">
    <p>Вы уверены, что хотите удалить пункт меню ?</p>
  </div>
  <div class="modal-footer">
    <a href="#" data-dismiss="modal" onclick="core_menu.delete_menu_items(<?=$item['menu_item_id']?>)" class="btn">Да, уверен</a>
    <a href="#" data-dismiss="modal" class="btn btn-primary">Нет</a>
  </div>
</div>

<div class="modal hide fade" id="delete_menu_item_error">
  <div class="modal-header">
    <button class="close" data-dismiss="modal">×</button>
    <h3 style="color:red">Ошибка!</h3>
  </div>
  <div class="modal-body">
    <p>Не удалось удалить пункт меню. Возможно он назначен как "Главная".</p>
  </div>
</div>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        core_menu.load_menu_sort();
        core_menu.change_order_items(); 
    });
</script>
<div id="headline">
    Меню «<?=$page_information[0]['menu_name'];?>»
</div>
<div id="addInShow">
    <div id="block1"></div>
    <div id="block2"><a href="<?=base_url()?>menu/create_menu_item/<?=$page_information[0]['id'];?>/"><span>+</span>Добавить пункт меню</a></div>
    <div id="block3"></div>    
</div>
<table id="sort" class="table table-striped table-bordered table-condensed" cellspadding="0" cellspacing="0">
  <thead>     
    <tr> 
        <th class="titleColumn current"></th>
        <th class="titleColumn">
            Заголовок пункта меню
        </th>
        <th class="editColumn">
            Редактировать
        </th>
        <th style="text-align: center;">
            Главная
        </th>
        <th class="statusColumn">
            Состояние
        </th>
        <th>
            Порядок
        </th>  
        <th class="deleteColumn">
            Удалить
        </th>        
    </tr>
    </thead>
    <tbody id="sortable">
    <?php foreach ($menu_items as $item): ?>
    <tr id="item_<?=$item['menu_item_id']?>">
        <td class="hovered_row"><span></span></td>
        <td class="headerColumn"><?=$item['title']?></td>
        <td class="editColumn"><a href="<?=base_url()?>menu/edit_menu_item/<?=$page_information[0]['id'];?>/<?=$item['menu_item_id']?>/"><div class="editButton"></div></a></td>
        <td style="text-align: center;vertical-align: middle;width: 20px;">
            <? if($item['main']): ?>
            <i class="icon-ok"></i>
             <? else: ?>
            <?php endif; ?>
        </td>
        <td class="statusColumn">
            <div onclick="core_menu.published(<?=$item['menu_item_id']?>,<?=$item['published']?>)" class="statusButton <?=($item['published']) ?  'on' : 'off'?>"></div>
        </td>
        <td id="level" style="text-align: center;vertical-align: middle;width: 20px;">
            <?=$item['level']?>
        </td>
        <td class="deleteColumn">
            <div class="deleteButton" onclick="$('#delete_warning .modal-footer #yes').attr('onclick','core_menu.delete_menu_items(<?=$item['menu_item_id']?>)');$('#delete_warning').modal()"></div>
        </td>
    </tr>
    <?if(isset ($item['sub_menu_items'])):?>
        <?php foreach ($item['sub_menu_items'] as $sub_menu_item): ?>
        <tr id="item_<?=$sub_menu_item['menu_item_id']?>">
            <td class="hovered_row"><span></span></td>
            <td class="headerColumn"><span style="padding-right: 10px;" class="icon-share-alt"></span><?=$sub_menu_item['title']?></td>
            <td class="editColumn"><a href="<?=base_url()?>menu/edit_menu_item/<?=$page_information[0]['id'];?>/<?=$sub_menu_item['menu_item_id']?>/"><div class="editButton"></div></a></td>
            <td style="text-align: center;vertical-align: middle;width: 20px;">
                <? if($sub_menu_item['main']): ?>
                <i class="icon-ok"></i>
                 <? else: ?>
                <?php endif; ?>
            </td>
            <td class="statusColumn">
                <div onclick="core_menu.published(<?=$sub_menu_item['menu_item_id']?>,<?=$sub_menu_item['published']?>)" class="statusButton <?=($sub_menu_item['published']) ?  'on' : 'off'?>"></div>               
            </td>
            <td id="level" style="text-align: center;vertical-align: middle;width: 20px;">
                <?=$sub_menu_item['level']?>
            </td>
            <td class="deleteColumn">
                <div class="deleteButton" onclick="$('#delete_warning .modal-footer #yes').attr('onclick','core_menu.delete_menu_items(<?=$sub_menu_item['menu_item_id']?>)');$('#delete_warning').modal()"></div>
            </td>
        </tr>
        <?php endforeach; ?>
    <?  endif;?>
    <?php endforeach; ?>
    </tbody>
</table>
<!---Модальные окна------------------------------------------------------------------------->

<div class="modal hide fade" id="delete_warning">
  <div class="modal-header">
    <button class="close" data-dismiss="modal">×</button>
    <h3 style="color:red">Предупреждение!</h3>
  </div>
  <div class="modal-body">
    <p>Вы уверены, что хотите удалить меню ?</p>
  </div>
  <div class="modal-footer">
    <a href="#" id="yes" data-dismiss="modal" class="btn">Да, уверен</a>
    <a href="#" data-dismiss="modal" class="btn btn-primary">Нет</a>
  </div>
</div>
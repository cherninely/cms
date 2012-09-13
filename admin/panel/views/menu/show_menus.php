<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        core_menu.load_menu_sort();
    });
</script>
<div style="width: 100%;float: left;height: 40px;font-weight: bold; font-size: 20px;margin-top: 20px;">
    Все меню
</div>
<table id="sort" class="table table-striped table-bordered table-condensed" cellspadding="0" cellspacing="0">
  <thead>
      <tr>
        <td colspan="100"><a href="<?=base_url()?>menu/create_menu/">Добавить меню</a></td>
    </tr>     
    <tr> 
  
        <th style="text-align: center;">
            Заголовок меню
        </th>
        <th>
            Редактировать
        </th>
        <th style="text-align: center; width: 20px;">
            Состояние
        </th>  
        <th style="text-align: center;width: 20px;">
            Удалить
        </th>        
    </tr>
    </thead>
    <tbody id="sortable">
    <?php foreach ($menus as $menu): ?>
    <?if($menu['id'] == 0) continue;?>
    <tr id="item_<?=$menu['id']?>"><!--прячем системное меню-->
        <td style="vertical-align: middle; height: 40px;"><a href="<?=base_url()?>menu/show_menu_items/<?=$menu['id'];?>/"><?=$menu['menu_name']?></a></td>
        <td style="text-align: center;vertical-align: middle;width: 20px;"><a href="<?=base_url()?>menu/edit_menu/<?=$menu['id'];?>/"><i class="icon-edit"></i></a></td>
        <td style="text-align: center;vertical-align: middle; width: 20px;">
            <a id="published_<?=$menu['id']?>" href="#">
                <img onclick="core_menu.published_menu(<?=$menu['id']?>,<?=$menu['published']?>)" src="<?=base_url()?>i/menu/<?=($menu['published']) ?  'published' : 'unpublished'?>.png" />
            </a>
        </td>
        <td style="text-align: center;vertical-align: middle;width: 20px;">
            <a href="#">
                    <i onclick="$('#delete_menu_warning').modal()" class="icon-remove"></i>
            </a>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<div class="modal hide fade" id="delete_menu_warning">
  <div class="modal-header">
    <button class="close" data-dismiss="modal">×</button>
    <h3 style="color:red">Предупреждение!</h3>
  </div>
  <div class="modal-body">
    <p>Вы уверены, что хотите удалить меню ?</p>
  </div>
  <div class="modal-footer">
    <a href="#" data-dismiss="modal" onclick="core_menu.delete_menu(<?=$menu['id']?>)" class="btn">Да, уверен</a>
    <a href="#" data-dismiss="modal" class="btn btn-primary">Нет</a>
  </div>
</div>

<div class="modal hide fade" id="delete_menu_error">
  <div class="modal-header">
    <button class="close" data-dismiss="modal">×</button>
    <h3 style="color:red">Ошибка!</h3>
  </div>
  <div class="modal-body">
    <p>Не удалось удалить меню. Возможно один из его пунктов назначен как "Главная".</p>
  </div>
</div>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        core_news.load_news_sort();
    });
</script>
<div id="headline">
    Все категории новостей
</div>
<div id="addInShow">
    <div id="block1"></div>
    <div id="block2"><a href="<?=base_url()?>news/create_cat/">Создать категорию</a></div>
    <div id="block3"></div>    
</div>
<table id="sort" class="table table-striped table-bordered table-condensed" cellspadding="0" cellspacing="0">
  <thead>     
    <tr> 
        <th class="titleColumn current"></th>
        <th class="titleColumn">
            Заголовок категории
        </th>
        <th class="editColumn">
            Редактировать
        </th>
        <th class="statusColumn">
            Состояние
        </th>
        <th class="deleteColumn">
            Удалить
        </th>        
    </tr>
    </thead>
    <tbody id="sortable">
    <?php foreach ($news_cats as $cat): ?>
    <tr id="item_<?=$cat['id']?>">
        <td class="hovered_row"><span></span></td>
        <td class="headerColumn"><a href="<?=base_url()?>news/show/<?=$cat['id'];?>/"><?=$cat['name']?></a></td>
        <td class="editColumn"><a href="<?=base_url()?>news/edit_cat/<?=$cat['id'];?>/"><div class="editButton"></div></a></td>
        <td class="statusColumn">
            <div onclick="core_news.published_cat(<?=$cat['id']?>,<?=$cat['published']?>)" class="statusButton <?=($cat['published']) ?  'on' : 'off'?>"></div>
        </td>
        <td class="deleteColumn">
            <div class="deleteButton" onclick="$('#delete_warning .modal-footer #yes').attr('onclick','core_news.delete_news_cat(<?=$cat['id']?>)');$('#delete_warning').modal()"></div>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>


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
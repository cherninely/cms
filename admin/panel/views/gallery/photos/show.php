<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        core_gallery.load_cats_sort();  
    });
</script>
<div id="headline">
    Изображения в категории «<?=$cat_name[0]['name']?>»
</div>
<div id="addInShow">
    <div id="block1"></div>
    <div id="block2"><a href="<?=base_url()?>gallery/upload_photos/<?=$cat_id?>">Добавить изображения</a></div>
    <div id="block3"></div>    
</div>
<table id="sort" class="table table-striped table-bordered table-condensed" cellspadding="0" cellspacing="0">
  <thead>     
    <tr> 
        <th class="titleColumn current"></th>
        <th class="titleColumn">
            Изображение
        </th>
<!--        <th class="statusColumn">
            Состояние
        </th>-->
        <th class="deleteColumn">
            Удалить
        </th>        
    </tr>
    </thead>
    <tbody>
    <?php foreach ($photos as $photo): ?>
    <tr id="item_<?=$photo['id']?>">
        <td class="hovered_row"><span></span></td>
        <td class="headerColumn">
            <img style="padding: 5px;" src="/i/gallery/thumbnails/<?=$photo['id']?>.<?=$photo['suffix']?>" />
        </td>
<!--        <td style="text-align: center;vertical-align: middle; width: 20px;">
            <a id="published_<?=$photo['id']?>" href="#">
                <img onclick="core_gallery.published(<?=$photo['id']?>,<?=$photo['published']?>)" src="<?=base_url()?>i/menu/<?=($photo['published']) ?  'published' : 'unpublished'?>.png" />
            </a>
        </td>-->
        <td class="deleteColumn">
            <div class="deleteButton" onclick="$('#delete_warning .modal-footer #yes').attr('onclick','core_gallery.delete_img(<?=$photo['id']?>,\'<?=$photo['suffix']?>\')');$('#delete_warning').modal();"></div>
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
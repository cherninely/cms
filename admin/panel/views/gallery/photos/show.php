<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        core_gallery.load_cats_sort();  
    });
</script>
<div style="width: 100%;float: left;height: 40px;font-weight: bold; font-size: 20px;margin-top: 20px;">
    Изображения в категории «<?=$cat_name[0]['name']?>»
</div>
<table id="sort" class="table table-striped table-bordered table-condensed" cellspadding="0" cellspacing="0">
  <thead>
      <tr>
        <td colspan="100"><a href="<?=base_url()?>gallery/upload_photos/<?=$cat_id?>">Добавить изображения</a></td>
    </tr>     
    <tr> 
  
        <th style="text-align: center;">
            Заголовок категории
        </th>
        <th>
            Редактировать
        </th>
        <th style="text-align: center; width: 130px;">
            Дата создания
        </th>
        <th style="text-align: center; width: 20px;">
            Состояние
        </th>
        <th style="text-align: center;width: 20px;">
            Удалить
        </th>        
    </tr>
    </thead>
<!--    <tbody>
    <?php foreach ($categories as $categorie): ?>
    <tr id="item_<?=$categorie['id']?>">
        <td style="vertical-align: middle; height: 40px;"><a href="<?=base_url()?>gallery/show_photos/<?=$categorie['id'];?>/"><?=$categorie['name']?></a></td>
        <td style="text-align: center;vertical-align: middle; width: 20px;"><a href="<?=base_url()?>gallery/edit/<?=$categorie['id'];?>/"><i class="icon-edit"></i></a></td>
        <td style="text-align: center;vertical-align: middle;"><?=$categorie['create_date']?></td>
        <td style="text-align: center;vertical-align: middle; width: 20px;">
            <a id="published_<?=$categorie['id']?>" href="#">
                <img onclick="core_gallery.published(<?=$categorie['id']?>,<?=$categorie['published']?>)" src="<?=base_url()?>i/menu/<?=($categorie['published']) ?  'published' : 'unpublished'?>.png" />
            </a>
        </td>
        <td style="text-align: center;vertical-align: middle;width: 20px;">
            <a href="#">
                    <i onclick="core_gallery.delete_cat(<?=$categorie['id']?>)" class="icon-remove"></i>
            </a>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>-->
</table>
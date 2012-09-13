<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        core_news.load_news_sort();
    });
</script>
<div style="width: 100%;float: left;height: 40px;font-weight: bold; font-size: 20px;margin-top: 20px;">
    Все новости
</div>
<table id="sort" class="table table-striped table-bordered table-condensed" cellspadding="0" cellspacing="0">
  <thead>
      <tr>
        <td colspan="100"><a href="<?=base_url()?>news/create/">Создать новость</a></td>
    </tr>     
    <tr> 
  
        <th style="text-align: center;">
            Заголовок новости
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
    <tbody id="sortable">
    <?php foreach ($news as $news): ?>
    <tr id="item_<?=$news['id']?>">
        <td style="vertical-align: middle; height: 40px;"><?=$news['name']?></td>
        <td style="text-align: center;vertical-align: middle; width: 20px;"><a href="<?=base_url()?>news/edit/<?=$news['id'];?>/"><i class="icon-edit"></i></a></td>
        <td style="text-align: center;vertical-align: middle;"><?=$news['create_date']?></td>
        <td style="text-align: center;vertical-align: middle; width: 20px;">
            <a id="published_<?=$news['id']?>" href="#">
                <img onclick="core_news.published(<?=$news['id']?>,<?=$news['published']?>)" src="<?=base_url()?>i/menu/<?=($news['published']) ?  'published' : 'unpublished'?>.png" />
            </a>
        </td>
        <td style="text-align: center;vertical-align: middle;width: 20px;">
            <a href="#">
                    <i onclick="core_news.delete_news(<?=$news['id']?>)" class="icon-remove"></i>
            </a>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
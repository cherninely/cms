<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        core_article.load_article_sort();
    });
</script>
<div style="width: 100%;float: left;height: 40px;font-weight: bold; font-size: 20px;margin-top: 20px;">
    Все статьи
</div>
<table id="sort" class="table table-striped table-bordered table-condensed" cellspadding="0" cellspacing="0">
  <thead>
      <tr>
        <td colspan="100"><a href="<?=base_url()?>article/create_article/">Создать статью</a></td>
    </tr>     
    <tr>   
        <th style="text-align: center;">
            Заголовок статьи
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
    <?php foreach ($articles as $article): ?>
    <tr id="item_<?=$article['id']?>">
        <td style="vertical-align: middle; height: 40px;"><?=$article['article_name']?></td>
        <td style="text-align: center;vertical-align: middle;width: 20px;"><a href="<?=base_url()?>article/edit_article/<?=$article['id'];?>/"><i class="icon-edit"></i></a></td>
        <td style="text-align: center;vertical-align: middle; width: 20px;">
            <a id="published_<?=$article['id']?>" href="#">
                <img onclick="core_article.published(<?=$article['id']?>,<?=$article['published']?>)" src="<?=base_url()?>i/menu/<?=($article['published']) ?  'published' : 'unpublished'?>.png" />
            </a>
        </td>
        <td style="text-align: center;vertical-align: middle;width: 20px;">
            <a href="#">
                    <i onclick="core_article.delete_article(<?=$article['id']?>)" class="icon-remove"></i>
            </a>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
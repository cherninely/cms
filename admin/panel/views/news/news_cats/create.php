<script type="text/javascript">
  $(document).ready(function(){
    core_news.checkboxStyle();      
  });
 </script>
<div style="width: 100%;float: left;height: 40px;font-weight: bold; font-size: 20px;margin-top: 20px;">
    Создать категорию для новостей
</div>
<form id="form" action="<?=current_url()?>/" method="post">
    <a href="<?=base_url()?>news/show_news_cats/" style="float: right;" class="btn btn-danger"  >Отменить</a>
    <div style="float: right;margin-right: 20px;" class="btn" onclick="core_news.save_cat()" >Сохранить</div>
    <div id="fields_with_errors1">
       <input name="name" maxlength="40" type="text"  value="Введите название категории" onblur="if (this.value=='') this.value='Введите название категории';" onfocus="if (this.value=='Введите название категории') this.value='';"/>
       <div class="help-inline" for="inputError" id="error" style="display: none;">
           Пожалуйста, введите название категории
       </div>
    </div>
    <div class="checkbox">
        <label class="control-label">Опубликовать материал ?</label>
        <div class="controls">
            <div class="on_off">
                <input type="checkbox" name="published" checked="checked" />
            </div>
        </div>        
    </div>
</form>
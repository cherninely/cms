// ОБРАБОТАТЬ ВСЕ ОШИБКИ (else) и т.д. Вывести предупреждающие сообщения
$(document).ready(function(){
        core_menu.load_drop_down_menu(); 
});

var panel_name = '/admin/'; //название админ панели

var core_menu = {
            //Создание меню----------------------------------------------------------
            save_menu:function(){
                if($("input[name=menu_name]").val() != 'Введите название меню'){
                    $("#form").submit();
                }else{
                    $("#fields_with_errors").addClass("control-group error");
                    $("#form #error").show();
                }
            },
            //Сохранение пункта меню----------------------------------------------------------
            save_menu_item:function(){
                if($("input[name=title]").val() != 'Введите адресс меню'){
                    $("#form").submit();
                }else{
                    $("#fields_with_errors1").addClass("control-group error");
                    $("#form #error1").show();
                }                
            },
            //Изменение порядка пунктов меню----------------------------------------------------------
            change_order_items:function(){
                $("#sortable" ).sortable({
                        placeholder: "ui-state-highlight",
                        update: function(event, ui) {
                            var elements = $("#sortable" ).sortable("toArray");
                            $.post(panel_name+"menu/show_menu_items/",{type:'change_order_items',data:elements}, function(data) {
                                $.each(data, function(index, value){
                                    $("#item_"+value+" #level").html(index);
                                });
                            },'json');
                        }
                });
            },
            //сортировка меню-------------------------------------------------------------------------
            load_menu_sort:function(){
                $('#sort').dataTable({
                    "aaSorting": [[ 2, "asc" ]]
                } );
            },
            //Выпадающее меню-------------------------------------------------------------------------
            load_drop_down_menu:function(){
                $('li.button a').click(function(e){
                    var dropDown = $(this).parent().next();
                    $('.dropdown').not(dropDown).slideUp('slow');
                    dropDown.slideToggle('slow');
                    e.preventDefault();
                });
            },
            //Удаление пунктов меню-------------------------------------------------------------------
            delete_menu_items: function(menu_item_id){
                $.post(panel_name+"menu/show_menu_items/",{type:'delete_menu_items',menu_item_id:menu_item_id}, function(data) {
                    if(data == 'true'){
                        $("#item_"+menu_item_id).fadeOut('slow');
                    }else{
                        $('#delete_menu_item_error').modal();
                    }
                });
            },
            //Опубликование/неопубликование пунктов меню----------------------------------------------
            published: function(id,published){
                var clas = $("#item_"+id+" .statusColumn .statusButton").attr('class').split(' ', 2);
                (clas[1] == 'on') ? published=0 : published=1;
                console.log($("#item_"+id+" .statusColumn .statusButton"));
                $.post(panel_name+"menu/show_menu_items/",{type:'published', menu_item_id:id, published:published}, function(data) {
                    if(data == 'true'){
                        if(published){
                            $("#item_"+id+" .statusColumn .statusButton").removeClass('off').addClass('on');
                        }else{
                            $("#item_"+id+" .statusColumn .statusButton").removeClass('on').addClass('off');                           
                        }
                    }else{
                        
                    }
                });
                
            },
            //Опубликование/неопубликование меню----------------------------------------------
            published_menu: function(id,published){
                var clas = $("#item_"+id+" .statusColumn .statusButton").attr('class').split(' ', 2);
                (clas[1] == 'on') ? published=0 : published=1;
                $.post(panel_name+"menu/show_menus/",{type:'published', menu_id:id, published:published}, function(data) {
                    if(data == 'true'){
                        if(published){
                            $("#item_"+id+" .statusColumn .statusButton").removeClass('off').addClass('on');
                        }else{
                            $("#item_"+id+" .statusColumn .statusButton").removeClass('on').addClass('off');                           
                        }
                    }else{
                        
                    }
                });
                
            },
            //Удаление пунктов меню-------------------------------------------------------------------
            delete_menu: function(menu_id){
                $.post(panel_name+"menu/show_menus/",{type:'delete_menu',menu_id:menu_id}, function(data) {
                    console.log(data);
                    if(data == 'true'){
                        $("#item_"+menu_id).fadeOut('slow');
                    }else{
                        $('#delete_menu_error').modal();
                    }
                });
            }
};



var core_article = {    
            //Подгрузка редактора----------------------------------------------------------
            load_ckeditor:function(id){
                var config = {
                    filebrowserBrowseUrl :panel_name+'js/ckeditor/filemanager/browser/default/browser.html?Connector='+panel_name+'js/ckeditor/filemanager/connectors/php/connector.php',
                    filebrowserImageBrowseUrl : panel_name+'js/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector='+panel_name+'js/ckeditor/filemanager/connectors/php/connector.php',
                    filebrowserFlashBrowseUrl :panel_name+'js/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector='+panel_name+'js/ckeditor/filemanager/connectors/php/connector.php',
                    filebrowserUploadUrl  :panel_name+'js/ckeditor/filemanager/connectors/php/upload.php?Type=File',
                    filebrowserImageUploadUrl : panel_name+'js/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
                    filebrowserFlashUploadUrl : panel_name+'js/ckeditor/filemanager/connectors/php/upload.php?Type=Flash'
                };
                article_redactor = CKEDITOR.replace( id, config, $('#article_redactor').text());
            },           
            //сортировка меню-------------------------------------------------------------------------
            load_article_sort:function(){
                $('#sort').dataTable({
                    "aaSorting": [[ 2, "asc" ]]
                } );
            },            
            //Удаление пунктов меню-------------------------------------------------------------------
            delete_article: function(article_id){
                $.post(panel_name+"article/show_articles/",{type:'delete_article',article_id:article_id}, function(data) {
                    if(data = 'true'){
                        $("#item_"+article_id).fadeOut('slow');
                    }else{
                        
                    }
                });
            },
            //Опубликование/неопубликование пунктов меню----------------------------------------------
            published: function(id,published){
                var clas = $("#item_"+id+" .statusColumn .statusButton").attr('class').split(' ', 2);
                (clas[1] == 'on') ? published=0 : published=1;
                console.log($("#item_"+id+" .statusColumn .statusButton"));
                $.post(panel_name+"article/show_articles/",{type:'published', article_id:id, published:published}, function(data) {
                    if(data == 'true'){
                        if(published){
                            $("#item_"+id+" .statusColumn .statusButton").removeClass('off').addClass('on');
                        }else{
                            $("#item_"+id+" .statusColumn .statusButton").removeClass('on').addClass('off');                           
                        }
                    }else{
                        
                    }
                });
                
            },
            //сохоранить статью----------------------------------------------
            save_article:function(type){
                $("input[name=type]").attr('value', type);
                var article = article_redactor.getData();
                if($("input[name=article\\[article_name\\]]").val() != 'Введите название статьи'){
                    if($("select[name=connection\\[position_id\\]]").val() != 0){
                        if($("select[name=connection\\[menu_item_id\\]]").val() != 0){
                            if(article.length != 0){
                                $("input[name=article\\[text\\]]").val(article);
                                $("#form").submit();                                
                            }else{
                                $("#fields_with_errors4").addClass("control-group error");
                                $("#fields_with_errors4 #error").show()
                            }
                        }else{
                            $("#fields_with_errors3").addClass("control-group error");
                            $("#fields_with_errors3 #error").show();                            
                        }
                    }else{
                        $("#fields_with_errors2").addClass("control-group error");
                        $("#fields_with_errors2 #error").show();
                        
                    }
                }else{
                    $("#fields_with_errors1").addClass("control-group error");
                    $("#fields_with_errors1 #error").show();
                }
            },
            //делаем чекбоксы красивыми----------------------------------------------
            checkboxStyle:function(){                
                $('.on_off :checkbox').iphoneStyle();                   
            }
};

var core_news = {    
            //Подгрузка редактора----------------------------------------------------------
            load_ckeditor:function(id){
                var config = {
                    filebrowserBrowseUrl :panel_name+'js/ckeditor/filemanager/browser/default/browser.html?Connector='+panel_name+'js/ckeditor/filemanager/connectors/php/connector.php',
                    filebrowserImageBrowseUrl : panel_name+'js/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector='+panel_name+'js/ckeditor/filemanager/connectors/php/connector.php',
                    filebrowserFlashBrowseUrl :panel_name+'js/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector='+panel_name+'js/ckeditor/filemanager/connectors/php/connector.php',
                    filebrowserUploadUrl  :panel_name+'js/ckeditor/filemanager/connectors/php/upload.php?Type=File',
                    filebrowserImageUploadUrl : panel_name+'js/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
                    filebrowserFlashUploadUrl : panel_name+'js/ckeditor/filemanager/connectors/php/upload.php?Type=Flash'
                };
                news_part1 = CKEDITOR.replace( id, config, $('#news_redactor').text());
            },    
            //Подгрузка редактора----------------------------------------------------------
            load_ckeditor2:function(id){
                var config = {
                    filebrowserBrowseUrl :panel_name+'js/ckeditor/filemanager/browser/default/browser.html?Connector='+panel_name+'js/ckeditor/filemanager/connectors/php/connector.php',
                    filebrowserImageBrowseUrl : panel_name+'js/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector='+panel_name+'js/ckeditor/filemanager/connectors/php/connector.php',
                    filebrowserFlashBrowseUrl :panel_name+'js/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector='+panel_name+'js/ckeditor/filemanager/connectors/php/connector.php',
                    filebrowserUploadUrl  :panel_name+'js/ckeditor/filemanager/connectors/php/upload.php?Type=File',
                    filebrowserImageUploadUrl : panel_name+'js/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
                    filebrowserFlashUploadUrl : panel_name+'ckeditor/filemanager/connectors/php/upload.php?Type=Flash'
                };
                news_part2 = CKEDITOR.replace( id, config, $('#news_redactor2').text());
            },           
            //сортировка новостей-------------------------------------------------------------------------
            load_news_sort:function(){
                $('#sort').dataTable({
                    "aaSorting": [[ 2, "asc" ]]
                } );
            },            
            //Удаление пунктов новостей-------------------------------------------------------------------
            delete_news: function(id){
                $.post(panel_name+"news/show/",{type:'delete_news_item',news_item_id:id}, function(data) {
                    if(data = 'true'){
                        $("#item_"+id).fadeOut('slow');
                    }else{
                        
                    }
                });
            },
            //Опубликование/неопубликование новостей----------------------------------------------
            published: function(id,published){
                var clas = $("#item_"+id+" .statusColumn .statusButton").attr('class').split(' ', 2);
                (clas[1] == 'on') ? published=0 : published=1;
                $.post(panel_name+"news/show/",{type:'published', news_item_id:id, published:published}, function(data) {
                    if(data == 'true'){
                        if(published){
                            $("#item_"+id+" .statusColumn .statusButton").removeClass('off').addClass('on');
                        }else{
                            $("#item_"+id+" .statusColumn .statusButton").removeClass('on').addClass('off');                           
                        }
                    }else{
                        
                    }
                });                
                
            },
            //сохранить новость----------------------------------------------
            save:function(type){
                $("input[name=type]").attr('value', type);
                var news_part1_data = news_part1.getData();
                var news_part2_data = news_part2.getData();
                if($("input[name=news\\[name\\]]").val() != 'Введите название новости'){
                    if(news_redactor.length != 0 && news_redactor2.length != 0){
                        if($('#filelist img')){
                            $("input[name=news\\[preview_text\\]]").val(news_part1_data);
                            $("input[name=news\\[full_text\\]]").val(news_part2_data);
                            $("input[name=news\\[preview_img\\]]").val($('#filelist img').attr('alt'));
                            $("#form").submit(); 
                        }else{
                            $('#fields_with_errors4 #no_img').show()
                        }                               
                    }else{
                        $("#fields_with_errors4").addClass("control-group error");
                        $("#fields_with_errors4 #error").show()
                    }                    
                }else{
                    $("#fields_with_errors1").addClass("control-group error");
                    $("#fields_with_errors1 #error").show();
                }
            },
            upload_img:function(){
                var uploader = new plupload.Uploader({
                    runtimes: 'flash',
                    flash_swf_url: '/admin/js/news/plupload.flash.swf',
                    browse_button: 'pickfiles',
                    container: 'uploader',
                    url: '/admin/js/news/upload.php',
                    max_file_count: 1
                });

                uploader.init();

                uploader.bind('FilesAdded', function(up, files) {
                    if(uploader.files.length <= uploader.settings.max_file_count){//если выбрали изображений не больше чем разрешено
                        $('#upload_error').hide();
                        for (var i in files) {
                            document.getElementById('filelist').innerHTML += '<div id="' + files[i].id + '">' + files[i].name + ' (' + plupload.formatSize(files[i].size) + ') <b></b><a id="remove_img" href="#">отменить</a></div>';
                        }
                        $('#pickfiles').css('display','none');
                        $('#uploadfiles').css('display','block');
                        
                        $('#remove_img').on('click', function(){
                            $.each(uploader.files, function(i, file) {
                                uploader.removeFile(file);
                           });
                           $('#filelist').html(' ');
                           $('#pickfiles').css('display','block');
                           $('#uploadfiles').css('display','none'); 
                          uploader.refresh(); 
                        });

                    }else{
                        uploader.splice();            
                        $('#upload_error').show(); 
                        uploader.refresh();
                    }                   
                });
                
                uploader.bind('UploadProgress', function(up, file) {
                    document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
                });

                uploader.bind('Error', function(up, args) {
                    alert(args.code + ': ' + args.message);
                });

                document.getElementById('uploadfiles').onclick = function() {
                    uploader.start()
                    
                };
                uploader.bind('FileUploaded', function(up, file) {
                    var vars = [], hash;
                    var hashes = window.location.href.slice(window.location.href.indexOf('admin/') + 1).split('/');
                    $.post(panel_name+"news/create/",{type:'add_img',img_name:file['name'], id:hashes[3]}, function(data) {
                        if(data == 'true'){
                            $('#filelist').html('<img  width="320px" alt="'+file['name']+'" src="/i/uploaded/'+file['name']+'" />');         
                            $('#uploadfiles').css('display','none');
                            $('#deletfile').css('display','block');
                            uploader.refresh();        
                        }
                    });
                    
                });
                
                $('#deletfile').on('click', function(){
                    var file_name = $('#filelist img').attr('alt');
                    core_news.delete_img(file_name);     
                    $('#deletfile').css('display','none');
                    $('#pickfiles').css('display','block');
                    $.each(uploader.files, function(i, file) {
                        uploader.removeFile(file);
                   });
                });
                
                
            },
            delete_img:function(img_name,uploader){
                var vars = [], hash;
                var hashes = window.location.href.slice(window.location.href.indexOf('admin/') + 1).split('/');
                $.post(panel_name+"news/create/",{type:'delete_img',img_name:img_name, id:hashes[3]}, function(data) {
                    if(data == 'true'){
                        $('#filelist').html(' '); 
                    }
                });
            },
            //Опубликование/неопубликование категорий новостей----------------------------------------------
            published_cat: function(id,published){
                var clas = $("#item_"+id+" .statusColumn .statusButton").attr('class').split(' ', 2);
                (clas[1] == 'on') ? published=0 : published=1;
                $.post(panel_name+"news/show_news_cats/",{type:'published', news_cat_id:id, published:published}, function(data) {
                    if(data == 'true'){
                        if(published){
                            $("#item_"+id+" .statusColumn .statusButton").removeClass('off').addClass('on');
                        }else{
                            $("#item_"+id+" .statusColumn .statusButton").removeClass('on').addClass('off');                           
                        }
                    }else{
                        
                    }
                });
                
            },            
            //Удаление категории новости-------------------------------------------------------------------
            delete_news_cat: function(id){
                $.post(panel_name+"news/show_news_cats/",{type:'delete_news_cat',news_cat_id:id}, function(data) {
                    if(data = 'true'){
                        $("#item_"+id).fadeOut('slow');
                    }else{
                        
                    }
                });
            },
            //сохранить новость----------------------------------------------
            save_cat:function(){
                $("#form").submit(); 
            },
            //делаем чекбоксы красивыми----------------------------------------------
            checkboxStyle:function(){                
                $('.on_off :checkbox').iphoneStyle();                   
            }
            
};



var core_gallery = {    
    
            //сортировка категорий-------------------------------------------------------------------------
            load_cats_sort:function(){
                $('#sort').dataTable({
                    "aaSorting": [[ 2, "asc" ]]
                } );
            },
            //Опубликование/неопубликование категорий галлереи----------------------------------------------
            published: function(id,published){
                var clas = $("#item_"+id+" .statusColumn .statusButton").attr('class').split(' ', 2);
                (clas[1] == 'on') ? published=0 : published=1;
                $.post(panel_name+"gallery/show/",{type:'published', cat_item_id:id, published:published}, function(data) {
                    if(data == 'true'){
                        if(published){
                            $("#item_"+id+" .statusColumn .statusButton").removeClass('off').addClass('on');
                        }else{
                            $("#item_"+id+" .statusColumn .statusButton").removeClass('on').addClass('off');                           
                        }
                    }else{
                        
                    }
                });                   
                
            },                       
            //Удаление категории галлереи-------------------------------------------------------------------
            delete_cat: function(id){
                $.post(panel_name+"gallery/show/",{type:'delete_cat_item',cat_item_id:id}, function(data) {
                    if(data = 'true'){
                        $("#item_"+id).fadeOut('slow');
                    }else{
                        
                    }
                });
            },
            //Создание категории галлереи-------------------------------------------------------------------
            save_cat:function(){
                if($("input[name=name]").val() != 'Введите название категории'){
                    $("#form").submit();
                }else{
                    $("#fields_with_errors").addClass("control-group error");
                    $("#form #error").show();
                }
            },
            load_gallery_script:function(){
                
//                    'use strict';
                    // Initialize the jQuery File Upload widget:
                    $('#fileupload').fileupload({
                        limitConcurrentUploads:1
                    });

                    // Load existing files:
                        $('#fileupload').each(function () {
                            var that = this;
                            $.getJSON(this.action, function (result) {
                                console.log(result);
                                if (result && result.length) {
                                    $(that).fileupload('option', 'done')
                                        .call(that, null, {result: result});
                                }
                            });
                        });
                
            },
            //делаем чекбоксы красивыми----------------------------------------------
            checkboxStyle:function(){                
                $('.on_off :checkbox').iphoneStyle();                   
            },
            //делаем чекбоксы красивыми----------------------------------------------
            delete_img:function(id,suffix){
                $.post(panel_name+"gallery/show_photos/",{type:'delete_img',id:id,suffix:suffix}, function(data) {
                    if(data = 'true'){
                        $("#item_"+id).fadeOut('slow');
                    }else{
                        
                    }
                });
            }
    
}

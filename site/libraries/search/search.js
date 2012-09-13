$(document).ready(function(){
    
    $('#mdl_search').keyup(function(){
        core_search.start_search(this);
    });
    
});


var core_search = {
    
    start_search:function(input){
        
        var minlength = 3;
        var search_text = $(input).val();
        
        if(search_text.length >= minlength){    
            $('#mdl_dropdown_search').html('<img src="/i/loader.gif" />');
            $('#mdl_dropdown_search').css({'display':'block'});
            $.post("/main/",{type:'search', search_text:search_text}, function(data) {
                
                if(search_text==$(input).val()){
                    if(data){
                        var search_results = '';
                        $.each( data, function(index, value){
                            search_results += value;
                        });
                        $('#mdl_dropdown_search').html(search_results);   
                        $(".mdl_search_results").on("mouseenter", function(){
                            $(this).css({'backgroundColor':'#fbfbfb'});
                        })   
                        $(".mdl_search_results").on("mouseout", function(){
                            $(this).css({'backgroundColor':'white'});
                        })
                    }else{
                        $('#mdl_dropdown_search').html('ничего не найдено');
                    }
                }
                
                $('html').click(function() {
                    $('#mdl_dropdown_search').css({'display':'none'});
                 });
                 $('#mdl_dropdown_search').click(function(event){
                    event.stopPropagation();
                 });
                
            },'json');
            
        }
        
    }
    
}
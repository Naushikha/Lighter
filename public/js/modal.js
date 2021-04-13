function showFrag(title, frag, data='', url=''){
    
    var tmpData = {getFrag: frag};
    if (data != ''){ // If data has been passed
        tmpData = {...tmpData, ...data};
    }
    $.ajax({
        data: tmpData,
        type: "post",
        url : url, 
        success: function(res){
            var res = JSON.parse(res);
            if(res.html){
                $('#modal-content').html(res.html);
                $('#modal-title').html(title);
                $('#modal').show();
            }
        }
    });
}

function modalSetStyle(property, value){
    $('#modal-box').css(property, value);
}

function modalHide(){
    $('#modal').hide();
}
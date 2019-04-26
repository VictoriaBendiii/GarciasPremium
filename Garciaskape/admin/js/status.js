
    $('.acceptbtn').on('click', function(){
        var orderid= $(this).data('id');
                $.get('updatestatus.php?accept=accepted&orderid='+orderid, function(data){
                
                if(parseInt(data)==1){
                    $('#status-'+orderid).html('accepted');
                }else{
                    alert('Status is already accepted!');
                } 
        });
    });
    
    $('.rejectbtn').on('click', function(){
        var orderid= $(this).data('id');
                $.get('updatestatus.php?reject=rejected&orderid='+orderid, function(data){
                    
                if(parseInt(data)==1){
                    $('#status-'+orderid).html('rejected');
                }else{
                    alert('Status is already rejected!');
                }
        });
    });
    


var adminurl = $('#admin_url').val();
$("#add_user_form").on(
    'submit',(function (e) {
        e.preventDefault();
        $("#submit").text('Please wait...');
        $('#submit').attr('disabled',true);
        $.ajax(
            {
                url: $(this).prop('action'), 
                type: "POST",
                data: new FormData(this),
                dataType:'JSON',
                contentType: false,      
                cache: false,       
                processData:false,
                beforeSend: function (xhr) {
                      xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name=csrf-token]').attr("content"));
                },
                async: true,
                success: function (data) {
                    if(data.status==true) {
                        toastr.success(data.message);
                        $('input,textarea').val('');
                        setTimeout(
                            function () {
                                location.reload(); }, 3000
                        );
                    }else{
                        if(data.errortrue==true){
                            for(var error in data.message){
                                toastr.error(data.message[error]);
                            }
                        }else{
                            toastr.error(data.message);
                        }
                    }
                    $('#submit').text('Submit');
                    $('#submit').attr('disabled',false);
                }
            }
        );
    })
);

//Edit user form
$("#edit_user_form").on(
    'submit',(function (e) {
        e.preventDefault();
        $("#update").text('Please wait...');
        $('#update').attr('disabled',true);
        $.ajax(
            {
                url: $(this).prop('action'), 
                type: "POST",
                data: new FormData(this),
                dataType:'JSON',
                contentType: false,      
                cache: false,       
                processData:false,
                beforeSend: function (xhr) {
                      xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name=csrf-token]').attr("content"));
                },
                async: true,
                success: function (data) {
                    if(data.status==true) {
                        toastr.success(data.message);
                        setTimeout(
                            function () {
                                location.reload(); }, 3000
                        );
                    }else{
                        if(data.errortrue==true){
                            for(var error in data.message){
                                toastr.error(data.message[error]);
                            }
                        }else{
                            toastr.error(data.message);
                        }
                    }
                    $('#update').text('Update');
                    $('#update').attr('disabled',false);
                }
            }
        );
    })
);

function deleteUser(id){
    var r = confirm('Are you sure you want to delete this user?');
    if(r){
        $('#delete_user_from_'+id).submit();
    }
}

//Change Status status
function changeStatus(id){
    $('#status_'+id).attr('disabled',true);
    var status = document.getElementById("status_"+id).checked;
    if(status){
        var status_value = '1';
    }else{
        var status_value = '0';
    }
    $.ajax(
        {
            url: adminurl + "/users/changeStatus",
            type: "post",
            beforeSend: function (xhr) {
                xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name=csrf-token]').attr("content"));
            },
            cache: false,
            async: true,
            data: {id:id,status_value:status_value},
            success: function (response) {
                if(response!='') {
                    if(response.status==true) {
                        $('#status_'+id).attr('disabled',false);
                        toastr.success(response.message);
                        setTimeout(
                            function () {
                                location.reload(); }, 2000
                        );
                    }else{
                        if(response.errortrue==true){
                            for(var error in response.message){
                                toastr.error(response.message[error]);
                            }
                        }else{
                            toastr.error(response.message);
                            setTimeout(
                                function () {
                                    location.reload(); }, 2000
                            );
                        }
                    }
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                }
            }
        }
    ); 
}
//Change Status end
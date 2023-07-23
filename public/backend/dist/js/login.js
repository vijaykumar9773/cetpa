$("#admin_login_form").on(
  'submit',function (e) {
    e.preventDefault();
    $('#sign_in').html('Please wait...');
    $('#sign_in').attr('disabled',true);
    $.ajax(
      {
        method:"POST",
        url:$(this).prop('action'),
        data:new FormData(this),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function (data) {
          if (data.status=='false') {
            if(data.errortrue==true){
              for(var error in data.message){
                toastr.error(data.message[error]);
              }
            }else{
              toastr.error(data.message);
            }
          } else {
            window.location = data;
          }
          $('#sign_in').html('Sign In');
          $('#sign_in').attr('disabled',false);
        }
      }
    );
  }
);
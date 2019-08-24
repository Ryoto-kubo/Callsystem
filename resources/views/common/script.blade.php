<!-- <script>
$('#post_form').on('submit', function(event){
    event.preventDefault();

    //送信ボタンの二度押し禁止
    const form_submit = $('#form-submit');
    form_submit.prop("disabled", true);
        
    var fd = new FormData($('#post_form').get(0));

    let jqxhr = $.ajax({
            type: 'POST',
            url: '/reception/confirm',
            data: fd,
            processData: false,
            contentType: false,
            dataType: 'json',
            timeout: 15000,
            success: function(response){
                if(response.success)
                {   
                    console.log(response);
                    alert('受け付けました');
                    $('#post_form')[0].reset();
                    window.location.href = "/";
                } else {
                    var $error_msg = response.messages;
                    alert('失敗しました');
                    console.log(response);
                    if($error_msg.peoples){
                        $('.js-error-msg-peoples').text($error_msg.peoples);
                    } else {
                        $('.js-error-msg-peoples').text("");
                    }

                    if($error_msg.tell_number){
                        $('.js-error-msg-tell_number').text($error_msg.tell_number);
                    } else {
                        $('.js-error-msg-tell_number').text("");
                    }

                }
            },
            error: function(response){
                console.log(response);
                alert('サーバエラーが発生しました');
            }
        });
        jqxhr.always(function() {
            form_submit.prop("disabled", false);
        });
    });
</script> -->
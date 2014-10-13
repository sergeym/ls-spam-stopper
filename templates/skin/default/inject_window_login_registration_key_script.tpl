<script>
    jQuery(function($){

        var req=null;

        $('#popup-registration-form #popup-registration-login, form#registration-form #registration-login').keyup(function() {
            if (!req) {
                var submitBtn = $(this).parents('form').find('[name="submit_register"]');

                submitBtn.attr('disabled', 'disabled');

                req = ls.ajax(aRouter.spamstopper+'ajaxgetkey', { } , function(result) {
                    $('#popup-registration-form input[name="_name"], form#registration-form input[name="_name"]').each(function(i,el){
                        $(el).attr('name', result.name);
                        $(el).attr('value', result.value);
                        submitBtn.removeAttr('disabled');
                    });
                });
            }
        });
    });
</script>
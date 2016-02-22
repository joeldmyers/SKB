jQuery(document).ready( function (){
	jQuery('.ninja-forms-req').addClass('required');
});

// override jquery validate plugin defaults
jQuery.validator.setDefaults({
    highlight: function(element) {
        jQuery(element).closest('.form-group').addClass('has-error');
    },
    unhighlight: function(element) {
        jQuery(element).closest('.form-group').removeClass('has-error');
    },
    errorElement: 'div',
    errorClass: 'alert alert-danger',
    errorPlacement: function(error, element) {
		error.insertBefore(element);
    }
});
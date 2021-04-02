$(function(){
    $("#edit_form").validate({
        rules: {
            txtName: "required",
            txtCode: "required"
        }
    });
});
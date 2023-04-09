$(document).ready(function() {
    var formDelete = $('#form_delete')
    var buttonFormDelete = $('#button_form_delete')

    buttonFormDelete.click(function(event) {
        event.preventDefault()
        formDelete.submit()
    })
});

$(document).ready(function(){
    $("#exampleModalCenter").on("hidden.bs.modal", function () {
        let form = document.getElementById('addUpdateProductForm');
        
        form.querySelectorAll('input, textarea, select').forEach(el => {
            if (el.type === 'checkbox' || el.type === 'radio') {
                el.checked = false;
            }else{
                el.value = '';
            }
        });
        $('.show-uploaded-image').remove();
    });

    $(document).on('click', '#addUpdateProductBtn', function(e) {               
        e.preventDefault();

        let form = document.getElementById('addUpdateProductForm');
        let formData = new FormData(form);
        var url = $('#addUpdateProductForm').data('url');

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#exampleModalCenter').modal('hide');
                $('#product_listing_table').html(response.data);
                $('#successAlert').removeClass('d-none').find('strong').text(response.message);
            },
            error: function(xhr) {
                alert(xhr.responseText.message ?? 'Something went wrong');
            }
        });
    });

    $(document).on('click', '.edit-product', function(){
        var productEditUrl = $(this).data('url');
        
        $.ajax({
            url: productEditUrl,
            type: "GET",
            success: function(response) {
                $('#addUpdateProductFormModal').html(response.data);
                let modal = new bootstrap.Modal('#exampleModalCenter');
                modal.show();
            },
            error: function(xhr) {
                alert(xhr.responseText.message ?? 'Something went wrong');
            }
        });
    });

    $(document).on('click', '.delete-product', function(){
        var productDeleteUrl = $(this).data('url');

        $.ajax({
            url: productDeleteUrl,
            data: {
                "_token": csrfToken
            },
            type: "DELETE",
            success: function(response) {
                $('#product_listing_table').html(response.data);
                $('#successAlert').removeClass('d-none').find('strong').text(response.message);
            },
            error: function(xhr) {
                alert(xhr.responseText.message ?? 'Something went wrong');
            }
        });
    });
});
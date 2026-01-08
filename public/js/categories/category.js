$(document).ready(function(){
    $("#exampleModalCenter").on("hidden.bs.modal", function () {
        let form = document.getElementById('addUpdateCategoryForm');
        
        form.querySelectorAll('input').forEach(el => {
            el.value = '';
        });
    });

    $(document).on('click', '#addUpdateCategoryBtn', function(e) {               
        e.preventDefault();

        let form = document.getElementById('addUpdateCategoryForm');
        let formData = new FormData(form);
        var url = $('#addUpdateCategoryForm').data('url');

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#exampleModalCenter').modal('hide');
                $('#category_listing_table').html(response.data);
                $('#successAlert').removeClass('d-none').find('strong').text(response.message);
            },
            error: function(xhr) {
                alert(xhr.responseText.message ?? 'Something went wrong');
            }
        });
    });

    $(document).on('click', '.edit-category', function(){
        var categoryEditUrl = $(this).data('url');
        
        $.ajax({
            url: categoryEditUrl,
            type: "GET",
            success: function(response) {
                $('#addUpdateCategoryFormModal').html(response.data);
                let modal = new bootstrap.Modal('#exampleModalCenter');
                modal.show();
            },
            error: function(xhr) {
                alert(xhr.responseText.message ?? 'Something went wrong');
            }
        });
    });

    $(document).on('click', '.delete-category', function(){
        var categoryDeleteUrl = $(this).data('url');

        $.ajax({
            url: categoryDeleteUrl,
            data: {
                "_token": csrfToken
            },
            type: "DELETE",
            success: function(response) {
                $('#category_listing_table').html(response.data);
                $('#successAlert').removeClass('d-none').find('strong').text(response.message);
            },
            error: function(xhr) {
                alert(xhr.responseText.message ?? 'Something went wrong');
            }
        });
    });
});
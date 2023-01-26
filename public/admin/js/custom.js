$(document).ready(function () {

    //CALL DATATABLE CLASS
    $('#sections').DataTable();
    $('#categories').DataTable();
    $('#products').DataTable();

    $(".nav-item").removeClass("active");
    $(".nav-link").removeClass("active");
    //CHECK ADMIN PASSWORD IS CORRECT OR NOT
    $("#current_password").keyup(function () {
        var current_password = $("#current_password").val();
        // alert(current_password);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/check-admin-password',
            data: { current_password: current_password },
            success: function (resp) {
                if (resp == "true") {
                    $("#check_password").html("<font color='green'> Current Password is Correct!</font>");
                } else if (resp == "false") {
                    $("#check_password").html("<font color='red'> Current Password is Incorrect!</font>");
                }
            },
            error: function () {
                alert(error);
            },
        });
    })

    //UPDATE ADMIN STATUS

    $(document).on("click", ".updateAdminStatus", function () {
        var status = $(this).children("i").attr("status");
        var admin_id = $(this).attr("admin_id");
        alert(admin_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-admin-status',
            data: { status: status, admin_id: admin_id },
            success: function (resp) {
                // alert(resp);
                if (resp['status'] == 0) {
                    $("#admin-" + admin_id).html("<i style='font-size: 25px' class='mdi mdi-bookmark-outline' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    $("#admin-" + admin_id).html("<i style='font-size: 25px' class='mdi mdi-bookmark-check' status='Active'></i>");
                }
            },
            error: function () {
                alert('ERROR');
            }
        })
    });

    //UPDATE SECTION STATUS
    $(document).on("click", ".updateSectionStatus", function () {
        var status = $(this).children("i").attr("status");
        var section_id = $(this).attr("section_id");
        alert(section_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-section-status',
            data: { status: status, section_id: section_id },
            success: function (resp) {
                // alert(resp);
                if (resp['status'] == 0) {
                    $("#section-" + section_id).html("<i style='font-size: 25px' class='mdi mdi-bookmark-outline' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    $("#section-" + section_id).html("<i style='font-size: 25px' class='mdi mdi-bookmark-check' status='Active'></i>");
                }
            },
            error: function () {
                alert('ERROR');
            }
        })
    });

    //CONFIRM DELETE(SIMPLE JAVASCRIPT)
    // $(".confirmDelete").click(function(){
    //     $title = $(this).attr("title");
    //     if(confirm("Are you sure to delete this "+$title+"?")){
    //         return true;
    //     }else{
    //         return false;
    //     }
    // });

    // CONFIRM DELETE (SWWET ALERT)
    $(".confirmDelete").click(function () {
        var module = $(this).attr('module');
        var moduleid = $(this).attr('moduleid');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )

                window.location = "/admin/delete-" + module + "/" + moduleid;
            }
        })

    });

    //UPDATE CATEGORY STATUS
    $(document).on("click", ".updateCategoryStatus", function () {
        var status = $(this).children("i").attr("status");
        var category_id = $(this).attr("category_id");
        alert(category_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-category-status',
            data: { status: status, category_id: category_id },
            success: function (resp) {
                // alert(resp);
                if (resp['status'] == 0) {
                    $("#category-" + category_id).html("<i style='font-size: 25px' class='mdi mdi-bookmark-outline' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    $("#category-" + category_id).html("<i style='font-size: 25px' class='mdi mdi-bookmark-check' status='Active'></i>");
                }
            },
            error: function () {
                alert('ERROR');
            }
        })
    });

    $("#section_id").change(function () {
        var section_id = $(this).val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "get",
            url: "/admin/append-categories-level",
            data: { section_id: section_id },
            success: function (resp) {
                $("#appendCategoriesLevel").html(resp);
            },
            error: function () {
                alert("Error");
            }

        })
    });

    //UPDATE Brand STATUS
    $(document).on("click", ".updateBrandStatus", function () {
        var status = $(this).children("i").attr("status");
        var brand_id = $(this).attr("brand_id");
        alert(brand_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-brand-status',
            data: { status: status, brand_id: brand_id },
            success: function (resp) {
                // alert(resp);
                if (resp['status'] == 0) {
                    $("#brand-" + brand_id).html("<i style='font-size: 25px' class='mdi mdi-bookmark-outline' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    $("#brand-" + brand_id).html("<i style='font-size: 25px' class='mdi mdi-bookmark-check' status='Active'></i>");
                }
            },
            error: function () {
                alert('ERROR');
            }
        })
    });

    //UPDATE PRODUCT STATUS
    $(document).on("click", ".updateProductStatus", function () {
        var status = $(this).children("i").attr("status");
        var product_id = $(this).attr("product_id");
        alert(product_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '/admin/update-product-status',
            data: { status: status, product_id: product_id },
            success: function (resp) {
                // alert(resp);
                if (resp['status'] == 0) {
                    $("#product-" + product_id).html("<i style='font-size: 25px' class='mdi mdi-bookmark-outline' status='Inactive'></i>");
                } else if (resp['status'] == 1) {
                    $("#product-" + product_id).html("<i style='font-size: 25px' class='mdi mdi-bookmark-check' status='Active'></i>");
                }
            },
            error: function () {
                alert('ERROR');
            }
        })
    });
});
/*!
    * Start Bootstrap - SB Admin v6.0.2 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2020 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    (function($) {
    "use strict";

    // Add active state to sidbar nav links
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
        $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function() {
            if (this.href === path) {
                $(this).addClass("active");
            }
        });

    // Toggle the side navigation
    $("#sidebarToggle").on("click", function(e) {
        e.preventDefault();
        $("body").toggleClass("sb-sidenav-toggled");
    });

    $(".gallery_picture").change(function (){
        readMultipleImage(this);
    });

    $(".file-upload input[type='file']").change(function (){
       readUrl(this);
    });

    function readMultipleImage(input){
        var length = input.files.length;
        $(input).next(".preview_gallery_picture").html("");
        for(var i = 0; i < length; ++i){
            if(input.files[i] && input.files){
                var reader = new FileReader();
                reader.onload = function (e){
                    var src = e.target.result;
                    var image = '<img src=" '+ src +' " width="300" class="image_preview">';
                    $(input).after(image);
                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    }

    function readUrl(input){
        if(input.files[0]){
            var reader = new FileReader();
            reader.onload = function (e){
                $(".preview-img img").attr("src", e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

   $(".checkbox").change(function (){
       if( $(this).prop("checked") ){
           $("#uncheck").val("active");
       }else{
           $("#uncheck").val("inactive");
       }
   });

    $(".checkbox-all").on('click', function (){
        $(this).parents('.role-permissions').find(".checkbox-permission").prop("checked", $(this).prop("checked"));
    });


/*---- Select 2 ----*/
    $(".single-select").select2();
    $(".multiple-select").select2({
        tags: true,
        tokenSeparators: [',', ' ']
    });

/*---- Delete record with sweetalert2 ----*/
    function deleteRecord(event){
        event.preventDefault();
        let _this = $(this);
        let url = $(this).data('url');
        Swal.fire({
            title: 'Xác nhận xóa dữ liệu',
            text: "Dữ liệu được xóa sẽ không lấy lại được!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Xác nhận',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'GET',
                    url: url,

                    success: function (data){
                        if(data.code === 200){
                            _this.parent().parent().parent().remove();
                        }
                        Swal.fire(
                            'Đã xóa!',
                            'Dữ liệu đã xóa thành công.',
                            'thành công'
                        )
                    },

                    error: function (data){

                    }
                })
            }
        })
    }
    $(document).on("click",".delete-button", deleteRecord);

    setTimeout(function() {
        $(".alert").alert('close');
    }, 2000);

    $(document).on('click', '.remove-invoice', removeInvoice);
    function removeInvoice(e) {
        $(this).parents('.invoice-group').remove();

        if ( $('.invoice-group').length === 1 ) {
            $('.header-invoice .remove-invoice').remove();
        }
    }

    $(document).on("click", ".add-new-pd-for-invoice", addNewProductForInvoice);
    function addNewProductForInvoice(event) {
        const _length = $(".invoice-group").length + 1;
        const typeProductToAdd = $(this).data('type');
        let productEle = '';

        if ( typeProductToAdd === 'old' ) {
            productEle = `<div class="col-lg-3 mb-20">\n` +
                `           <div class="form-group">\n` +
                `               <label for="" class="mb-1 font-weight-bold">Sản phẩm</label>\n` +
                `               <select class="form-control select-product" name="product_id[]"></select>\n` +
                `           </div>\n` +
                `          </div>`;
        } else {
            productEle = `<div class="col-lg-3 mb-20">\n` +
                `           <div class="form-group">\n` +
                `               <label for="" class="mb-1 font-weight-bold">Tên sản phẩm</label>\n` +
                `               <input type="text" class="form-control" name="name[]">\n` +
                `           </div>\n` +
                `          </div>`;
        }

        const ele = `<div class="invoice-group my-4 d-flex flex-column">\n` +
        `                        <div class="d-flex justify-content-between header-invoice">\n` +
        `                            <h4 class="font-weight-bold mb-2 text-uppercase">Sản phẩm `+_length+`</h4>\n` +
        `                        </div>\n` +
        `                        <div class="card p-3">\n` +
        `                            <div class="row">\n` +
        `                                <div class="col-lg-3 mb-20">\n` +
        `                                    <div class="form-group">\n` +
        `                                        <label for="" class="mb-1 font-weight-bold">Nhà cung cấp</label>\n` +
        `                                        <select class="form-control add-new-partner select-partner" name="partner_id[]">` +
        `                                           <option value=" ">Chọn Nhà Cung Cấp</option>` +
        `                                        </select>\n` +
        `                                    </div>\n` +
        `                                </div>\n` +
        `                                ${productEle}\n` +
        `                                <div class="col-lg-3 mb-20">\n` +
        `                                    <div class="form-group">\n` +
        `                                        <label for="" class="mb-1 font-weight-bold">Số lượng</label>\n` +
        `                                        <input type="number" name="amount[]" class="form-control">\n` +
        `                                    </div>\n` +
        `                                </div>\n` +
        `                                <div class="col-lg-3 mb-20">\n` +
        `                                    <div class="form-group">\n` +
        `                                        <label for="" class="mb-1 font-weight-bold">Giá nhập</label>\n` +
        `                                        <input type="text" name="price[]" class="form-control">\n` +
        `                                    </div>\n` +
        `                                </div>\n` +
        `                            </div>\n` +
        `                        </div>\n` +
        `                    </div>`;

        const lastInvoiceGroupElement = $(".invoice-group").last();
        $(ele).insertAfter(lastInvoiceGroupElement);
        const _url = "http://localhost/admin/invoices/get-product-categories";
        const lastPartnerSelect = $('select.add-new-partner').last();

        if ( $('.header-invoice').length === 2 ) {
            $('<span><i class="fa fa-trash remove-invoice"></i></span>').appendTo($('.header-invoice'));
        } else {
            $('<span><i class="fa fa-trash remove-invoice"></i></span>').appendTo($('.header-invoice').last());
        }

        $.ajax({
            url: _url,
            success: (data) => {
                const productCategories = data.data;
                productCategories.forEach(function (item) {
                    $("<option />").val(item.id).text(item.name).appendTo(lastPartnerSelect);
                })
            }
        })
    }

    $(document).on('change', '.select-partner', partnerSelection);
    function partnerSelection(e) {
        const partnerID = $(this).val();
        const _url = `http://localhost/admin/invoices/get-product/${partnerID}`;
        const productSelect = $(this).parents('.card').find('select.select-product');
        if ( productSelect.length > 0 ) {
            productSelect.html("");
            $.ajax({
                url: _url,
                type: "GET",
                success: (data) => {
                    data.products.forEach(function (item){
                        $("<option />").val(item.id).text(item.name).appendTo(productSelect);
                    })
                },

                error: (err) => {
                    productSelect.html("");
                }
            })
        }
    }
})(jQuery);

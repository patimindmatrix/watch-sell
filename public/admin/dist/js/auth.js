(function($) {
    /*---- Login Ajax ----*/
   $("form#login-form").submit(function (e){
       e.preventDefault();
       let url = $(this).data('url');
       let formData = new FormData(this);

       $.ajax({
           url: url,
           type: "POST",
           data: formData,

           beforeSend: function (){
               $(".overlay-snipper").addClass("open");
           },

           success: function (data){
                if(data.code === 200){
                    window.location = "http://localhost/admin/user";
                }
           },

           error: function (error){
               if(error.code === 500){
                   alert(error.message);
               }
           },

           complete: function (){
               $(".overlay-snipper").removeClass("open");
           },

           contentType: false,
           cache: false,
           processData: false,

       });
   })
})(jQuery);

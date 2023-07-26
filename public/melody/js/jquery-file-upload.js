(function ($) {
  'use strict';
  if ($("#fileuploader").length) {
    $("#fileuploader").uploadFile({
      url: "/upload/product/{{$product->id}}/image",
      fileName: "image",
    });
    console.log($("#fileuploader"));
  }
})(jQuery);
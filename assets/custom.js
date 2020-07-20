jQuery(document).ready(function($){
    $(".owl-carousel").each(function (index, element) {
        $(element).owlCarousel( $(element).data('params'));    
    });
});
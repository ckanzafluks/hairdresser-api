jQuery(document).ready(function() {
    "use strict";

    /*=================== Price Tabs Z-Index ===================*/  
    $(".price-tabs.style2").closest('.block').css({"z-index":2});


    /*=================== Responsive Menu Button ===================*/  
    $(".responsive-menu-btn").on("click",function(){
        $(".responsive-header > ul").toggleClass("slidein");
        return false;
    });

    $("html").on("click",function(){
        $(".responsive-header > ul").removeClass("slidein");
    });
    $(".responsive-menu-btn,.responsive-header > ul").on("click",function(e){
        e.stopPropagation();
    });
    $(".responsive-header > ul ul").parent().addClass("menu-item-has-children");
    $(".responsive-header ul li.menu-item-has-children > a").on("click",function(){
        $(this).next("ul").slideToggle();
        $(this).parent().siblings().find("ul").slideUp();
        return false;
    });



    /*=================== Search Toggle ===================*/  
    $(".search-btn").on("click",function(){
        $(this).parent().find("form").fadeToggle();
        $(this).toggleClass("opened");
        return false;
    });



    /*=================== Sideheader Functions ===================*/  
    $(".sidemenu-btn").on("click",function(){
        $(this).parent().toggleClass("slidein");
        return false;
    });
    $(".sidemenu > ul ul").parent().addClass("menu-item-has-children");
    $(".sidemenu ul li.menu-item-has-children > a").on("click",function(){
        $(this).next("ul").slideToggle()
        $(this).parent().siblings().find("ul").slideUp();
        $(this).parent().siblings().removeClass("active");        
        $(this).parent().toggleClass("active");
        return false;
    });

    $('.sidemenu').enscroll({
    showOnHover: false,
    verticalTrackClass: 'track3',
    verticalHandleClass: 'handle3'
    });

    /*=================== Selectors ===================*/  
    $('.variety-selector > a , .spa-gallery-selectors > a').on('click',function(){
    	$(this).addClass("active").siblings().removeClass('active');
    });


    /*=================== Fancy Review Slide ===================*/  
    $(".fancy-review-slide").each(function(){
        $(".fancy-review").on("mouseenter",function(){
            $(this).siblings().removeClass("active");
            $(this).addClass("active");
        });
    });



    /*=================== Tab Selectors ===================*/  
    $(".tabs-selectors > a, .gallery-selectors > a, .lemon-product-selectors > a").on('click',function(){
        $(this).siblings().removeClass("active");
        $(this).addClass("active");
    });  


    /*=================== Price List ===================*/  
    var list = $('.price-slide > ul li') 
    $('.price-slide > ul').each(function(){
        var delay = 0;
        $(this).find(list).each(function(){
        $(this).css({transitionDelay: delay+'ms'});
        delay += 50;
        });
    });  


    /*=================== LightBox ===================*/  
    $(function() {
        var foo = $('.lightbox');
        foo.poptrox({
            usePopupCaption: true
        });
    });



    /*================== Map =====================*/
    function initialize() {
    var myLatlng = new google.maps.LatLng(51.5015588, -0.1276913);
    var mapOptions = {
    zoom: 14,
    disableDefaultUI: true,
    scrollwheel:false,
    center: myLatlng
    }
    var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

    var image = '';
    var myLatLng = new google.maps.LatLng(51.5015588, -0.1276913);
    var beachMarker = new google.maps.Marker({
      position: myLatLng,
      map: map,
      icon: image
    });

    }
    google.maps.event.addDomListener(window, 'load', initialize);

}); /*=== Document.Ready Ends Here ===*/




jQuery(window).load(function() {
    $('.parallax').scrolly({bgParallax: true});

    /*=================== Price Tab Height ===================*/  
    setTimeout(function(){
        var price_tab_height = $(".price-tabs").innerHeight();
        $(".tabs-selectors").css({
            "width":price_tab_height
        });
    },2000);

    
}); /*=== Document.Ready Ends Here ===*/

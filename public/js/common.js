equalheight = function(container){

    var currentTallest = 0,
        currentRowStart = 0,
        rowDivs = new Array(),
        $el,
        topPosition = 0;
    $(container).each(function() {
        $el = $(this);
        $($el).height('auto');
        topPostion = $el.position().top;

        if (currentRowStart != topPostion) {
            for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
                rowDivs[currentDiv].height(currentTallest);
            }
            rowDivs.length = 0; // empty the array
            currentRowStart = topPostion;
            currentTallest = $el.height();
            rowDivs.push($el);
        } else {
            rowDivs.push($el);
            currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
        }
        for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
            rowDivs[currentDiv].height(currentTallest);
        }
    });
};

/*Якорь меню*/
// Cache selectors
var lastId,
    topMenu = $(".main-menu"),
    topMenuHeight = topMenu.outerHeight(),
// All list items
    menuItems = topMenu.find("a"),
// Anchors corresponding to menu items
    scrollItems = menuItems.map(function(){
        var item = $($(this).attr("href"));
        if (item.length) { return item; }
    });

// Bind click handler to menu items
// so we can get a fancy scroll animation
menuItems.click(function(e){
    var href = $(this).attr("href"),
        offsetTop = href === "#" ? 0 : $(href).offset().top - 40;
    $('html, body').stop().animate({
        scrollTop: offsetTop
    }, 1200);
    e.preventDefault();
});

// Bind to scroll
$(window).scroll(function(){
    // Get container scroll position
    var fromTop = $(this).scrollTop()+topMenuHeight;

    // Get id of current scroll item
    var cur = scrollItems.map(function(){
        if ($(this).offset().top < fromTop)
            return this;
    });
    // Get the id of the current element
    cur = cur[cur.length-1];
    var id = cur && cur.length ? cur[0].id : "";

    if (lastId !== id) {
        lastId = id;
        // Set/remove active class
        menuItems
            .parent().removeClass("active")
            .end().filter("[href='#"+id+"']").parent().addClass("active");
    }
});

function equalBlocks(){
    if($(window).width() > 991){
        equalheight('.product-item__container.two-items .product-item__description');
        equalheight('.product-item__container.two-items .title-rubric');
    }else{
        $(".product-item__container.two-items .product-item__description, .product-item__container.two-items .title-rubric").css("height", "auto")
    }

    if($(window).width() > 570){
        equalheight('.product-item__container.two-items .product-item');
    }else{
        $(".product-item__container.two-items .product-item").css("height", "auto")
    }
}
equalBlocks();

function mobileMenu(){
    if($(window).width() > 991){
        $(".main-menu li a").click(function () {
            $(this).parent().parent().slideUp(300);
            $(".toggle_mnu, body").removeClass("active");
        })
    }else{}
}
mobileMenu();

$(window).resize(function() {
    equalBlocks();
    mobileMenu();
});

$(window).on("load", function (e) {
    equalBlocks();
    mobileMenu();
});

$(document).ready(function() {
    equalBlocks();
    mobileMenu();

    $('input[name="phone"]').inputmask({mask: '+38 999 999-99-99', showMaskOnHover: false});

    $(".for_form").each(function(){
        var self = this;
        $(this).validate({
            submitHandler: function(form) {
                var thisForm =$(form);
                $.ajax({
                    type: "POST",
                    url: "mail.php",
                    data: thisForm.serialize()
                }).done(function() {
                    $(self).find(":not(input[type=submit])").val("");
                    $.magnificPopup.open({
                        items: {
                            src: '#thanks'
                        },
                        type: 'inline'
                    });
                    setTimeout(function() {
                        $.magnificPopup.close();
                    }, 3000);
                });
                return false;
            }
        });
    });

    $(".gradient-button input").mouseover(function(){
        $(this).parent().find(".container-shadow").addClass("active")
    });
    $(".gradient-button input").mouseout(function(){
        $(this).parent().find(".container-shadow").removeClass("active")
    });

    $(".banner-callback").magnificPopup({
        type: 'inline'
    });

    $(".toggle_mnu").click(function() {
        $(".toggle_mnu, body").toggleClass("active");
        $(".main-menu").slideToggle(300);
    });
});
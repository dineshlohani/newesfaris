if (typeof jQuery === "undefined") {
    throw new Error("jQuery plugins need to be before this file");
}

$.Admin = {};
$.Admin.options = {
    colors: {
        red: '#F44336',
        pink: '#E91E63',
        purple: '#9C27B0',
        deepPurple: '#673AB7',
        indigo: '#3F51B5',
        blue: '#2196F3',
        lightBlue: '#03A9F4',
        cyan: '#00BCD4',
        teal: '#009688',
        green: '#4CAF50',
        lightGreen: '#8BC34A',
        lime: '#CDDC39',
        yellow: '#ffe821',
        amber: '#FFC107',
        orange: '#FF9800',
        deepOrange: '#FF5722',
        brown: '#795548',
        grey: '#9E9E9E',
        blueGrey: '#607D8B',
        black: '#000000',
        white: '#ffffff'
    },
    leftSideBar: {
        scrollColor: 'rgba(0,0,0,0.5)',
        scrollWidth: '4px',
        scrollAlwaysVisible: false,
        scrollBorderRadius: '0',
        scrollRailBorderRadius: '0',
        scrollActiveItemWhenPageLoad: true,
        breakpointWidth: 1170
    },

}

$.Admin.leftSideBar = {
    activate: function () {
        var _this = this;
        var $body = $('body');
        var $overlay = $('.overlay');

        //Collapse or Expand Menu
        $('.menu-toggle').on('click', function (e) {
            var $this = $(this);
            var $content = $this.next();

            if ($($this.parents('ul')[0]).hasClass('list')) {
                var $not = $(e.target).hasClass('menu-toggle') ? e.target : $(e.target).parents('.menu-toggle');

                $.each($('.menu-toggle.toggled').not($not).next(), function (i, val) {
                    if ($(val).is(':visible')) {
                        $(val).prev().toggleClass('toggled');
                        $(val).slideUp();
                    }
                });
            }
            $this.toggleClass('toggled');
            $content.slideToggle(320);
        });


    },

    checkStatusForResize: function (firstTime) {
        var $body = $('body');
        var $openCloseBar = $('.navbar .bars');
        var width = $body.width();

        if (firstTime) {
            $body.find(' .sidebar').addClass('no-animate').delay(1000).queue(function () {
                $(this).removeClass('no-animate').dequeue();
            });
        }
        if (width < $.Admin.options.leftSideBar.breakpointWidth) {
            $body.addClass('ls-closed');
            $openCloseBar.fadeIn();
        }

    },
    isOpen: function () {
        return $('body').hasClass('overlay-open');
    }
};
$(function () {
    // $.Admin.leftSideBar.activate();
    // $.Admin.leftSideBar.checkStatusForResize();
    var $body = $('body');
    var $openCloseBar = $('.navbar .bars');
    var width = $body.width();


    closebutton = $('.close_button');
    openbutton = $('.open_button');

    function toggleSidebar() {
        $(".button").toggleClass("active");
        $body.toggleClass('ls-closed');

        $.ajax({
            url: "/users/change_sidebar_status/",
            beforeSend: function( xhr ) {
                xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
            }
        })
            .done(function( data ) {
                // if ( console && console.log ) {
                //   console.log(data);
                // }
            });
    }

    openbutton.on('click tap',function(){
        toggleSidebar();

    });

    closebutton.on('click tap',function(){
        toggleSidebar();

    });

    $(document).keyup(function(e) {
        if (e.keyCode === 27) {
            toggleSidebar();
        }

    });
});
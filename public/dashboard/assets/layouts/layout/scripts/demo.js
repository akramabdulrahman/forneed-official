/**
Demo script to handle the theme demo
**/
var Demo = function() {

    // Handle Theme Settings
    var handleTheme = function() {

        var panel = $('.theme-panel');

        if ($('body').hasClass('page-boxed') === false) {
            $('.layout-option', panel).val("fluid");
        }

        $('.sidebar-option', panel).val("default");
        $('.pages-header-option', panel).val("fixed");
        $('.pages-footer-option', panel).val("default");
        if ($('.sidebar-pos-option').attr("disabled") === false) {
            $('.sidebar-pos-option', panel).val(App.isRTL() ? 'right' : 'left');
        }

        //handle theme layout
        var resetLayout = function() {
            $("body").
            removeClass("page-boxed").
            removeClass("page-footer-fixed").
            removeClass("page-sidebar-fixed").
            removeClass("page-header-fixed").
            removeClass("page-sidebar-reversed");

            $('.pages-header > .pages-header-inner').removeClass("container");

            if ($('.pages-container').parent(".container").size() === 1) {
                $('.pages-container').insertAfter('body > .clearfix');
            }

            if ($('.pages-footer > .container').size() === 1) {
                $('.pages-footer').html($('.pages-footer > .container').html());
            } else if ($('.pages-footer').parent(".container").size() === 1) {
                $('.pages-footer').insertAfter('.pages-container');
                $('.scroll-to-top').insertAfter('.pages-footer');
            }

             $(".top-menu > .navbar-nav > li.dropdown").removeClass("dropdown-dark");

            $('body > .container').remove();
        };

        var lastSelectedLayout = '';

        var setLayout = function() {

            var layoutOption = $('.layout-option', panel).val();
            var sidebarOption = $('.sidebar-option', panel).val();
            var headerOption = $('.pages-header-option', panel).val();
            var footerOption = $('.pages-footer-option', panel).val();
            var sidebarPosOption = $('.sidebar-pos-option', panel).val();
            var sidebarStyleOption = $('.sidebar-style-option', panel).val();
            var sidebarMenuOption = $('.sidebar-menu-option', panel).val();
            var headerTopDropdownStyle = $('.pages-header-top-dropdown-style-option', panel).val();

            if (sidebarOption == "fixed" && headerOption == "default") {
                alert('Default Header with Fixed Sidebar option is not supported. Proceed with Fixed Header with Fixed Sidebar.');
                $('.pages-header-option', panel).val("fixed");
                $('.sidebar-option', panel).val("fixed");
                sidebarOption = 'fixed';
                headerOption = 'fixed';
            }

            resetLayout(); // reset layout to default state

            if (layoutOption === "boxed") {
                $("body").addClass("page-boxed");

                // set header
                $('.pages-header > .pages-header-inner').addClass("container");
                var cont = $('body > .clearfix').after('<div class="container"></div>');

                // set content
                $('.pages-container').appendTo('body > .container');

                // set footer
                if (footerOption === 'fixed') {
                    $('.pages-footer').html('<div class="container">' + $('.pages-footer').html() + '</div>');
                } else {
                    $('.pages-footer').appendTo('body > .container');
                }
            }

            if (lastSelectedLayout != layoutOption) {
                //layout changed, run responsive handler: 
                App.runResizeHandlers();
            }
            lastSelectedLayout = layoutOption;

            //header
            if (headerOption === 'fixed') {
                $("body").addClass("page-header-fixed");
                $(".pages-header").removeClass("navbar-static-top").addClass("navbar-fixed-top");
            } else {
                $("body").removeClass("page-header-fixed");
                $(".pages-header").removeClass("navbar-fixed-top").addClass("navbar-static-top");
            }

            //sidebar
            if ($('body').hasClass('page-full-width') === false) {
                if (sidebarOption === 'fixed') {
                    $("body").addClass("page-sidebar-fixed");
                    $("pages-sidebar-menu").addClass("pages-sidebar-menu-fixed");
                    $("pages-sidebar-menu").removeClass("pages-sidebar-menu-default");
                    Layout.initFixedSidebarHoverEffect();
                } else {
                    $("body").removeClass("page-sidebar-fixed");
                    $("pages-sidebar-menu").addClass("pages-sidebar-menu-default");
                    $("pages-sidebar-menu").removeClass("pages-sidebar-menu-fixed");
                    $('.pages-sidebar-menu').unbind('mouseenter').unbind('mouseleave');
                }
            }

            // top dropdown style
            if (headerTopDropdownStyle === 'dark') {
                $(".top-menu > .navbar-nav > li.dropdown").addClass("dropdown-dark");
            } else {
                $(".top-menu > .navbar-nav > li.dropdown").removeClass("dropdown-dark");
            }

            //footer 
            if (footerOption === 'fixed') {
                $("body").addClass("page-footer-fixed");
            } else {
                $("body").removeClass("page-footer-fixed");
            }

            //sidebar style
            if (sidebarStyleOption === 'light') {
                $(".pages-sidebar-menu").addClass("page-sidebar-menu-light");
            } else {
                $(".pages-sidebar-menu").removeClass("page-sidebar-menu-light");
            }

            //sidebar menu 
            if (sidebarMenuOption === 'hover') {
                if (sidebarOption == 'fixed') {
                    $('.sidebar-menu-option', panel).val("accordion");
                    alert("Hover Sidebar Menu is not compatible with Fixed Sidebar Mode. Select Default Sidebar Mode Instead.");
                } else {
                    $(".pages-sidebar-menu").addClass("page-sidebar-menu-hover-submenu");
                }
            } else {
                $(".pages-sidebar-menu").removeClass("page-sidebar-menu-hover-submenu");
            }

            //sidebar position
            if (App.isRTL()) {
                if (sidebarPosOption === 'left') {
                    $("body").addClass("page-sidebar-reversed");
                    $('#frontend-link').tooltip('destroy').tooltip({
                        placement: 'right'
                    });
                } else {
                    $("body").removeClass("page-sidebar-reversed");
                    $('#frontend-link').tooltip('destroy').tooltip({
                        placement: 'left'
                    });
                }
            } else {
                if (sidebarPosOption === 'right') {
                    $("body").addClass("page-sidebar-reversed");
                    $('#frontend-link').tooltip('destroy').tooltip({
                        placement: 'left'
                    });
                } else {
                    $("body").removeClass("page-sidebar-reversed");
                    $('#frontend-link').tooltip('destroy').tooltip({
                        placement: 'right'
                    });
                }
            }

            Layout.fixContentHeight(); // fix content height            
            Layout.initFixedSidebar(); // reinitialize fixed sidebar
        };

        // handle theme colors
        var setColor = function(color) {
            var color_ = (App.isRTL() ? color + '-rtl' : color);
            $('#style_color').attr("href", Layout.getLayoutCssPath() + 'themes/' + color_ + ".min.css");
            if (color == 'light2') {
                $('.pages-logo img').attr('src', Layout.getLayoutImgPath() + 'logo-invert.png');
            } else {
                $('.pages-logo img').attr('src', Layout.getLayoutImgPath() + 'logo.png');
            }
        };

        $('.toggler', panel).click(function() {
            $('.toggler').hide();
            $('.toggler-close').show();
            $('.theme-panel > .theme-options').show();
        });

        $('.toggler-close', panel).click(function() {
            $('.toggler').show();
            $('.toggler-close').hide();
            $('.theme-panel > .theme-options').hide();
        });

        $('.theme-colors > ul > li', panel).click(function() {
            var color = $(this).attr("data-style");
            setColor(color);
            $('ul > li', panel).removeClass("current");
            $(this).addClass("current");
        });

        // set default theme options:

        if ($("body").hasClass("page-boxed")) {
            $('.layout-option', panel).val("boxed");
        }

        if ($("body").hasClass("page-sidebar-fixed")) {
            $('.sidebar-option', panel).val("fixed");
        }

        if ($("body").hasClass("page-header-fixed")) {
            $('.pages-header-option', panel).val("fixed");
        }

        if ($("body").hasClass("page-footer-fixed")) {
            $('.pages-footer-option', panel).val("fixed");
        }

        if ($("body").hasClass("page-sidebar-reversed")) {
            $('.sidebar-pos-option', panel).val("right");
        }

        if ($(".pages-sidebar-menu").hasClass("page-sidebar-menu-light")) {
            $('.sidebar-style-option', panel).val("light");
        }

        if ($(".pages-sidebar-menu").hasClass("page-sidebar-menu-hover-submenu")) {
            $('.sidebar-menu-option', panel).val("hover");
        }

        var sidebarOption = $('.sidebar-option', panel).val();
        var headerOption = $('.pages-header-option', panel).val();
        var footerOption = $('.pages-footer-option', panel).val();
        var sidebarPosOption = $('.sidebar-pos-option', panel).val();
        var sidebarStyleOption = $('.sidebar-style-option', panel).val();
        var sidebarMenuOption = $('.sidebar-menu-option', panel).val();

        $('.layout-option, .pages-header-option, .pages-header-top-dropdown-style-option, .sidebar-option, .pages-footer-option, .sidebar-pos-option, .sidebar-style-option, .sidebar-menu-option', panel).change(setLayout);
    };

    // handle theme style
    var setThemeStyle = function(style) {
        var file = (style === 'rounded' ? 'components-rounded' : 'components');
        file = (App.isRTL() ? file + '-rtl' : file);

        $('#style_components').attr("href", App.getGlobalCssPath() + file + ".min.css");

        if (typeof Cookies !== "undefined") {
            Cookies.set('layout-style-option', style);
        }
    };

    return {

        //main function to initiate the theme
        init: function() {
            // handles style customer tool
            handleTheme(); 
            
            // handle layout style change
            $('.theme-panel .layout-style-option').change(function() {
                 setThemeStyle($(this).val());
            });

            // set layout style from cookie
            if (typeof Cookies !== "undefined" && Cookies.get('layout-style-option') === 'rounded') {
                setThemeStyle(Cookies.get('layout-style-option'));
                $('.theme-panel .layout-style-option').val(Cookies.get('layout-style-option'));
            }            
        }
    };

}();

if (App.isAngularJsApp() === false) {
    jQuery(document).ready(function() {    
       Demo.init(); // init metronic core componets
    });
}
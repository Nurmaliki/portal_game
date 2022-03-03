(function($) {

	"use strict";

	var $html = $("html");

    var isMobile = {
        Android: function() {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function() {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function() {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function() {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function() {
            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
        }
    };

    var global_functions = {
    	init: function() {
    		var self = this;

            self.partials();
            self.animejs();
    	},

        partials: function() {
            function tradeMark() {
                if (navigator.userAgent.toLowerCase().indexOf("chrome") > -1) {
                    var t = ["\n %c Made with ♥︎ by Codigo %c %c %c http://codigo.id/ %c \n\n", "color: #fff; background: #b0976d; padding: 5px 0;", "background: #494949; padding:5px 0;", "background: #494949; padding: 5px 0;", "color: #fff; background: #1c1c1c; padding: 5px 0;", "background: #fff; padding: 5px 0;"];
                    window.console.log.apply(console, t)
                } else window.console && window.console.log("Made with love ♥ by Codigo - http://codigo.id/")
            }
            
            tradeMark();
        },

        animejs: function() {
            var logo = anime({
                targets:'.main-logo', 
                opacity: {
                    value: 1,
                    duration: 5000,
                }
            });

            var assets6 = anime({
                targets:'.assets6', 
                opacity: {
                    value: 1,
                    duration: 5000,
                }
            });

            var assets2 = anime({
                targets:'.assets2', 
                opacity: {
                    value: 1,
                    duration: 5000,
                }
            });

            var assets1 = anime({
                targets: '.assets1',
                translateY: {
                    value: 5,
                    duration: 1000,
                },
                opacity: {
                    value: 0.4,
                    duration: 1000,
                },
                easing: 'easeInOutQuad',
                delay: 200,
            });

            var assets3 = anime({
                targets: '.assets3',
                translateX: {
                    value: 100,
                    duration: 800,
                },
                opacity: {
                    value: 1,
                    duration: 800,
                },
                easing: 'easeInOutQuad',
                delay: 300,
            }); 

            var assets4 = anime({
                targets: '.assets4',
                translateX: {
                    value: -100,
                    duration: 800,
                },
                opacity: {
                    value: 1,
                    duration: 800,
                },
                easing: 'easeInOutQuad',
                delay: 400,
            }); 

            var assets5 = anime({
                targets: '.assets5',
                scale: {
                    value:1.1,
                },
                opacity: {
                    value: 1,
                    duration: 800,
                },
                easing: 'easeInOutQuad',
                delay: 400,
            }); 
        }
    };

    $(document).ready(function() {
        global_functions.init();
    });

})(jQuery);

jQuery(document).ready(function(t){function n(){t(".center-content li").each(function(){var n=t(this).attr("id");"tab-content"==n&&t(this).remove()})}function e(){(t(window).width()<=375||t(window).width()>375&&t(window).width()<=780)&&(n(),t(".center-content li").each(function(){var n=t(this).attr("id");"tab-content"==n&&t(this).remove()}),t(".center-content li").each(function(){var n=t(this).hasClass("active");if(n){var e=t(this).attr("id");if("first"==e){t("#first").after("<li id='tab-content'></li>");var i=t("#content0").clone().show();t("#tab-content").append(i)}else if("second"==e){t("#second").after("<li id='tab-content'></li>");var i=t("#content1").clone().show();t("#tab-content").append(i)}else if("third"==e){t("#third").after("<li id='tab-content'></li>");var i=t("#content2").clone().show();t("#tab-content").append(i)}else{t("#fourth").after("<li id='tab-content'></li>");var i=t("#content3").clone().show();t("#tab-content").append(i)}}c()}))}function i(){var n="<div id='toggle-content-container' style='position:relative;display:none'></div>",e="<div id='toggle-content' style='position:absolute;z-index:3;text-align:right;width:100%;background:rgba(255,255,255, 0.85)'></div>",i=t("#block-racctheme-main-menu ul").clone().removeClass("dropdown").addClass("vertical").attr("id","toggleMenu");t(".row-header").after(n),t("#toggle-content-container").append(e),t("#toggle-content").append(i)}function o(){t("#toggle-content-container").remove()}function c(){var n=t(".right-side img").width(),e=t(".right-side img").height();t(".transparent-layer").css({width:n,height:e}),t(".up").css({height:e})}(t(window).width()<=375||t(window).width()>375&&t(window).width()<=780)&&(i(),c(),t("#toggleMenu li").hover(function(){t(this).css({background:"#FFFFFF"})},function(){t(this).css({background:"none"})}),t("#toggleMenu li a").css({color:"#000000","font-weight":"500"})),t(window).resize(function(){t(window).width()<=375||t(window).width()>375&&t(window).width()<=780?(o(),c(),t(".right-side").hide(),t(".center-content li").each(function(){var n=t(this).hasClass("active");if(n){var i=t(this).attr("id");t("#"+i).trigger("click")}t(".center-content li").click(function(){e()})}),i(),t("#toggleMenu li").hover(function(){t(this).css({background:"#FFFFFF"})},function(){t(this).css({background:"none"})}),t("#toggleMenu li a").css({color:"#000000","font-weight":"500"})):(n(),c(),t(".center-content li").each(function(){var n=t(this).hasClass("active");if(n){var e=t(this).attr("id");t("#"+e).trigger("click")}}),o())}),t("#toggle").click(function(){t("#toggle-content-container").toggle("slow")});var a=t('<div class="slick-img-overlay">');t(".slide__media").append(a);var r=t(".right-side");r.attr("id",function(t){return"content"+t}),t("#first").addClass("active"),t(window).width()<=375||t(window).width()>375&&t(window).width()<=780?(t("#first").trigger("click"),t(".right-side").hide()):(t("#content0").show(),t("#content1").hide(),t("#content2").hide(),t("#content3").hide()),t("#first").click(function(){t(window).width()>780&&(t("#content0").show(),t("#content1").hide(),t("#content2").hide(),t("#content3").hide()),e(),t("#tab-content").not(":last").remove(),t(".center-content li").removeClass("active"),t("#first").addClass("active"),t(".center-content li").trigger("mouseenter")}),t("#second").click(function(){t(window).width()>780&&(t("#content0").hide(),t("#content1").show(),t("#content2").hide(),t("#content3").hide()),e(),t("#tab-content").not(":last").remove(),t(".center-content li").removeClass("active"),t("#second").addClass("active"),t(".center-content li").trigger("mouseenter")}),t("#third").click(function(){t(window).width()>780&&(t("#content0").hide(),t("#content1").hide(),t("#content2").show(),t("#content3").hide()),e(),t("#tab-content").not(":last").remove(),t(".center-content li").removeClass("active"),t("#third").addClass("active"),t(".center-content li").trigger("mouseenter")}),t("#fourth").click(function(){t(window).width()>780&&(t("#content0").hide(),t("#content1").hide(),t("#content2").hide(),t("#content3").show()),e(),t("#tab-content").not(":last").remove(),t(".center-content li").removeClass("active"),t("#fourth").addClass("active"),t(".center-content li").trigger("mouseenter")}),t(".center-content li a").click(function(n){n.preventDefault(),t(this).parent().trigger("click")}),(t(window).width()<=375||t(window).width()>375&&t(window).width()<=780)&&t(".center-content li").click(function(){e()}),t(".center-content li").mouseenter(function(){var n=t(this).hasClass("active");n&&t(".up div").addClass("transparent-layer")}).mouseleave(function(){var n=t(this).hasClass("active");n&&t(".up div").removeClass("transparent-layer")}),t(".search-link").click(function(){t("#myModal").css({display:"block"})}),t(".close").click(function(){t("#myModal").css({display:"none"})}),t(".second-nav li:last-child").click(function(n){n.preventDefault(),t("#myModal").css({display:"block"})})});
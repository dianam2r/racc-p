jQuery(document).ready(function($){

  if(($(window).width() <= 375) || ($(window).width() > 375 && $(window).width() <= 780) ) {
    addToggle();
    resizeTransparentLayer();
    // And some style to it, since dynamic content can't get styled with defined classes
      $("#toggleMenu li").hover(
        function(){
          $(this).css({'background':'#FFFFFF'})
        },
        function(){
          $(this).css({'background':'none'})
        });
      $("#toggleMenu li a").css({
        "color":"#000000",
        "font-weight":"500"
      });
      /* End */
  }

  $(window).resize(function(){
    if(($(window).width() <= 375) || ($(window).width() > 375 && $(window).width() <= 780)){
      removeToggle();
      resizeTransparentLayer();
      $(".right-side").hide();
      $(".center-content li").each(function(){
        var flag = $(this).hasClass("active");
        if(flag){
          var id = $(this).attr("id")
          $("#"+id).trigger("click");
        }
        $(".center-content li").click(function(){
          addContent();
        });
      });
      // Toggle when rezising the window
      addToggle();
      $("#toggleMenu li").hover(
        function(){
          $(this).css({'background':'#FFFFFF'})
        },
        function(){
          $(this).css({'background':'none'})
        });
      $("#toggleMenu li a").css({
        "color":"#000000",
        "font-weight":"500"
      });
    }else {
      cleanMenuTab();
      resizeTransparentLayer();
      $(".center-content li").each(function(){
        var flag = $(this).hasClass("active");
        if(flag){
          var id = $(this).attr("id")
          $("#"+id).trigger("click");
        }
      });
      removeToggle();
    }
  });

  /* This adds the toggle event when clicking the burguer label */
  $("#toggle").click(function(){
    $("#toggle-content-container").toggle("slow");
  });
    // And some style to it, since dynamic content can't get styled with defined classes
/*  $("#toggleMenu li").hover(
    function(){
      $(this).css({'background':'#FFFFFF'})
    },
    function(){
      $(this).css({'background':'none'})
    });
  $("#toggleMenu li a").css({
    "color":"#000000",
    "font-weight":"500"
  });*/
  /* End */

  /* This add the overlay (transparent degrade layer) effect to the slider */
  var overlay = $('<div class="slick-img-overlay">')
  $(".slide__media").append(overlay);
  /* End */

  /* Asign an id to every content on side-block */
  var div = $(".right-side");
  div.attr("id",function(index){
    return 'content'+index;
  });

  /* Default behavior when the page just loads , always show the first content */
  $("#first").addClass("active");
  if(($(window).width() <= 375) || ($(window).width() > 375 && $(window).width() <= 780) ){
    $("#first").trigger("click");
    $(".right-side").hide();
  }else{
    $("#content0").show();
    $("#content1").hide();
    $("#content2").hide();
    $("#content3").hide();
  }

  /* Events for when clicking each of the options in the left section of the horizontal block */

  $("#first").click(function(){
    if($(window).width() > 780){
    $("#content0").show();
    $("#content1").hide();
    $("#content2").hide();
    $("#content3").hide();
    }
    addContent();
    $("#tab-content").not(':last').remove();
    $(".center-content li").removeClass("active");
    $("#first").addClass("active");
    $(".center-content li").trigger("mouseenter");
  });

  $("#second").click(function(){
    if($(window).width() > 780){
    $("#content0").hide();
    $("#content1").show();
    $("#content2").hide();
    $("#content3").hide();
    }
    addContent();
    $("#tab-content").not(':last').remove();
    $(".center-content li").removeClass("active");
    $("#second").addClass("active");
    $(".center-content li").trigger("mouseenter");
  });

  $("#third").click(function(){
    if($(window).width() > 780){
    $("#content0").hide();
    $("#content1").hide();
    $("#content2").show();
    $("#content3").hide();
    }
    addContent();
    $("#tab-content").not(':last').remove();
    $(".center-content li").removeClass("active");
    $("#third").addClass("active");
    $(".center-content li").trigger("mouseenter");
  });

  $("#fourth").click(function(){
    if($(window).width() > 780){
    $("#content0").hide();
    $("#content1").hide();
    $("#content2").hide();
    $("#content3").show();
    }
    addContent();
    $("#tab-content").not(':last').remove();
    $(".center-content li").removeClass("active");
    $("#fourth").addClass("active");
    $(".center-content li").trigger("mouseenter");
  });

  /* End */

  /* When instead of clicking the area surrounding the link the user clicks the link instead */
  $(".center-content li a").click(function(event){
    event.preventDefault();
    $(this).parent().trigger('click');
  });
  if(($(window).width() <= 375) || ($(window).width() > 375 && $(window).width() <= 780) ){
    $(".center-content li").click(function(){
      addContent();
    });
  }

  /* End */

  /* This part adds a class that sets a transparent background over the side block picture */
  $(".center-content li").mouseenter(function(){
    var flag = $(this).hasClass("active");
    if(flag){
      $(".up div").addClass("transparent-layer");
    }
  })
  .mouseleave(function(){
    var flag = $(this).hasClass("active");
    if(flag){
      $(".up div").removeClass("transparent-layer");
    }
  });
  /* End */

  /* Functions */

    function cleanMenuTab(){
      $(".center-content li").each(function(){
        var id = $(this).attr("id");
        if(id == "tab-content"){
          $(this).remove();
        }
      });
    }

    function addContent(){
      if(($(window).width() <= 375) || ($(window).width() > 375 && $(window).width() <= 780) ){
        cleanMenuTab();
        $(".center-content li").each(function(){
          var id = $(this).attr("id");
          if(id == "tab-content"){
            $(this).remove();
          }
        });
        $(".center-content li").each(function(){
          var flag = $(this).hasClass("active");
          if(flag){
            var name = $(this).attr("id");
            if(name == "first"){
              $("#first").after("<li id='tab-content'></li>");
              var content = $("#content0").clone().show();
              $("#tab-content").append(content);
            }else if(name == "second"){
              $("#second").after("<li id='tab-content'></li>");
              var content = $("#content1").clone().show();
              $("#tab-content").append(content);
            }else if(name == "third"){
              $("#third").after("<li id='tab-content'></li>");
              var content = $("#content2").clone().show();
              $("#tab-content").append(content);
            }else {
              $("#fourth").after("<li id='tab-content'></li>");
              var content = $("#content3").clone().show();
              $("#tab-content").append(content);
            }
          }
          resizeTransparentLayer();
        });
      }
    }

    function addToggle(){//margin-left:64.1%;
      var divToggleContainer = "<div id='toggle-content-container' style='position:relative;display:none'></div>";
      var divToggle = "<div id='toggle-content' style='position:absolute;z-index:3;text-align:right;width:100%;background:rgba(255,255,255, 0.85)'></div>";
      var menu = $("#block-racctheme-main-menu ul").clone().removeClass('dropdown').addClass('vertical').attr("id","toggleMenu");
      $(".row-header").after(divToggleContainer);
      $("#toggle-content-container").append(divToggle);
      $("#toggle-content").append(menu);
    }

    function removeToggle(){
      $("#toggle-content-container").remove();
    }

    function resizeTransparentLayer(){
      var imageWidth = $(".right-side img").width();
      var imageHeight = $(".right-side img").height();
      $(".transparent-layer").css({
        'width' : imageWidth,
        'height' : imageHeight
      });
      $(".up").css({
        'height': imageHeight
      });
    }
  /* End */

  /* This is the pop up event - Search - */
  $(".search-link").click(function(){
    $("#myModal").css({
      "display":"block"
    });
  });

  $(".close").click(function() {
    $("#myModal").css({
      "display":"none"
    });
  });

  $(".second-nav li:last-child").click(function(event){
    event.preventDefault();
    $("#myModal").css({
      "display":"block"
    });
  });
  /* End */

});

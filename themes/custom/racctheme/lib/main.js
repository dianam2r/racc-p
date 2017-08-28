jQuery(document).ready(function($){
  $(".side-block .left-side h2 a").click(function(){
    show_content($(this).index());
  });

  show_content(0);

  function show_content(){
    $(".side-block .right-side.visible").removeClass("visible");
    $(".side-block .right-side:nth-of-type("+(index + 1)+")").addClass("visible");

    $(".side-block .left-side h2 a.selected").removeClass("selected");
    $(".side-block .left-side h2 a:nth-of-type("+(index + 1)+")").addClass("selected");
  }
});

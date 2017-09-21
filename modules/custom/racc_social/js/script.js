/**
 * @file
 * This is the script to insert ajax response.
 */

jQuery(document).ready(function ($) {
  /* This is to upload the contents of the get-connected block */
  $.ajax({
    url: 'http://dev-racc-p.pantheonsite.io/racc_social_posts',
    type: 'GET',
    success: function (data) {
      $('.center-loading').hide();
      $(".get-connected").html(data);
    },
    error: function (e) {
      alert('Error: ' + e);
    }
  });
  /* End */
});

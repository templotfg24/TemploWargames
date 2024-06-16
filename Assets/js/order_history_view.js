// order_history_view.js

$(document).ready(function() {
    $(".order-header").click(function() {
      $(this).next(".order-details").toggle();
    });
  });
  
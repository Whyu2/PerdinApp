(function($) {
  "use strict"; // Start of use strict

  // Toggle the side navigation
  $("#sidebarToggle, #sidebarToggleTop").on('click', function(e) {
    $("body").toggleClass("sidebar-toggled");
    $(".sidebar").toggleClass("toggled");
    if ($(".sidebar").hasClass("toggled")) {
      $('.sidebar .collapse').collapse('hide');
    };
  });

  // Close any open menu accordions when window is resized below 768px
  $(window).resize(function() {
    if ($(window).width() < 768) {
      $('.sidebar .collapse').collapse('hide');
    };
    
    // Toggle the side navigation when window is resized below 480px
    if ($(window).width() < 480 && !$(".sidebar").hasClass("toggled")) {
      $("body").addClass("sidebar-toggled");
      $(".sidebar").addClass("toggled");
      $('.sidebar .collapse').collapse('hide');
    };
  });

  // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
  $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(e) {
    if ($(window).width() > 768) {
      var e0 = e.originalEvent,
        delta = e0.wheelDelta || -e0.detail;
      this.scrollTop += (delta < 0 ? 1 : -1) * 30;
      e.preventDefault();
    }
  });

  // Scroll to top button appear
  $(document).on('scroll', function() {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  });

  // Smooth scrolling using jQuery easing
  $(document).on('click', 'a.scroll-to-top', function(e) {
    var $anchor = $(this);
    $('html, body').stop().animate({
      scrollTop: ($($anchor.attr('href')).offset().top)
    }, 1000, 'easeInOutExpo');
    e.preventDefault();
  });

   $('#example').DataTable();

    $('#datepicker').datepicker({
        format: 'yyyy-mm-dd'
    });    
    $('#datepicker2').datepicker({
      format: 'yyyy-mm-dd'
  });    
 
    
      $(document).on('click','.delete_btn_user',function(){
        var id_user = $(this).val();
        $('#DeleteModalUser').modal('show');
        $('#id_delete').val(id_user);
      });
      $(document).on('click','.delete_btn_kota',function(){
        var id_kota = $(this).val();
        $('#DeleteModalKota').modal('show');
        $('#id_delete').val(id_kota);
      });
      ClassicEditor
      .create( document.querySelector( '#editor' ) )
      .catch( error => {
          console.error( error );
      } );

     var table = $('#example2').DataTable({
    autoWidth: false,
    columns : [
        { width : '1px' },
        { width : '75px' },
        { width : '150px' },
        { width : '100px' },        
        { width : '50px' },
        { width : '50px' }        
    ] 
});
 
})(jQuery); // End of use strict

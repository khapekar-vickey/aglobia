/**
 * Theme functions file.
 *
 * Contains handlers for navigation and widget area.
 */

jQuery(function($){
  "use strict";
    $('.menu > ul').superfish({
      delay:       500,                            
      animation:   {opacity:'show',height:'show'},  
      speed:       'fast'                         
    });

    $('.search-box span i').click(function(){
      $(".serach_outer").toggle();
    });
});

/* Mobile responsive Menu*/

function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}

// jQuery(function($){

//     $(window).scroll(function(){
//       var scrollTop = $(window).scrollTop();
//       if( scrollTop > 100 ){
//         $('.menubar').addClass('scrolled');
//       }else{
//         $('.menubar').removeClass('scrolled');
//       }
//         $('.main-header').css('background-position', 'center ' + (scrollTop / 2) + 'px');
//     });

//  });
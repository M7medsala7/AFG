(function($) {
$.fn.menumaker = function(options) {  
var cssmenu = $(this), settings = $.extend({
format: "dropdown",
sticky: false
}, options);
return this.each(function() {
$(this).find(".button").on('click', function(){
$(this).toggleClass('menu-opened');
var mainmenu = $(this).next('ul');
if (mainmenu.hasClass('open')) { 
mainmenu.slideToggle().removeClass('open');
}
else {
mainmenu.slideToggle().addClass('open');
if (settings.format === "dropdown") {
mainmenu.find('ul').show();
}
}
});
cssmenu.find('li ul').parent().addClass('has-sub');
multiTg = function() {
cssmenu.find(".has-sub").prepend('<span class="submenu-button"></span>');
cssmenu.find('.submenu-button').on('click', function() {
$(this).toggleClass('submenu-opened');
if ($(this).siblings('ul').hasClass('open')) {
$(this).siblings('ul').removeClass('open').slideToggle();
}
else {
$(this).siblings('ul').addClass('open').slideToggle();
}
});
};
if (settings.format === 'multitoggle') multiTg();
else cssmenu.addClass('dropdown');
if (settings.sticky === true) cssmenu.css('position', 'fixed');
resizeFix = function() {
var mediasize = 991;
if ($(window).width(991) <= mediasize) {
cssmenu.find('ul').show();
}
if ($(window).width() <= mediasize) {
cssmenu.find('ul').hide().removeClass('open');
}
};
resizeFix();
return $(window).on('resize', resizeFix);
});
};
})(jQuery);

(function($){
$(document).ready(function(){
$("#cssmenu").menumaker({
format: "multitoggle"
});
});
})(jQuery);



$('#cssmenu > ul > li > a').click(function(){
$('#cssmenu > ul > li > a').removeClass("active");
$(this).addClass("active");
});



$('.pager li>a').click(function(){
$('.pager li>a').removeClass("active");
$(this).addClass("active");
});



$( document ).ready(function() {


$(window).scroll(function() {
if ($(this).scrollTop() > 1){  
$('.header').addClass("sticky");
}
else{
if ($(this).scrollTop() < 1){ 
$('.header').removeClass("sticky");
}}
});

$(window).scroll(function() {
if ($(this).scrollTop() > 200){  
$('.boxicon').addClass("sticky").css("left",15);
}
else{
$('.boxicon').removeClass("sticky").css("left",-50);
}
});


$(".ellips").click(function(){
$(".navlink").slideDown();
$(".ellips").hide();
$(".ftimes").show();
});

$(".ftimes").click(function(){
$(".navlink").slideUp();
$(".ellips").show();
$(".ftimes").hide();
});

$(window).load(function()
{
$(".load-5 .spinner").fadeOut(3000,
function(){
$(this).parent().fadeOut(4000,
function(){
$("body").css("overflow","auto");
$(this).remove();
});
});	 
});
///Loading animations

$(".overlaytru").fadeIn(
function(){
$("body").css("overflow","hidden");
});




$(".skiplink").click(function(){
$(this).next(".hidecountries").slideToggle(500);
});









 



$(window).scroll(function(){
if ($(this).scrollTop() > 600) {
$('.scrollToTop').fadeIn();
} else {
$('.scrollToTop').fadeOut();
}
});
//Click event to scroll to top
$('.scrollToTop').click(function(){
$('html, body').animate({scrollTop : 0},800);
return false;
});


});	

var blank="http://upload.wikimedia.org/wikipedia/commons/c/c0/Blank.gif";
function readURL(input) {
if (input.files && input.files[0]) {
var reader = new FileReader();

reader.onload = function (e) {
$('.img_prev')
.attr('src', e.target.result)
.height(250);
};
reader.readAsDataURL(input.files[0]);
}
else {
var img = input.value;
$('.img_prev').attr('src',img).height(254);
}
}


$(function() {
 
    $('#step-1-next').click(function() {
        // Check values here
        var isValid = true;
        
        if(isValid) {
            $('.nav-tabs > li:nth-of-type(2) > a').removeClass('disabled').click();
			$(".nav-tabs > li:nth-of-type(2) strong").css("color","#009df4");
			$(".tabscand > li:nth-of-type(2) i").css("background","#009df4");
			$(".tabscand > li:nth-of-type(2) span").css("background","#009df4").css("color","#fff");
          }
      });
	
	
	 $('#step-1-back').click(function() {
         var isValid = true;
         if(isValid) {
            $('.nav-tabs > li:nth-of-type(1) > a').removeClass('enable').click();
			$(".nav-tabs > li:nth-of-type(2) strong").css("color","#fff");
			$(".tabscand > li:nth-of-type(2) i").css("background","#fff");
			$(".tabscand > li:nth-of-type(2) span").css("background","#fff").css("color","#000");

         }
	     });
	
	
    $('#step-2-next').click(function() {
        // Check values here
        var isValid = true;
        
        if(isValid) {
            $('.nav-tabs > li:nth-of-type(3) > a').removeClass('disabled').click();
			$(".nav-tabs > li:nth-of-type(3) strong").css("color","#009df4");
			$(".tabscand > li:nth-of-type(3) i").css("background","#009df4");
			$(".tabscand > li:nth-of-type(3) span").css("background","#009df4").css("color","#fff");
        }
    });
	
	  $('#skip-next').click(function() {
        // Check values here
        var isValid = true;
        
        if(isValid) {
            $('.nav-tabs > li:nth-of-type(3) > a').removeClass('disabled').click();
        }
		 

    });
	
	
	
	 $('#step-2-back').click(function() {
         var isValid = true;
         if(isValid) {
            $('.nav-tabs > li:nth-of-type(2) > a').removeClass('enable').click();
			$(".nav-tabs > li:nth-of-type(3) strong").css("color","#fff");
			$(".tabscand > li:nth-of-type(3) i").css("background","#fff");
			$(".tabscand > li:nth-of-type(3) span").css("background","#fff").css("color","#000");
        }
      });
  	
    $('#step-3-next').click(function() {
        // Check values here
        var isValid = true;
        
        if(isValid) {
            $('.nav-tabs > li:nth-of-type(4) > a').removeClass('disabled').click();
        }
    });
	
	   $('#step-3-back').click(function() {
        // Check values here
        var isValid = true;
       $('.nav-tabs > li:nth-of-type(3) > a').removeClass('enable').click();

    });
	
	
 	
	 $('#step-4-next').click(function() {
        // Check values here
        var isValid = true;
        
        if(isValid) {
            $('.nav-tabs > li:nth-of-type(5) > a').removeClass('disabled').click();
        }
    });
	
	
	   $('#step-4-back').click(function() {
        // Check values here
        var isValid = true;
       $('.nav-tabs > li:nth-of-type(4) > a').removeClass('enable').click();

    });
	
	
	
	 $('#step-5-next').click(function() {
        // Check values here
        var isValid = true;
        
        if(isValid) {
            $('.nav-tabs > li:nth-of-type(6) > a').removeClass('disabled').click();
        }
    });
	
	
	   $('#step-5-back').click(function() {
        // Check values here
        var isValid = true;
       $('.nav-tabs > li:nth-of-type(5) > a').removeClass('enable').click();

    });
	
	
	
		 $('#step-6-next').click(function() {
        // Check values here
        var isValid = true;
        
        if(isValid) {
            $('.nav-tabs > li:nth-of-type(7) > a').removeClass('disabled').click();
        }
    });
	
 	 });
	 
	 
 	 
	 
	 
	 
	 
	 
	 $(function() {
 
    $('#maid-1-next').click(function() {
        // Check values here
        var isValid = true;
        
        if(isValid) {
            $('.create-maid > li:nth-of-type(2) > a').removeClass('disabled').click();
			$(".create-maid > li:nth-of-type(2) strong").css("color","#009df4");
			$(".create-maid > li:nth-of-type(2) i").css("background","#009df4");
           }
      });
	
	
	 $('#maid-1-back').click(function() {
         var isValid = true;
         if(isValid) {
            $('.create-maid > li:nth-of-type(1) > a').removeClass('enable').click();
			$(".create-maid > li:nth-of-type(2) strong").css("color","#9c9c9c");
			$(".create-maid > li:nth-of-type(2) i").css("background","#9c9c9c");
          }
	     });
	
	
    $('#maid-2-next').click(function() {
        // Check values here
        var isValid = true;
        
        if(isValid) {
            $('.create-maid > li:nth-of-type(3) > a').removeClass('disabled').click();
			$(".create-maid > li:nth-of-type(3) strong").css("color","#009df4");
			$(".create-maid > li:nth-of-type(3) i").css("background","#009df4");
         }
    });
	
	  $('#maid-next').click(function() {
         var isValid = true;
         if(isValid) {
         $('.create-maid > li:nth-of-type(3) > a').removeClass('disabled').click();
        }
     });
	
	
	
	 $('#maid-2-back').click(function() {
         var isValid = true;
         if(isValid) {
            $('.create-maid > li:nth-of-type(2) > a').removeClass('enable').click();
			$(".create-maid > li:nth-of-type(3) strong").css("color","#9c9c9c");
			$(".create-maid > li:nth-of-type(3) i").css("background","#9c9c9c");
         }
      });
  	
    $('#maid-3-next').click(function() {
        // Check values here
        var isValid = true;
        
        if(isValid) {
            $('.create-maid > li:nth-of-type(4) > a').removeClass('disabled').click();
			$(".create-maid > li:nth-of-type(4) strong").css("color","#009df4");
			$(".create-maid > li:nth-of-type(4) i").css("background","#009df4");
        }
    });
	
	   $('#maid-3-back').click(function() {
        // Check values here
        var isValid = true;
       $('.create-maid > li:nth-of-type(3) > a').removeClass('enable').click();
	   $(".create-maid > li:nth-of-type(4) strong").css("color","#9c9c9c");
	   $(".create-maid > li:nth-of-type(4) i").css("background","#9c9c9c");

    });
 
 	 });
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	function bs_input_file() {
$(".input-file").before(
function() {
if ( ! $(this).prev().hasClass('input-ghost') ) {
var element = $("<input type='file' class='input-ghost' style='visibility:hidden; height:0'>");
element.attr("name",$(this).attr("name"));
element.change(function(){
element.next(element).find('input').val((element.val()).split('\\').pop());
});
$(this).find("button.btn-choose").click(function(){
element.click();
});
$(this).find("button.btn-reset").click(function(){
element.val(null);
$(this).parents(".input-file").find('input').val('');
});
$(this).find('input').css("cursor","pointer");
$(this).find('input').mousedown(function() {
$(this).parents('.input-file').prev().click();
return false;
});
return element;
}
}
);
}
$(function() {
bs_input_file();
});
 
	 
	 
	 
	 
	 
	 

$(document).ready(function() {

   $('.checkboxall').change(function(){
    $('.disabled').attr('disabled', this.checked);
  });
  
    $('.checkboxalltow').change(function(){
    $('.disabledtow').attr('disabled', this.checked);
  });

    $('.checkboxallthree').change(function(){
    $('.disabledthree').attr('disabled', this.checked);
  });

     $('.checkboxallfor').change(function(){
    $('.disabledfor').attr('disabled', this.checked);
  });

// $('.calendar').daterangepicker({
// "singleDatePicker": true,
// "showDropdowns": true,
// "startDate": "04/30/2018",
// "endDate": "05/06/2018"
// }, function(start, end, label) {
// console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
// });




var jobCount = $('#list .in').length;
$('.list-count').text(jobCount + ' items');


$("#search-text").keyup(function () {
//$(this).addClass('hidden');

var searchTerm = $("#search-text").val();
var listItem = $('#list').children('li');


var searchSplit = searchTerm.replace(/ /g, "'):containsi('")

//extends :contains to be case insensitive
$.extend($.expr[':'], {
'containsi': function(elem, i, match, array)
{
return (elem.textContent || elem.innerText || '').toLowerCase()
.indexOf((match[3] || "").toLowerCase()) >= 0;
}
});


$("#list li").not(":containsi('" + searchSplit + "')").each(function(e)   {
$(this).addClass('hiding out').removeClass('in');
setTimeout(function() {
$('.out').addClass('hidden');
}, 300);
});

$("#list li:containsi('" + searchSplit + "')").each(function(e) {
$(this).removeClass('hidden out').addClass('in');
setTimeout(function() {
$('.in').removeClass('hiding');
}, 1);
});


var jobCount = $('#list .in').length;
$('.list-count').text(jobCount + ' items');

//shows empty state text when no jobs found
if(jobCount == '0') {
$('#list').addClass('empty');
}
else {
$('#list').removeClass('empty');
}

});



/*     /*  
An extra! This function implements
jQuery autocomplete in the searchbox.
Uncomment to use :)<!--  -->*/


function searchList() {                
//array of list items
var listArray = [];

$("#list li").each(function() {
var listText = $(this).text().trim();
listArray.push(listText);
});

// $('#search-text').autocomplete({
// source: listArray
// });


}
		   
searchList();

 
});
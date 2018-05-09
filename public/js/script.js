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



$('.your-stud').slick({
dots: true,
infinite: true,
speed: 2000,
slidesToShow:1,
slidesToScroll: 1,
autoplay: true,
autoplaySpeed: 3000,
responsive: [
{
breakpoint: 550,
settings: {
slidesToShow: 1,
slidesToScroll: 1
}
},

]
});



$('.see-jobs').slick({
dots: true,
infinite: true,
speed: 2000,
slidesToShow:3,
slidesToScroll: 1,
autoplay: true,
autoplaySpeed: 3000,
responsive: [
{
breakpoint:991,
settings: {
slidesToShow: 2,
slidesToScroll: 1
}
},


{
breakpoint:550,
settings: {
slidesToShow: 1,
slidesToScroll: 1
}
},


]
});








function autocomplete(inp, arr) {
/*the autocomplete function takes two arguments,
the text field element and an array of possible autocompleted values:*/
var currentFocus;
/*execute a function when someone writes in the text field:*/
inp.addEventListener("input", function(e) {
var a, b, i, val = this.value;
/*close any already open lists of autocompleted values*/
closeAllLists();
if (!val) { return false;}
currentFocus = -1;
/*create a DIV element that will contain the items (values):*/
a = document.createElement("DIV");
a.setAttribute("id", this.id + "autocomplete-list");
a.setAttribute("class", "autocomplete-items");
/*append the DIV element as a child of the autocomplete container:*/
this.parentNode.appendChild(a);
/*for each item in the array...*/
for (i = 0; i < arr.length; i++) {
/*check if the item starts with the same letters as the text field value:*/
if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
/*create a DIV element for each matching element:*/
b = document.createElement("DIV");
/*make the matching letters bold:*/
b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
b.innerHTML += arr[i].substr(val.length);
/*insert a input field that will hold the current array item's value:*/
b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
/*execute a function when someone clicks on the item value (DIV element):*/
b.addEventListener("click", function(e) {
/*insert the value for the autocomplete text field:*/
inp.value = this.getElementsByTagName("input")[0].value;
/*close the list of autocompleted values,
(or any other open lists of autocompleted values:*/
closeAllLists();
});
a.appendChild(b);
}
}
});
/*execute a function presses a key on the keyboard:*/
inp.addEventListener("keydown", function(e) {
var x = document.getElementById(this.id + "autocomplete-list");
if (x) x = x.getElementsByTagName("div");
if (e.keyCode == 40) {
/*If the arrow DOWN key is pressed,
increase the currentFocus variable:*/
currentFocus++;
/*and and make the current item more visible:*/
addActive(x);
} else if (e.keyCode == 38) { //up
/*If the arrow UP key is pressed,
decrease the currentFocus variable:*/
currentFocus--;
/*and and make the current item more visible:*/
addActive(x);
} else if (e.keyCode == 13) {
/*If the ENTER key is pressed, prevent the form from being submitted,*/
e.preventDefault();
if (currentFocus > -1) {
/*and simulate a click on the "active" item:*/
if (x) x[currentFocus].click();
}
}
});
function addActive(x) {
/*a function to classify an item as "active":*/
if (!x) return false;
/*start by removing the "active" class on all items:*/
removeActive(x);
if (currentFocus >= x.length) currentFocus = 0;
if (currentFocus < 0) currentFocus = (x.length - 1);
/*add class "autocomplete-active":*/
x[currentFocus].classList.add("autocomplete-active");
}
function removeActive(x) {
/*a function to remove the "active" class from all autocomplete items:*/
for (var i = 0; i < x.length; i++) {
x[i].classList.remove("autocomplete-active");
}
}
function closeAllLists(elmnt) {
/*close all autocomplete lists in the document,
except the one passed as an argument:*/
var x = document.getElementsByClassName("autocomplete-items");
for (var i = 0; i < x.length; i++) {
if (elmnt != x[i] && elmnt != inp) {
x[i].parentNode.removeChild(x[i]);
}
}
}
/*execute a function when someone clicks in the document:*/
document.addEventListener("click", function (e) {
closeAllLists(e.target);
});
}

/*An array containing all the country names in the world:*/
var countries = ["Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua & Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia & Herzegovina","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Central Arfrican Republic","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica","Cote D Ivoire","Croatia","Cuba","Curacao","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kiribati","Kosovo","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauro","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","North Korea","Norway","Oman","Pakistan","Palau","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre & Miquelon","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Korea","South Sudan","Spain","Sri Lanka","St Kitts & Nevis","St Lucia","St Vincent","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad & Tobago","Tunisia","Turkey","Turkmenistan","Turks & Caicos","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States of America","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe"];

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementById("myInput"), countries);





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
 	
	 $('#step-4-next').click(function() {
        // Check values here
        var isValid = true;
        
        if(isValid) {
            $('.nav-tabs > li:nth-of-type(5) > a').removeClass('disabled').click();
        }
    });
	
	
	 $('#step-5-next').click(function() {
        // Check values here
        var isValid = true;
        
        if(isValid) {
            $('.nav-tabs > li:nth-of-type(6) > a').removeClass('disabled').click();
        }
    });
	
	
		 $('#step-6-next').click(function() {
        // Check values here
        var isValid = true;
        
        if(isValid) {
            $('.nav-tabs > li:nth-of-type(7) > a').removeClass('disabled').click();
        }
    });
	
 	 });

$(document).ready(function() {

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

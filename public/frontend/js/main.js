function morebrands(a){$(a).hasClass("on")?($(a).removeClass("on"),$("#brands-collapse-box").removeClass("full"),$(a).children("i").addClass("fa-plus").removeClass("fa-minus"),$(a).children("span").html("More")):($(a).addClass("on"),$("#brands-collapse-box").addClass("full"),$(a).children("i").removeClass("fa-plus").addClass("fa-minus"),$(a).children("span").html("Less"))}function sideMenuOpen(a){event.preventDefault(),$(a).find(".hamburger-icon").toggleClass("open"),$(a).find(".hamburger-icon").hasClass("open")?($(".side-menu-wrap,.side-menu-overlay").removeClass("opacity-0").addClass("opacity-1"),$(".side-menu").removeClass("closed").addClass("open"),$("body").addClass("side-menu-open")):($(".side-menu-wrap,.side-menu-overlay").removeClass("opacity-1").addClass("opacity-0"),$(".side-menu").removeClass("open").addClass("closed"),$("body").removeClass("side-menu-open"))}function sideMenuClose(){$(".side-menu-wrap,.side-menu-overlay").removeClass("opacity-1").addClass("opacity-0"),$(".side-menu").removeClass("open").addClass("closed"),$(".hamburger-icon").hasClass("open")&&($(".hamburger-icon").removeClass("open"),$("body").removeClass("side-menu-open"))}var searchOpen=function(){return{init:function(){$(".search-box").on("click",function(a){a.stopPropagation()}),$(document).on("click",".typed-search-box-shown",function(){$(this).removeClass("typed-search-box-shown"),$(".typed-search-box").addClass("d-none")})}}}();$(function(){$("#category-menu-icon, #category-sidebar").on("mouseover",function(){$("#hover-category-menu").show(),$("#category-menu-icon").addClass("active")}).on("mouseout",function(){$("#hover-category-menu").hide(),$("#category-menu-icon").removeClass("active")}),$(".nav-search-box a").on("click",function(a){a.preventDefault(),$(".search-box").addClass("show"),$('.search-box input[type="text"]').focus()}),$(".search-box-back button").on("click",function(){$(".search-box").removeClass("show")}),$(".all-category-menu a").bind("click",function(a){a.preventDefault();var b=$(this).attr("href");return $("html, body").stop().animate({scrollTop:$(b).offset().top-120},600,function(){}),!1})}),$(".sortSelect").each(function(){$(".sortSelect").select2({theme:"default sortSelectCustom"})}),$(document).ready(function(){function a(a){var b=$(a.element).val();return b?"<span class='color-preview' style='background-color:"+b+";'></span>"+a.text:a.text}searchOpen.init(),$(".tagsInput").tagsinput("items"),$(".editor").each(function(){var b=$(this),c=b.data("buttons");c=c?c:"bold,underline,italic,hr,|,ul,ol,|,align,paragraph,|,image,table,link,undo,redo";new Jodit(this,{uploader:{insertImageAsBase64URI:!0},toolbarAdaptive:!1,defaultMode:"1",toolbarSticky:!1,showXPathInStatusbar:!1,buttons:c})}),$(".nav-tabs a").click(function(){$(this).tab("show")}),$(".color-var-select").select2({templateResult:a,templateSelection:a,escapeMarkup:function(a){return a}})}),$(window).on("load",function(){}),$(window).scroll(function(){var a=$(window).scrollTop();$(".sub-category-menu.active").each(function(b){$(this).position().top+120<=a&&($(".all-category-menu li.active").removeClass("active"),$(".all-category-menu li").eq(b).addClass("active"))});var b=$(window).scrollTop();b>120?$(".logo-bar-area").addClass("sm-fixed-top"):$(".logo-bar-area").removeClass("sm-fixed-top")}).scroll(),$(document).ajaxComplete(function(){$(".selectpicker").each(function(){$(".selectpicker").select2({})})});

(function(a){a(document).ready(function(){a("#cssmenu").prepend('<div id="menu-button">Menu</div>');a("#cssmenu #menu-button").on("click",function(){var b=a(this).next("ul");if(b.hasClass("open")){b.removeClass("open")}else{b.addClass("open")}})})})(jQuery);
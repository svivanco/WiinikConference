!function(){$(document).ready(function(){$(".js-hide-show-password").each(function(){var $input=$(this),$hideShowLink=$('<span class="hideshow js-hide-show-link">Show</span>');$hideShowLink.click(function(e){e.preventDefault();var inputType=$input.attr("type");"text"==inputType?($input.attr("type","password"),$hideShowLink.text("Show")):($input.attr("type","text"),$hideShowLink.text("Hide")),$input.focus()}),$input.parent().append($hideShowLink)})})}();
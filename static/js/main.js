function initialize() 
	{     
		var myLatlng = new google.maps.LatLng(47.225175,39.728869);
		var myOptions = {
        zoom: 17,
        center: myLatlng,
        mapTypeId: google.maps.MapTypeId.HYBRID
		}
		var map = new google.maps.Map(document.getElementById("map"), myOptions);
		var marker = new google.maps.Marker({
		position: myLatlng,
		map: map,
		title:"\"Креативное пространство\"" 
		});
		marker.setMap(map);
	}
function height(name,padding) {
	var dh = $(".container_12").height();
	if(padding=='0') { var h = $(window).height()-35; } else { var h = $(window).height()-75; }
	$(".container_12").css("height", h + "px");
	$(".container_12").css("min-height", dh + "px");
	$(name).css("visibility", "visible");
}
function resize_height(name,padding) {
	$(window).resize(function() {
		if(padding=='0') { var h = $(window).height()-35; } else { var h = $(window).height()-75; }
		$(".container_12").css("height", h + "px");
	});
}

function popup(act) {
	if(act == 'in') {
		$('div.overlay').removeClass('hidden');
		$('div.popup').removeClass('hidden');
	}
	if(act == 'out') {
		$('div.overlay').addClass('hidden');
		$('div.popup').addClass('hidden');
	}
}

jQuery(document).ready(function(){
	
		jQuery('div.like').ArteHover(250);
		$(this).keydown(function(eventObject){
            if (eventObject.which == 27)
            popup('out');
		});
		
		$(".fancy").attr('rel', 'gallery').fancybox({padding : 0});
	});
	
$("a.def").click(function(event) {
			event.preventDefault();
});

$('.people_plus').click(function() {
	popup('in');
});

$('.partner_div').click(function() {
	popup('in');
});

$('.esc').click(function() {
	popup('out');
});

$('.overlay').click(function() {
	popup('out');
});


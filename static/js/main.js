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
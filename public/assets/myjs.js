$(function(){
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-bottom-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
});
function searchMotelajax(){
			var min = $("#selectprice option:selected").attr("min");
			var max = $("#selectprice option:selected").attr("max");
			var id_ditrict = $("#selectdistrict").val();
			var id_category = $("#selectcategory").val();
			// console.log(min,max,id_category,id_ditrict);
			var data_send = {
				min_price: min,
				max_price: max,
				id_ditrict: id_ditrict,
				id_category: id_category
			}
			console.log(min,max);
			// console.log(data);
			$.ajax({
                url : "searchmotel",
                method : "POST",
                data : data_send,
                success : function (result){
                    var result_room = JSON.parse(result);
                    if(result_room.length != 0)
                    	toastr.success('Tìm thấy '+result_room.length+' kết quả');
                    else
                    	toastr.warning('Không tìm thấy kết quả nào');
                    map = new google.maps.Map(document.getElementById('map'), {
										center: {lat: 16.070372, lng: 108.214388},
										zoom: 15,
										draggable: true
									});
                   	for (i in result_room){
										var data = result_room[i];
										var latlng =  new google.maps.LatLng(data.lat,data.lng);
										var phongtro = new google.maps.Marker({
											position:  latlng,
											map: map,
											title: data.title,
											icon: "images/gps.png",
											content: 'dgfdgfdg'
										});
										var infowindow = new google.maps.InfoWindow();
										(function(phongtro, data){
											var content = '<div id="iw-container">' +
											'<img height="200px" width="300" src="uploads/images/'+data.image+'">'+
											'<a href="detail/'+data.id+'"><div class="iw-title">' + data.title +'</div></a>' +
											'<p><i class="fas fa-map-marker" style="color:#003352"></i> '+ data.address +'<br>'+
											'<br>Phone. ' +data.phone +'</div>';

											google.maps.event.addListener(phongtro, "click", function(e){

												infowindow.setContent(content);
												infowindow.open(map, phongtro);
                  // alert(data.title);
              });
										})(phongtro,data);

									}
                }
            });
			
		}




(function(){
	var d = document,
	accordionToggles = d.querySelectorAll('.js-accordionTrigger'),
	setAria,
	setAccordionAria,
	switchAccordion,
  touchSupported = ('ontouchstart' in window),
  pointerSupported = ('pointerdown' in window);
  
  skipClickDelay = function(e){
    e.preventDefault();
    e.target.click();
  }

		setAriaAttr = function(el, ariaType, newProperty){
		el.setAttribute(ariaType, newProperty);
	};
	setAccordionAria = function(el1, el2, expanded){
		switch(expanded) {
      case "true":
      	setAriaAttr(el1, 'aria-expanded', 'true');
      	setAriaAttr(el2, 'aria-hidden', 'false');
      	break;
      case "false":
      	setAriaAttr(el1, 'aria-expanded', 'false');
      	setAriaAttr(el2, 'aria-hidden', 'true');
      	break;
      default:
				break;
		}
	};
//function
switchAccordion = function(e) {
  console.log("triggered");
	e.preventDefault();
	var thisAnswer = e.target.parentNode.nextElementSibling;
	var thisQuestion = e.target;
	if(thisAnswer.classList.contains('is-collapsed')) {
		setAccordionAria(thisQuestion, thisAnswer, 'true');
	} else {
		setAccordionAria(thisQuestion, thisAnswer, 'false');
	}
  	thisQuestion.classList.toggle('is-collapsed');
  	thisQuestion.classList.toggle('is-expanded');
		thisAnswer.classList.toggle('is-collapsed');
		thisAnswer.classList.toggle('is-expanded');
 	
  	thisAnswer.classList.toggle('animateIn');
	};
	for (var i=0,len=accordionToggles.length; i<len; i++) {
		if(touchSupported) {
      accordionToggles[i].addEventListener('touchstart', skipClickDelay, false);
    }
    if(pointerSupported){
      accordionToggles[i].addEventListener('pointerdown', skipClickDelay, false);
    }
    accordionToggles[i].addEventListener('click', switchAccordion, false);
  }
})();
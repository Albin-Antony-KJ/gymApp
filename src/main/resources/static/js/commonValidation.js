$(document).ready(function(){
	
	$(document).on('keydown', '.number-field', function(e){
		var id	= this.id;
		if(!isNumeric(e)){
			new PNotify({
		        title: 'INFORMATION',
		        text: 'Enter a numeric value',
		        type: 'info',
				styling: 'brighttheme'
		    });
		    return false;
		}
	});
});

function isNumeric(e){
	if($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
		(e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
		(e.keyCode >= 35 && e.keyCode <= 40)) {
		return true;
	}

	if((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)){
		return false;
	}
	return true;
}


function showsub(dhis){
	//alert($(dhis).parent().find(".sublinks").attr("class"));
	if($(dhis).parent().find(".sublinks").hasClass("slideOpen")){
		$(dhis).parent().find(".sublinks").removeClass("slideOpen");
		$(dhis).parent().find(".sublinks").addClass("slideClose");
	} else{
		$(dhis).parent().find(".sublinks").removeClass("slideClose");
		$(dhis).parent().find(".sublinks").addClass("slideOpen");
	}
}
$(document).ready(function(){

	$("input[name = 'days']").on("change", function(e){
		var days	= $("input[name='days']:checked").val();
		$("#addSessionMsg").text("Add "+days+" Sessions");
	});

	$("#session").on("change", function(e){
		var day 	= $("#day").val();
		if($.trim(day) != ""){
			var session = $(this).val();
			$('#time').empty().append('<option value="">- Time -</option>');

			var dataString	= "day="+day+"&session="+session;
			$.ajax({
				url		: sitePath + "ajax/getAvailableSession.php",
				method	: "post",
				data	: dataString,
				dataType: "json",
				success	: function(result){
					$.each(result, function(index, value){
						$("#time").append($("<option></option>")
	                    .attr("value", value.id)
	                    .text(value.start_time+" - "+value.end_time));
					});
				}
			});
		} else{
			new PNotify({
	            title: 'INFORMATION',
	            text: 'Please Select a day',
	            type: 'info',
				styling: 'brighttheme',
	        });
			$(this).val("");
		}
	});
});

function addSession(){
	if($('input[name*="sessionDetails"]').length < $("input[name='days']:checked").val()){
		var day 		= $("#day").val();
		var session 	= $("#session").val();
		var time 		= $("#time").val();
		var timeText 	= $("#time :selected").text();
		var errorFlag	= false;
		var errorSection= "";
		if($.trim(day) == ""){
	        errorFlag	= true;
			errorSection= "day";
		} else if($.trim(session) == ""){
			errorFlag	= true;
			errorSection= "session";
		} else if($.trim(time) == ""){
			errorFlag	= true;
			errorSection= "time";
		}

		if(errorFlag){
			new PNotify({
	            title: 'INFORMATION',
	            text: 'Please Select a '+errorSection,
	            type: 'info',
				styling: 'brighttheme',
	        });
	        return false;
		}

		var dataString	= "day="+day+"&session="+time+"&duration="+$("input[name='duration']:checked").val();
		$.ajax({
			url 	: sitePath + "ajax/checkSessionLimit.php",
			method 	: "post",
			data 	: dataString,
			success : function(result){
				var sessionDetails	= day+"~"+session+"~"+time;
				if(result != "No Dates"){
					var reSch_msg	= "Please reschedule session for "+result+". After saving.";
					var stack_modal = {"dir1": "down", "dir2": "right", "push": "top", "modal": true, "overlay_close": false};
			        new PNotify({
			            title: 'Confirmation Needed',
			            text: 'Maximum sessions have been alloted for the date '+result+'. Do you want to continue?',
			            type: 'notice',
						styling: 'brighttheme',
						icon: 'fa fa-question-circle',
						hide: false,
						addclass: "stack-modal",
						stack: {
							dir1: 'down',
							dir2: 'right',
							push: 'top',
							modal: true,
							overlay_close: true
						},
						confirm: {
							confirm: true,
							buttons: [
							{
								text: "Yes",
								addClass: "",
								promptTrigger: true,
								click: function(notice, value){
									notice.remove(); undoModal();
									var tableRow	=	"<tr id='"+day+"'>"+
															"<td>"+day+"</td>"+
															"<td>"+session+"</td>"+
															"<td>"+timeText+"</td>"+
															"<td class=\"hide\"><input type=\"text\" name=\"sessionDetails[]\" value=\""+sessionDetails+"\"/></td>"+
															"<td class=\"iconColumn\"><a href=\"javascript:void(0)\" onclick=\"removeSession('"+day+"')\" class=\"icon fa-trash\"><span class=\"label\">Trash</span></a></td>"+
															"<td class=\"errorColumn\">"+reSch_msg+"</td>"+
														"</tr>";
									$("#sessionTableBody").append(tableRow);
									$("#day").find("[value='" + day + "']").prop("disabled", true);
								}
							},
							{
								text: "No",
								addClass: "",
								click: function(notice){ notice.remove(); undoModal(); }
							}]
						}
			        });
				} else{
					var tableRow	=	"<tr id='"+day+"'>"+
											"<td>"+day+"</td>"+
											"<td>"+session+"</td>"+
											"<td>"+timeText+"</td>"+
											"<td class=\"hide\"><input type=\"text\" name=\"sessionDetails[]\" value=\""+sessionDetails+"\"/></td>"+
											"<td class=\"iconColumn\"><a href=\"javascript:void(0)\" onclick=\"removeSession('"+day+"')\" class=\"icon fa-trash\"><span class=\"label\">Trash</span></a></td>"+
										"</tr>";
					$("#sessionTableBody").append(tableRow);
					$("#day").find("[value='" + day + "']").prop("disabled", true);
				}
			}
		});
		

		
		$("#day").val("");
		$("#session").val("");
		$("#time").val("");
	} else{
		new PNotify({
	            title: 'INFORMATION',
	            text: 'Maximum sessions selected',
	            type: 'info',
				styling: 'brighttheme'
	        });
	}
}

function undoModal() {
    var elements = document.querySelectorAll('body > *');
    if (elements[0].outerHTML == '<div class="ui-pnotify-modal-overlay" style=""></div>') {
        elements[0].remove();
    }
}

function removeSession(id){
	$("#"+id).remove();
	$("#day").find("[value='" + id + "']").prop("disabled", false);
}

function checkSession(days){
	var sessions 	= $('input[name*="sessionDetails"]').length;
	if(sessions > days){
		new PNotify({
	            title: 'INFORMATION',
	            text: 'More sessions added',
	            type: 'info',
				styling: 'brighttheme'
	        });
		$("#"+sessions+"days").prop("checked", true);
	}
}


function searchSession(){
	var day 	= $("#day").val();
	var tableRow= "";

	if($.trim(day) == ""){
		new PNotify({
            title: 'INFORMATION',
            text: 'Please Select a day',
            type: 'info',
			styling: 'brighttheme'
        });
        return false;
	}
	var dataString	= "day="+day;
	$.ajax({
		url		: sitePath + "ajax/searchSession.php",
		method	: "post",
		data	: dataString,
		dataType: "json",
		success	: function(result){
			$.each(result, function(index, value){
                tableRow	+=	"<tr>"+
									"<td>"+value.day+"</td>"+
									"<td>"+value.name+"</td>"+
									"<td>"+value.session+"</td>"+
									"<td>"+value.start_time+"</td>"+
									"<td>"+value.end_time+"</td>"+
								"</tr>";
			});
			$("#sessionTableBody").html(tableRow);
		}
	});
	$("#sessionTable tbody").html(tableRow);
}
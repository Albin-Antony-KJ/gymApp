function loadSchedule(custId){
	var days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
	var tableRow	= "";

	var dataString	= "custId="+custId;
	$.ajax({
		url		: sitePath + "ajax/getCustomerSchedule.php",
		method	: "post",
		data	: dataString,
		dataType: "json",
		success	: function(result){
			$.each(result, function(index, value){
                tableRow	+=	"<tr>"+
									"<td>"+value.sch_date+"</td>"+
									"<td>"+days[new Date(value.sch_date).getDay()]+"</td>"+
									"<td>"+value.session+"</td>"+
									"<td>"+value.start_time+"</td>"+
									"<td>"+value.end_time+"</td>"+
									"<td><a href=\"javascript:void(0);\" onclick=\"setReschedule("+value.sch_id+","+value.sch_date+");\" class=\"button special\">Re Schedule</a></td>"+
								"</tr>";
			});
			$("#scheduleTableBody").html(tableRow);
		}
	});
}

function setReschedule(schId, schDate){
	$("#scheduleId").val(schId);
	$("#reScheduleModal").css("display", "block");
}

function loadAvailTiming(session){
	var date 	= $("#reSchDate").val();
	$('#time').empty().append('<option value="">- Time -</option>');
	if(date != ""){
		if(session != ""){
			var dataString	= "date="+encodeURIComponent(date)+"&session="+session;
			$.ajax({
				url		: sitePath + "ajax/getReScheduleAvailableSession.php",
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
		}
	} else{
		new PNotify({
            title: 'INFORMATION',
            text: 'Please Select a date',
            type: 'info',
			styling: 'brighttheme'
        });
        return false;
	}
}

function assignReSchedule(){
	var date 	= $("#reSchDate").val();
	var time 	= $("#time").val();
	var schId 	= $("#scheduleId").val();

	var errorFlag = false;
	if($.trim(date) == ""){
        errorFlag	= true;
		errorSection= "date";
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
	var dataString	= "date="+encodeURIComponent(date)+"&time="+time+"&schId="+schId;
	$.ajax({
		url		: sitePath + "ajax/saveReSchedule.php",
		method	: "post",
		data 	: dataString,
		success	: function(result){
			$("#reScheduleModal").css("display", "none");
			if(result > 0){
				new PNotify({
		            title: 'SUCCESS',
		            text: 'Rescheduling Successful',
		            type: 'success',
					styling: 'brighttheme',
		        });
			} else{
				new PNotify({
		            title: 'ERROR',
		            text: 'Rescheduling Failed',
		            type: 'error',
					styling: 'brighttheme',
		        });
			}
		}
	});
}

function viewSchedule(date){
	var tableRow	= "";

	var dataString	= "date="+encodeURIComponent(date);
	$.ajax({
		url		: sitePath + "ajax/viewDateSchedule.php",
		method	: "post",
		data	: dataString,
		dataType: "json",
		success	: function(result){
			$.each(result, function(index, value){
                tableRow	+=	"<tr>"+
									"<td>"+value.sch_date+"</td>"+
									"<td>"+value.name+"</td>"+
									"<td>"+value.session+"</td>"+
									"<td>"+value.start_time+"</td>"+
									"<td>"+value.end_time+"</td>"+
								"</tr>";
			});
			$("#scheduleTableBody").html(tableRow);
		}
	});
}
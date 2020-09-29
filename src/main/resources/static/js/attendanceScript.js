function markAttendance(){
	var date 		= $("#date").val();
	var customer 	= $("#customer").val();
	var customerName= $("#customer :selected").text();
	var time 		= $("#time").val();
	var timeText	= $("#time :selected").text();
	var sessionText	= $("#session :selected").text();

	var errorFlag	= false;
	var errorSection= "";
	if($.trim(date) == ""){
        errorFlag	= true;
		errorSection= "date";
	} else if($.trim(time) == ""){
		errorFlag	= true;
		errorSection= "time";
	} else if($.trim(customer) == ""){
		errorFlag	= true;
		errorSection= "customer";
	}

	if(errorFlag){
		new PNotify({
            title: 'INFORMATION',
            text: 'Please Select a '+errorSection,
            type: 'info',
			styling: 'brighttheme'
        });
        return false;
	}

	var dataString	= "custId="+customer+"&date="+encodeURIComponent(date)+"&time="+time;
	$.ajax({
		url		: sitePath + "ajax/saveAttendance.php",
		method	: "post",
		data	: dataString,
		success	: function(result){
			if(result > 0){
				new PNotify({
		            title: 'SUCCESS',
		            text: 'Attendance Marked Successfully',
		            type: 'success',
					styling: 'brighttheme'
		        });

		        var tableRow	=	"<tr>"+
										"<td>"+date+"</td>"+
										"<td>"+customerName+"</td>"+
										"<td>"+sessionText+"</td>"+
										"<td>"+timeText.split(" - ")[0]+"</td>"+
										"<td>"+timeText.split(" - ")[1]+"</td>"+
									"</tr>";
				$("#attendanceTableBody").append(tableRow);
			}
		}
	});
	$("#session").val("Morning").trigger('change');;
	$("#customer").val("");
}


function loadTiming(session){
	$('#time').empty().append('<option value="">- Time -</option>');
	if(session != ""){
		var dataString	= "session="+session;
		$.ajax({
			url		: sitePath + "ajax/loadTiming.php",
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
}

function searchAttendance() {
	var date 		= $("#reportDate").val();
	var month		= $("#reportMonth").val();
	var customer 	= $("#reportCustomer").val();
	var tableRow	= "";

	var dataString	= "custId="+customer+"&date="+encodeURIComponent(date)+"&month="+month;
	$.ajax({
		url		: sitePath + "ajax/searchAttendance.php",
		method	: "post",
		data	: dataString,
		dataType: "json",
		success	: function(result){
			$.each(result, function(index, value){
                tableRow	+=	"<tr>"+
									"<td>"+value.date+"</td>"+
									"<td>"+value.name+"</td>"+
									"<td>"+value.session+"</td>"+
									"<td>"+value.start_time+"</td>"+
									"<td>"+value.end_time+"</td>"+
								"</tr>";
			});
			$("#attendanceTableBody").html(tableRow);
		}
	});
	$("#attendanceTable tbody").html(tableRow);
}
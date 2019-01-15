$(document).ready(function(){
	
	function disable_all(start){
		//console.log(start);
		$("select[id^='Device_id_']").each(function(index){
			if (($.inArray(index, start)) == -1) $(this).attr('disabled', true);
		});	
	}
	
	disable_all([0]);

	org = $("select[id='Device_id_organization']");
	bran = $("select[id='Device_id_branch']");
	dep = $("select[id='Device_id_department']");
	cab = $("select[id='Device_id_cabinet']");
	empl = $("select[id='Device_id_employee']");	

	org.change(function(){
		if ($(this).val() == '') {
			disable_all([0]);
		} else {
			bran.attr('disabled', false);
		}
	});

	bran.change(function(){
		if ($(this).val() == '') {
			disable_all([0,1]);
		} else {
			dep.attr('disabled', false);
		}
	});

	dep.change(function(){
		if ($(this).val() == '') {
			disable_all([0,1,2]);
		} else {
			cab.attr('disabled', false);
		}
	});

	cab.change(function(){
		if ($(this).val() == '') {
			disable_all([0,1,2,3]);
		} else {
			empl.attr('disabled', false);
		}
	});
});

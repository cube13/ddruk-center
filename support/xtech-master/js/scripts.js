//Show "Loading..." text when ajax calling
$(document).ajaxStart(function() {
    //console.log("show");
    $( "#loader" ).show();
});
$(document).ajaxStop(function(){
    //console.log("hide");
    $( "#loader" ).hide();
});



//Tree with ajax load leaf
$(document).ready(function(){

    //Style of tree
	$('.Expand').live('click', function(e){
		if ($(this).parent().hasClass("ExpandOpen")) {
			$(this).parent().removeClass("ExpandOpen").addClass("ExpandClosed");
			$(this).nextAll('ul').remove();
		} else {
			loadData($(this).parent());
			$(this).parent().removeClass("ExpandClosed").addClass("ExpandOpen");
		}
	});

    //Load leaf data by levels
    function loadData(e) {
		type_id = e.attr('id').split('-');
		type = type_id[0];
		id = type_id[1];
		switch (type) {
			case "org":
				loadBranch(type,id,e);
				break;
			case "branch":
				loadDepartment(type,id,e);
				break;
			case "depart":
				loadCabinet(type,id,e);
				break;
			case "cabinet":
				loadEmployee(type,id,e);
				break;	
			case "employee":
				loadDeviceType(type,id,e);
				break;		
			default:
				alert("none"); 		
		}
	}

    //Load leaf data from Branch level
	function loadBranch(type, id, element) {
        //$( "#loader" ).show();
		$.ajax({
			type: 'GET',
			url: 'index.php?r=branch/load&id='+id,
			dataType : 'json',
			success:function(data) {
				if (data) {
					li = element.append("<ul class='Container Branch'></ul>");
					$.each(data, function(index, element){					
						l_class = (index == (data.length-1))?"IsLast":"";
						ul = li.find('ul');
						n_div = $("<div class='Expand'></div>");
                        n_b = $("<div class='tree-menu-button-branch'><a href='#'></a></div>");
						n_content = $("<div class='Content'><a id='branch-"+this.id_branch+"' href='index.php?r=branch/show&id="+this.id_branch+"'>"+this.name+"</a></div>");
						node = $("<li id=branch-"+this.id_branch+" class='Node ExpandClosed "+l_class+"'></li>")
                            .append(n_div)
                            .append(n_b)
						    .append(n_content);
						ul.append(node);
					});
				}				
			},
			failure: function() {
                alert("Ajax request broken");
            }
            /*complete: function() {
                $( "#loader" ).hide();
            }*/
		});
	}

    //Load leaf data from Department level
	function loadDepartment(type, id, element) {
        //$( "#loader" ).show();
		$.ajax({
			type: 'GET',
			url: 'index.php?r=department/load&id='+id,
			dataType : 'json',
			success:function(data) {
				if (data) {
					li = element.append("<ul class='Container Department'></ul>");			
					$.each(data, function(index, element){
						l_class = (index == (data.length-1))?"IsLast":"";
						ul = li.find('ul');						
						n_div = $("<div class='Expand'></div>");
                        n_b = $("<div class='tree-menu-button-department'><a href='#'></a></div>");
						n_content = $("<div class='Content'><a id='depart-"+this.id_department+"' href='index.php?r=department/show&id="+this.id_department+"'>"+this.name+"</a></div>");
						node = $("<li id=depart-"+this.id_department+" class='Node ExpandClosed "+l_class+"'></li>")
                            .append(n_div)
                            .append(n_b)
							.append(n_content);
						ul.append(node);
					});
				}				
			},
			failure: function() {
                alert("Ajax request broken");
            }
            /*complete: function() {
                $( "#loader" ).hide();
            }*/
		});
	}

    //Load leaf data from Cabinet level
	function loadCabinet(type, id, element) {
            //$( "#loader" ).show();
			$.ajax({
			type: 'GET',
			url: 'index.php?r=cabinet/load&id='+id,
			dataType : 'json',
			success:function(data) {
				if (data) {
					li = element.append("<ul class='Container Cabinet'></ul>");					
					$.each(data, function(index, element){
						l_class = (index == (data.length-1))?"IsLast":"";
						ul = li.find('ul');						
						n_div = $("<div class='Expand'></div>");
                        n_b = $("<div class='tree-menu-button-cabinet'><a href='#'></a></div>");
						n_content = $("<div class='Content'><a id='cabinet-"+this.id_cabinet+"' href='index.php?r=cabinet/show&id="+this.id_cabinet+"'>каб.№"+this.number+"</a></div>");
						node = $("<li id=cabinet-"+this.id_cabinet+" class='Node ExpandClosed "+l_class+"'></li>")
                            .append(n_div)
                            .append(n_b)
							.append(n_content);
						ul.append(node);
					});
				}				
			},
			failure: function() {
                alert("Ajax request broken");
            }
		});
	}

    //Load leaf data from Employee level
	function loadEmployee(type, id, element) {
			$.ajax({
			type: 'GET',
			url: 'index.php?r=employee/load&id='+id,
			dataType : 'json',
			success:function(data) {
				if (data) {
					li = element.append("<ul class='Container Employee'></ul>");
					$.each(data, function(index, element){
						l_class = (index == (data.length-1))?"IsLast":"";
						ul = li.find('ul');						
						n_div = $("<div class='Expand'></div>");
                        n_b = $("<div class='tree-menu-button-employee'><a href='#'></a></div>");
						n_content = $("<div class='Content'><a id='employee-"+this.id_employee+"' href='index.php?r=employee/show&id="+this.id_employee+"'>"+this.firstname+"</a></div>");
						node = $("<li id=employee-"+this.id_employee+" class='Node ExpandClosed "+l_class+"'></li>")
                            .append(n_div)
                            .append(n_b)
				 		    .append(n_content);
						ul.append(node);
					});
				}				
			},
			failure: function() {
                alert("Ajax request broken");
            }
		});
	}

    //Load leaf data from Device level
	function loadDevice(type, id, element) {
			$.ajax({
			type: 'GET',
			url: 'index.php?r=device/load&id='+id,
			dataType : 'json',
			success:function(data) {
				if (data) {
					li = element.append("<ul class='Container Device'></ul>");					
					$.each(data, function(index, element){
						l_class = (index == (data.length-1))?"IsLast":"";
						ul = li.find('ul');						
						n_div = $("<div class='Expand'></div>");
                        n_b = $("<div class='tree-menu-button-device'><a href='#'></a></div>");
						n_content = $("<div class='Content'><a href='index.php?r=device/show&id="+this.id_device+"'>"+this.name+"</a></div>");
						node = $("<li id=device-"+this.id_device+" class='Node ExpandClosed "+l_class+"'></li>")
                            .append(n_div)
                            .append(n_b)
 				 		    .append(n_content);
						ul.append(node);
					});
				}				
			},
			failure: function() {
                alert("Ajax request broken");
            }
		});
	}

    //Load leaf data from DeviceType level
	function loadDeviceType(type, id, element) {
			$.ajax({
			type: 'GET',
			url: 'index.php?r=devicetype/load&id='+id,
			dataType : 'json',
			success:function(data) {
				if (data) {
					data_length = 0;
					$.each(data,function(){
						data_length++;
					});
					li_p = element.append("<ul class='Container Device'></ul>");
					iteration = 0;
					$.each(data, function(obj,i){
						iteration++;
						class_last = (data_length == iteration)?"IsLast":"";
						ul = li_p.find('ul');
						li = $("<li class='Node DeviceType ExpandLeaf "+class_last+"'>"+
								"<div class='Expand'></div>"+
								"<input type='checkbox'>"+
								"<div class='Content'>"+
									"<a id='obj-"+obj+"' href='#'>"+obj+"("+i+")</a></li>"+
								"</div>");
						ul.append(li);
					});
				}				
			},
			failure: function() {
                alert("Ajax request broken");
            }
		});
	}

	//On create new device change lists
	$('body').on('click','a[id^="branch-"]',function(){
		$.ajax({'url':'/index.php?r=branch/show&id='+this.id.split('-')[1],
				'cache':false,	
				'success':function(html){
						$("#data-grid").html(html)}
					});
		return false;
	});

	$('body').on('click','a[id^="depart-"]',function(){
		$.ajax({'url':'/index.php?r=department/show&id='+this.id.split('-')[1],
				'cache':false,	
				'success':function(html){
						$("#data-grid").html(html)}
					});
		return false;
	});

	$('body').on('click','a[id^="cabinet-"]',function(){
		$.ajax({'url':'/index.php?r=cabinet/show&id='+this.id.split('-')[1],
				'cache':false,	
				'success':function(html){
						$("#data-grid").html(html)}
					});
		return false;
	});

	$('body').on('click','a[id^="employee-"]',function(){
		$.ajax({'url':'/index.php?r=employee/show&id='+this.id.split('-')[1],
				'cache':false,	
				'success':function(html){
						$("#data-grid").html(html)}
					});
		return false;
	});

	$('body').on('click','a[id^="obj-"]',function(){
		id_emp = $(this).parents('[id^="employee-"]').attr("id").split('-')[1];
		console.log(id_emp);
		$.ajax({'url':'/index.php?r=devicetype/showbyemployee&id_obj='+this.id.split('-')[1]+'&id_emp='+id_emp,
				'cache':false,	
				'success':function(html){
						$("#data-grid").html(html)}
					});
		return false;
	});
});


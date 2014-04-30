(function($,w){

function checkbox_click(event)
{
	event.stopPropagation();
	do_email(enable_email.url);
	var $target=$(event.target);
	$target.prop('checked').change();
}
w.checkbox_click=checkbox_click;

function enable_select_all()
{
	//Keep track of enable_select_all has been called
	if(!enable_select_all.enabled)
		enable_select_all.enabled=true;
	$('#select_all').change(function(){
		$(".tablesorter tbody :checkbox").prop('checked',this.checked).change();
	});
}
enable_select_all.enabled=false;
w.enable_select_all=enable_select_all;

function enable_row_selection(rows)
{
	//Keep track of enable_row_selection has been called
	if(!enable_row_selection.enabled)
		enable_row_selection.enabled=true;
	if(typeof rows=="undefined")
		rows=$(".tablesorter tbody tr");
	rows.click(function row_click(event){
		var checkbox = $(this).find(":checkbox");
		checkbox.prop('checked',!checkbox.prop('checked')).change();
		do_email(enable_email.url);
	}).find(":checkbox").change(function(){
		$(this).parents('tr')[this.checked?'addClass':'removeClass']('selected');
	});
}
enable_row_selection.enabled=false;
w.enable_row_selection=enable_row_selection;

})(jQueryNew,window);


//-- jquery old --//
function enable_search_form(suggest_url,confirm_search_message, activeResult){
	$('#search').click(function()
    {
    	$(this).attr('value','');
    });

    $("#search").autocomplete(suggest_url,{max:100,selectFirst: false, cacheLength: 0});
    $("#search").result(function(event, data, formatted)
    {
    	do_search_form();
    });

    $('#search_form').submit(function(event)
	{
		event.preventDefault();

		if(get_selected_values().length >0)
		{
			if(!confirm(confirm_search_message))
				return;
		}
		do_search_form();
	});
}

function do_search_form(){
	var form = $('#search_form');
	var crit = {'search':$('#search').val().slice(1,$('#search').val().search(']'))};
	$.ajax({
		url: form.attr('action'),
		data: form.serialize(),
		method: form.attr('method'),
		success: function(data){
			// alert('Item Added');
			var items = $('#sortable_table tbody tr input').length;
			if (data) {
				if(items > 0){
					$('#sortable_table tbody').append(data);
				}else{
					$('#sortable_table tbody').html(data);
				}
				$('#search').val(''); //Borro value del campo de busqueda
			}
		}
	});
}

function enable_search(suggest_url,confirm_search_message, activeResult)
{
	//Keep track of enable_email has been called
	if(!enable_search.enabled)
		enable_search.enabled=true;

	$('#search').click(function()
    {
    	this.value='';
    });

    $("#search").autocomplete(suggest_url,{max:100,delay:10, selectFirst: false});
    $("#search").result(function(event, data, formatted)
    {
		do_search(true);
    });
    
	$('#search_form').submit(function(event)
	{
		event.preventDefault();

		if(get_selected_values().length >0)
		{
			if(!confirm(confirm_search_message))
				return;
		}
		do_search(true);
	});
}
enable_search.enabled=false;

function do_search(show_feedback,on_complete)
{	
	//If search is not enabled, don't do anything
	if(!enable_search.enabled)
		return;
		
	if(show_feedback)
		$('#spinner').show();
		
	$('#sortable_table tbody').load($('#search_form').attr('action'),{'search':$('#search').val()},function()
	{
		if(typeof on_complete=='function')
			on_complete();
				
		$('#spinner').hide();
		//re-init elements in new table, as table tbody children were replaced
		// tb_init('#sortable_table a.thickbox');
		update_sortable_table();	
		enable_row_selection();		
		$('#sortable_table tbody :checkbox').click(checkbox_click);
		$("#select_all").attr('checked',false);
	});
	console.log($('#search').val());
}

function enable_email(email_url)
{
	//Keep track of enable_email has been called
	if(!enable_email.enabled)
		enable_email.enabled=true;

	//store url in function cache
	if(!enable_email.url)
	{
		enable_email.url=email_url;
	}
	
	$('#select_all, #sortable_table tbody :checkbox').click(checkbox_click);
}
enable_email.enabled=false;
enable_email.url=false;

function do_email(url)
{
	//If email is not enabled, don't do anything
	if(!enable_email.enabled)
		return;
	$.post(url, { 'ids[]': get_selected_values() },function(response)
	{ 
		if(response=='#'){
			response ='javascript:void(0)';
		}
		$('#email').attr('href',response);
	});

}

function enable_checkboxes()
{
	$('#sortable_table tbody :checkbox').click(checkbox_click);
}

function enable_delete(confirm_message,none_selected_message)
{
	//Keep track of enable_delete has been called
	if(!enable_delete.enabled)
		enable_delete.enabled=true;
	
	$('#delete').click(function(event)
	{
		event.preventDefault();
		if($("#sortable_table tbody :checkbox:checked").length >0)
		{
			if(confirm(confirm_message))
			{
				if($(this).is('button'))
					document.location=$(this).attr('href');
				else
					do_delete($(this).attr('href'));
			}
		}
		else
		{
			alert(none_selected_message);
		}
	});
}
enable_delete.enabled=false;

function do_delete(url)
{
	//If delete is not enabled, don't do anything
	if(!enable_delete.enabled)
		return;
	
	var row_ids = get_selected_values();
	var selected_rows = get_selected_rows();
	$.post(url, { 'ids[]': row_ids },function(response)
	{
		//delete was successful, remove checkbox rows
		if(response.success)
		{
			var url2=document.URL.split('index.php');
			console.log(url2);
			if (url2[1]=='/employees'){ window.location.reload(); }
			else{
				$(selected_rows).each(function(index, dom)
				{
					$(this).find("td").animate({backgroundColor:"green"},1200,"linear")
					.end().animate({opacity:0},1200,"linear",function()
					{
						$(this).remove();
						//Re-init sortable table as we removed a row
						update_sortable_table();
						
					});
				});	
				set_feedback(response.message,'success_message',false);	
			}
		}
		else
		{
			set_feedback(response.message,'error_message',true);	
		}
		

	},"json");
}

function enable_bulk_edit(none_selected_message)
{
	//Keep track of enable_bulk_edit has been called
	if(!enable_bulk_edit.enabled)
		enable_bulk_edit.enabled=true;
	
	$('#bulk_edit').click(function(event)
	{
		event.preventDefault();
		if($("#sortable_table tbody :checkbox:checked").length >0)
		{
			tb_show($(this).attr('title'),$(this).attr('href'),false);
			$(this).blur();
		}
		else
		{
			alert(none_selected_message);
		}
	});
}
enable_bulk_edit.enabled=false;

function update_sortable_table()
{
	//let tablesorter know we changed <tbody> and then triger a resort
	$("#sortable_table").trigger("update");
	
	if(typeof $("#sortable_table")[0].config!="undefined")
	{
		var sorting = $("#sortable_table")[0].config.sortList; 		
		$("#sortable_table").trigger("sorton",[sorting]);
	}
}

function update_row(row_id,url)
{
	$.post(url, { 'row_id': row_id },function(response)
	{
		//Replace previous row
		var row_to_update = $("#sortable_table tbody tr :checkbox[value="+row_id+"]").parent().parent();
		row_to_update.replaceWith(response);	
		reinit_row(row_id);
		hightlight_row(row_id);
	});
}

function reinit_row(checkbox_id)
{
	var new_checkbox = $("#sortable_table tbody tr :checkbox[value="+checkbox_id+"]");
	var new_row = new_checkbox.parent().parent();
	enable_row_selection(new_row);
	//Re-init some stuff as we replaced row
	update_sortable_table();
	// tb_init(new_row.find("a.thickbox"));
	//re-enable e-mail
	new_checkbox.click(checkbox_click);	
}

function hightlight_row(checkbox_id)
{
	var new_checkbox = $("#sortable_table tbody tr :checkbox[value="+checkbox_id+"]");
	var new_row = new_checkbox.parent().parent();

	new_row.find("td").animate({backgroundColor:"#e1ffdd"},"slow","linear")
		.animate({backgroundColor:"#e1ffdd"},5000)
		.animate({backgroundColor:"#ffffff"},"slow","linear");
}

function get_selected_values()
{
	var selected_values = new Array();
	$("#sortable_table tbody :checkbox:checked").each(function()
	{
		selected_values.push($(this).val());
	});
	return selected_values;
}

function get_selected_rows() 
{ 
	var selected_rows = new Array(); 
	$("#sortable_table tbody :checkbox:checked").each(function() 
	{ 
		selected_rows.push($(this).parent().parent()); 
	}); 
	return selected_rows; 
}

function get_visible_checkbox_ids()
{
	var row_ids = new Array();
	$("#sortable_table tbody :checkbox").each(function()
	{
		row_ids.push($(this).val());
	});
	return row_ids;
}
$(document).ready(function() 
{
	$(".soloNumeros").keyValue(/[0-9]/); 
	$(".soloNumeros2").keyValue(/[0-9.]/); 
	$("#cc").click(function()
	{
		if($("#cc").val() != '')
		{
			$("#auditoria").css("display", "block");

		}
		else
		{
			$("#auditoria").css("display", "none");			
		}
	});
});

function conMayusculas(field) 
{
    field.value = field.value.toUpperCase()
}
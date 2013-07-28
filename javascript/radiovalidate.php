<script type="text/javascript">
function radio_validate()
{
	var details=document.getElementById("detailsmsg").value;
	var radio_selected = false;
	// Loop from zero to the one minus the number of radio button selections
	for (counter = 0; counter < register.status.length; counter++)
	{
		// If a radio button has been selected it will return true
		// (If not it will return false)
		if (register.status[counter].checked) radio_selected = true; 
	}
	if (!radio_selected && details.length==0 && !register.sms.checked)
	{
		// If there were no selections at all made in the edit box
		alert("Fill/Select atleast 1 field");
		return false;
	}
}
</script>
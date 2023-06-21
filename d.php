<form name="confirm" method="post">
Do You want to continue to enter  into chat room?<br>
<br />
<input type="radio" name="confirm" value="1"> Yes<br>
<input type="radio" name="confirm" value="2"> No<br>

<input type="submit" value="Submit" onclick="get_radio_value()">
</form>

<script type="text/javascript">
function get_radio_value()
{
	var val=0;
	for (var i=0; i < document.confirm.confirm.length; i++)
	{
	   if (document.confirm.confirm[i].checked)
	   {
			var val=document.confirm.confirm[i].value;
	   }
	}
	alert(val);
	if(val == 2)
		window.location="login.php";
	else if(val == 1)
		window.location="login.php";
	else
	{
		alert("Please Confirm!!");
		return false;
	}
}
</script>
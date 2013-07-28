<script type="text/javascript">
function validate()
{
var text=document.getElementById("m").value;
submitOK="true";

 if(text.length==0)
 {
 alert("text area for complaint cannot be left empty");
 submitOK="false";
 }
 
 if (submitOK=="false")
 {
 return false;
 }
}
</script>
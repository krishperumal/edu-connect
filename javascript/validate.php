<script type="text/javascript">
function validate()
{
var passw=document.getElementById("password").value;
var user=document.getElementById("username").value;
submitOK="true";
 if(user.length==0  )
 {
 alert("username field cannot be left empty");
 submitOK="false";
 }
 if(user.length!=0&&passw.length==0  )
 {
 alert("password field cannot be left empty");
 submitOK="false";
 }
 
if (submitOK=="false")
 {
 return false;
 }
 
}
 
 
</script> 
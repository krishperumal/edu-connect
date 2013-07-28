<script type="text/javascript">
function validate()
{
var idc1=document.getElementById("idno1").value;
var user=document.getElementById("user").value;
var passw=document.getElementById("pass").value;
var at=document.getElementById("email").value.indexOf("@");
var lemail=document.getElementById("email").value;
submitOK="true";

 if(idc1.length==0)
 {
 alert("first name field cannot be left empty");
 submitOK="false";
 return false;
 }
 
 
 if(user.length==0)
 {
 alert("username field cannot be left empty");
 submitOK="false";
  return false;
 }
 
 if(passw.length==0)
 {
 alert("password field cannot be left empty");
 submitOK="false";
  return false;
 }
 
 
 
 if (lemail.length==0) 
 {
 alert("email field cannot be left empty");
 submitOK="false";
  return false;
 }
 
 if (at==-1 && lemail.length!=0) 
 {
 alert("Not a valid e-mail!");
 submitOK="false";
  return false;
 }
 
 
 if (submitOK=="false")
 {
 return false;
 }
}
</script>
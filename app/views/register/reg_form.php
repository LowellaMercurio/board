<h1>User Registration</h1>

<form class="well" method="POST" action="<?php eh(url('')) ?>">
<table>
   <tr>
       <td>Username: </td><td><input type="text" name="username" /></td>
   </tr>
   <tr>
	   <td>Password: </td><td><input type="password" name="password" /></td>
   </tr>
   <tr>
       <td>Confirm Password: </td><td><input type="password" name="confirm_password" /></td>
   </tr>
   <tr>
	   <input type="hidden" name="page_next" value="reg_complete">
	   <td></td><td><input type="submit" class="btn btn-primary" value="Register" name="register" />
	   <a class="btn btn-primary" href="<?php eh(url('register/index')); ?>">Cancel</a></td>
   </tr>
</table>
</form>
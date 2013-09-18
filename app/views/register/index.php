<h1>Login</h1>

<form class="well" method="post" action="<?php echo eh($login); ?>">
<table>
	<tr>
	<td>Username: </td><td><input type="text" name="username" value="<?php eh(Param::get('username'))?>"/></td>
	</tr>
	<tr>
	<td>Password: </td><td><input type="password" name="password" value="<?php eh(Param::get('password')) ?>"/></td>
	</tr>
	<tr>
	<td><input type="submit" class="btn btn-primary" name="login" value="Login" /></td>
	<td><input type="submit" class="btn btn-primary" name="register" value="Register" /></td>
	<tr>
</table>
</form>

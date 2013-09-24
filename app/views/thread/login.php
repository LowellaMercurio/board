<h1>Login</h1>

<form class="well" method="post" action="<?php echo $login; ?>">
<table>
	<tr>
	<td>Username: </td><td><input type="text" name="username" value="<?php eh(Param::get('username'))?>"/></td>
	</tr>
	<tr>
	<td>Password: </td><td><input type="password" name="password" /></td>
	</tr>
	<tr>
	<td><input type="submit" class="btn btn-primary" name="login" value="Login"/></td>
	<td><a class="btn btn-primary" href="<?php eh(url('thread/reg_form')); ?>">Register</a></td>
	</tr>
</table>
</form>
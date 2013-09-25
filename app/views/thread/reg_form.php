<h1>User Registration</h1>

<?php if ($account->hasError()): ?>
<div class="alert alert-block">
	<h4 class="alert-heading">Validation error!</h4>
	<?php if (!empty($account->validation_errors['username']['length'])): ?>
		<div><em>Username</em> must be
		between
			<?php eh($account->validation['username']['length'][1]) ?> and
			<?php eh($account->validation['username']['length'][2]) ?> characters in length.
		</div>
	<?php endif ?>
	<?php if (!empty($account->validation_errors['password']['length'])): ?>
		<div><em>Your password</em> must be
		between
			<?php eh($account->validation['password']['length'][1]) ?> and
			<?php eh($account->validation['password']['length'][2]) ?> characters in length.
		</div>
	<?php endif ?>
</div>
<?php endif ?>

<form class="well" method="POST" action="<?php eh(url('')) ?>">
<table>
   <tr>
       <td>Username: </td><td><input type="text" name="username" value="<?php eh(Param::get('username'))?>"/></td>
   </tr>
   <tr>
	   <td>Password: </td><td><input type="password" name="password" /></td>
   </tr>
   <tr>
	   <input type="hidden" name="page_next" value="reg_complete">
	   <td></td><td><input type="submit" class="btn btn-primary" value="Register" name="register" />
	   <a class="btn btn-primary" href="<?php eh(url('thread/login')); ?>">Cancel</a></td>
   </tr>
</table>
</form>
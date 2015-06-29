<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
		<!-- Main jumbotron for a primary marketing message or call to action -->
		<div class="jumbotron">
			<div class="container">
				<h1>Elucidat LMS integration example</h1>
			</div>
		</div>

		<div class="container">
			<?php if (isset($_SESSION['message'])) { ?><div class="alert alert-success" role="alert"><?php echo $_SESSION['message'] ?></div><?php } ?>

			<?php if (count($accounts))	 { ?>
			<h2>Accounts</h2>
			<table class="table table-striped">
				<tr>
					<?php foreach ($accounts[0] as $k => $a) { ?>
					<th><?php echo $k ?></th>
					<?php } ?>
				</tr>
				<?php foreach ($accounts as $a) { ?>
				<tr>
					<?php foreach ($a as $k => $v) { ?>
					<td><a href="/accounts/view/<?php echo $a['id']?>"><?php echo $v ?></a></td>
					<?php } ?>
				</tr>
				<?php } ?>
			</table>
			<hr />	
			<?php } ?>
			
			<h2>Add an Account</h2>
			<form class="form" method="post" action="/accounts/add">

				<div class="form-group">
					<label for="company_name">Company Name:</label>
					<input name="company_name" type="text" class="form-control" id="company_name" placeholder="Jane Doe Inc.">
				</div>
				<div class="form-group">
					<label for="company_email">Company Email</label>
					<input name="company_email" type="text" class="form-control" id="company_email" placeholder="jane@doe.com">
				</div>
				<div class="form-group">
					<label for="telephone">Company Telephone</label>
					<input name="telephone" type="text" class="form-control" id="telephone" placeholder="1234">
				</div>
				<div class="form-group">
					<label for="first_name">Account Holder First Name</label>
					<input name="first_name" type="text" class="form-control" id="first_name" placeholder="Jane">
				</div>
				<div class="form-group">
					<label for="last_name">Account Holder Last Name</label>
					<input name="last_name" type="text" class="form-control" id="last_name" placeholder="Doe">
				</div>
				<div class="form-group">
					<label for="address1">Company Address (1)</label>
					<input name="address1" type="text" class="form-control" id="address1" placeholder="Address line 1">
				</div>
				<div class="form-group">
					<label for="address2">Company Address (2)</label>
					<input name="address2" type="text" class="form-control" id="address2" placeholder="Address line 2">
				</div>
				<div class="form-group">
					<label for="postcode">Postcode/Zip code</label>
					<input name="postcode" type="text" class="form-control" id="postcode" placeholder="Postcode/Zip code">
				</div>

				<div class="form-group">
					<label for="country">Country</label>
					<div class="form-control">
						<select name="country" id="country">
						<?php foreach ($countries as $key => $name) { ?><option value="<?php echo $key ?>"><?php echo $name ?></option>
						<?php } ?>
						</select>
					</div>
				</div>

				<button type="submit" class="btn btn-primary">Add Account</button>
			</form>

			<hr />	
			<h2>Webhooks</h2>
			<a href="webhook/subscribe_to_new_trials" class="btn btn-primary">Subscribe to new trials webhook</a>

			<p>&nbsp;</p>
		</div> <!-- /container -->
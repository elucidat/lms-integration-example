<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
		<!-- Main jumbotron for a primary marketing message or call to action -->
		<div class="jumbotron">
			<div class="container">
				<h1><?php echo $account['company_name'] ?> <small>LMS account</small></h1>
			</div>
		</div>

		<div class="container">
			<!-- Example row of columns -->
			
			<div class="well">
				<h2>Elucidat Account</h2>

				<?php if ($account['elucidat_public_key']) { ?>

				<button class="btn btn-primary">Get Elucidat account details</button>

				<?php } else if (count($users)) { ?>
				
				<form class="form" method="post" action="/accounts/create_elucidat_account/<?php echo $account['id'] ?>">
					<div class="form-group">
						<label for="account_owner">Account owner:</label>
						<select name="account_owner">
						<?php foreach ($users as $a) { ?>
							<option value="<?php echo $a['id'] ?>"><?php echo $a['email'] ?></option>
						<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="subscription_level">Subscription level:</label>
						<select name="subscription_level">
							<option value="enterprise">Enterprise</option>
							<option value="professional">Professional</option>
						</select>
					</div>
					<div class="form-group">
						<label for="num_authors">Number of authors:</label>
						<select name="num_authors">
						<?php for ($i = 1; $i <= 10; $i++) { ?>
							<option value="<?php echo $i ?>"><?php echo $i ?></option>
						<?php } ?>
						</select>
					</div>
					<button type="submit" class="btn btn-primary">Create Elucidat account</button>
				</form>

				<?php } else { ?>

				You must have at least one LMS user to create an Elucidat account.

				<?php } ?>

			</div>

			<div class="well">
				<h2>Add an LMS User</h2>
				<form class="form form-inline" method="post" action="/users/add/<?php echo $account['id'] ?>">
					<div class="form-group">
						<label for="first_name">First Name:</label>
						<input name="first_name" type="text" class="form-control" id="first_name" placeholder="Jane">
					</div>
					<div class="form-group">
						<label for="last_name">Last Name:</label>
						<input name="last_name" type="text" class="form-control" id="last_name" placeholder="Doe">
					</div>
					<div class="form-group">
						<label for="email">Email:</label>
						<input name="email" type="text" class="form-control" id="email" placeholder="jane@doe.com">
					</div>
					<button type="submit" class="btn btn-default">Add User</button>
				</form>

				<hr />
				
				<h2>LMS Users</h2>
				<table class="table table-striped">
					<?php if (count($users))	 { ?>
					<tr>
						<?php foreach ($users[0] as $k => $a) { ?>
						<th><?php echo $k ?></th>
						<?php } ?>
					</tr>
					<?php } ?>
					<?php foreach ($users as $a) { ?>
					<tr>
						<?php foreach ($a as $k => $v) { ?>
						<td><?php echo ($k == 'has_elucidat_access' ? ( $v ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>' ) : $v) ?></td>
						<?php } ?>
					</tr>
					<?php } ?>
				</table>
			</div>



			<div class="well">
				<h2>Elucidat Projects</h2>

				<?php if ($account['elucidat_public_key']) { ?>

				<button class="btn btn-primary">Get Elucidat projects</button>

				<?php } else { ?>

				You must have a linked Elucidat account to list projects.

				<?php } ?>

			</div>

		</div> <!-- /container -->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
		<!-- Main jumbotron for a primary marketing message or call to action -->
		<div class="jumbotron">
			<div class="container">
				<h1><?php echo $account['company_name'] ?> <small>LMS account</small></h1>
				<address>
					<strong>Address:</strong> <?php 
						$address = array();
						if ($account['address1']) $address[] = $account['address1'];
						if ($account['address2']) $address[] = $account['address2'];
						if ($account['postcode']) $address[] = $account['postcode'];
						if ($account['country']) $address[] = $account['country'];

					echo implode(', ',$address); ?><br />
					<strong>Phone:</strong> <?php echo $account['telephone'] ?><br />
					<strong>Email:</strong> <?php echo $account['company_email'] ?>
				</address>
			</div>
		</div>

		<div class="container">
			<?php if (isset($_SESSION['message'])) { ?><div class="alert alert-success" role="alert"><?php echo $_SESSION['message'] ?></div><?php } ?>
			
			<div class="well">
				<h2>Elucidat Account</h2>

				<?php if ($account['elucidat_public_key']) { ?>

				<pre><?php print_r($elucidat_account_data) ?></pre>

				<?php } else { ?>
				
				<form class="form" method="post" action="/accounts/create_elucidat_account/<?php echo $account['id'] ?>">
					<button type="submit" class="btn btn-primary">Create Elucidat account</button>
				</form>

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
				
				<?php if (count($users)) { ?>
				<h2>LMS Users</h2>
				<table class="table table-striped">
					<tr>
						<?php foreach ($users[0] as $k => $a) { ?>
						<th><?php echo $k ?></th>
						<?php } ?>
					</tr>
					<?php foreach ($users as $a) { ?>
					<tr>
						<?php foreach ($a as $k => $v) { if ($k != 'has_elucidat_access') { ?>
						<td><?php echo $v ?></td>
						<?php }} ?>
						<td>
							<?php if (!$account['elucidat_public_key']) { ?>
							&nbsp;
							<?php } else if ($a['has_elucidat_access']) { ?>
							<a class="btn btn-default" href="/users/change_elucidat_role/<?php echo $a['account_id']?>/<?php echo $a['id']?>/administrator">Change to Administrator</a><br />
							<a class="btn btn-default" href="/users/change_elucidat_role/<?php echo $a['account_id']?>/<?php echo $a['id']?>/editor">Change to Editor</a><br />
							<a class="btn btn-default" href="/users/revoke_elucidat_access/<?php echo $a['account_id']?>/<?php echo $a['id']?>">Revoke Elucidat access</a>
							<?php } else { ?>
							<a class="btn btn-default" href="/users/create_elucidat_account/<?php echo $a['account_id']?>/<?php echo $a['id']?>">Create user in Elucidat</a>
							<?php } ?>
						</td>
					</tr>
					<?php } ?>
				</table>
				<?php } ?>
			</div>

			<div class="well">
				<h2>Elucidat Projects</h2>

				<?php if ($account['elucidat_public_key']) { ?>

				<a href="/projects/index/<?php echo $account['id']?>" class="btn btn-primary">Get Elucidat projects</a>

				<?php } else { ?>

				You must have a linked Elucidat account to list projects.

				<?php } ?>

			</div>

		</div> <!-- /container -->
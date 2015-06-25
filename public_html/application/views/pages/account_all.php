<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
		<div class="container">
			<!-- Example row of columns -->
				
			<!-- Main jumbotron for a primary marketing message or call to action -->
			<div class="jumbotron">
				<div class="container">
					<h1>Elucidat LMS integration example</h1>
				</div>
			</div>

			<h2>Add an Account</h2>
			<form class="form form-inline" method="post" action="/accounts/add">
				<div class="form-group">
					<label for="company_name">Company Name:</label>
					<input name="company_name" type="text" class="form-control" id="company_name" placeholder="Jane Doe Inc.">
				</div>
				<!--
				<div class="form-group">
					<label for="company_email">Company Email</label>
					<input name="company_email" type="text" class="form-control" id="company_email" placeholder="jane@doe.com">
				</div>
				<div class="form-group">
					<label for="first_name">First Name</label>
					<input name="first_name" type="text" class="form-control" id="first_name" placeholder="Jane">
				</div>
				<div class="form-group">
					<label for="last_name">Last Name</label>
					<input name="last_name" type="text" class="form-control" id="last_name" placeholder="Doe">
				</div>-->
				<button type="submit" class="btn btn-default">Add Account</button>
			</form>

			<hr />
			
			<h2>Accounts</h2>
			<table class="table table-striped">
				<?php if (count($accounts))	 { ?>
				<tr>
					<?php foreach ($accounts[0] as $k => $a) { ?>
					<th><?php echo $k ?></th>
					<?php } ?>
				</tr>
				<?php } ?>
				<?php foreach ($accounts as $a) { ?>
				<tr>
					<?php foreach ($a as $k => $v) { ?>
					<td><a href="/accounts/view/<?php echo $a['id']?>"><?php echo $v ?></a></td>
					<?php } ?>
				</tr>
				<?php } ?>
			</table>

		</div> <!-- /container -->
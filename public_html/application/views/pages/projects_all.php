<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
		<!-- Main jumbotron for a primary marketing message or call to action -->
		<div class="jumbotron">
			<div class="container">
				<h1><?php echo $account['company_name'] ?> <small>Projects</small></h1>
			</div>
		</div>

		<div class="container">
			<?php if (isset($_SESSION['message'])) { ?><div class="alert alert-success" role="alert"><?php echo $_SESSION['message'] ?></div><?php } ?>

			<?php if (count($projects))	 { ?>
			<h2>Projects</h2>
			<table class="table table-striped">
				<tr>
					<th>&nbsp;</th>
					<?php foreach ($projects[0] as $k => $a) { 
						if ($k != 'edit_url') { ?>
					<th><?php echo $k ?></th>
					<?php }} ?>
				</tr>
				<?php foreach ($projects as $a) { ?>
				<tr>
					<td>
						<a class="btn btn-primary" href="/releases/index/<?php echo $account['id']?>/<?php echo $a['project_code']?>">View releases</a><br />
						<?php 
							// get a random user
							$u = $users[array_rand($users)];
						?>
						<a class="btn btn-default" href="/users/single_sign_on/<?php echo $account['id']?>/<?php echo $u['id']?>?url=<?php echo urlencode($a['edit_url']) ?>">Editing deeplink<br /><small>as <?php echo $u['email']?></small></a>
					</td>

					<?php foreach ($a as $k => $v) { 
						if ($k != 'edit_url') { ?>
					<td><?php echo $v ?></td>
					<?php }} ?>
				</tr>
				<?php } ?>
			</table>
			<?php } ?>


			<p>&nbsp;</p>
		</div> <!-- /container -->
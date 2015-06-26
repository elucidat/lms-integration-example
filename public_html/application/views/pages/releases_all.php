<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
		<!-- Main jumbotron for a primary marketing message or call to action -->
		<div class="jumbotron">
			<div class="container">
				<h1><?php echo $account['company_name'] ?> <small>Releases</small></h1>
			</div>
		</div>

		<div class="container">
			<?php if (isset($_SESSION['message'])) { ?><div class="alert alert-success" role="alert"><?php echo $_SESSION['message'] ?></div><?php } ?>

			<?php if (count($releases))	 { ?>
			<h2>Releases</h2>
			<table class="table table-striped">
				<tr>
					<th>&nbsp;</th>
					<?php foreach ($releases[0] as $k => $a) { ?>
					<th><?php echo $k ?></th>
					<?php } ?>
				</tr>
				<?php foreach ($releases as $a) { ?>
				<tr>
					<td>
						<?php if ($a['release_mode'] == 'scorm' || $a['release_mode'] == 'offline-backup') { ?>
						<a class="btn btn-default" href="/releases/download/<?php echo $account['id']?>/<?php echo $a['release_code']?>">Download SCORM file</a>
						<?php } else if ($a['release_mode'] == 'online-public') { 
							// get a random user
							$u = $users[array_rand($users)];
							?>
						<a class="btn btn-default" href="/releases/launch/<?php echo $account['id']?>/<?php echo $a['release_code']?>/<?php echo $u['id']?>">Launch course<br /><small>as <?php echo $u['email']?></small></a>
						<?php } ?>
					</td>
					
					<?php foreach ($a as $k => $v) { ?>
					<td><?php echo $v ?></td>
					<?php } ?>
				</tr>
				<?php } ?>
			</table>
			<hr />
			<?php } ?>

			<h2>Add a Release</h2>
			<a class="btn btn-default" href="/releases/add/<?php echo $account['id']?>/<?php echo $project_code?>">Create a release</a>

		</div> <!-- /container -->
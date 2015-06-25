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

			<?php if (count($projects))	 { ?>
			<h2>Projects</h2>
			<table class="table table-striped">
				<tr>
					<?php foreach ($projects[0] as $k => $a) { ?>
					<th><?php echo $k ?></th>
					<?php } ?>
				</tr>
				<?php } ?>
				<?php foreach ($projects as $a) { ?>
				<tr>
					<?php foreach ($a as $k => $v) { ?>
					<td><a href="/projects/view/<?php echo $a['id']?>"><?php echo $v ?></a></td>
					<?php } ?>
				</tr>
			</table>
			<?php } ?>


		</div> <!-- /container -->
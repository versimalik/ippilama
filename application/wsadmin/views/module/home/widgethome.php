<div class="invisible" id="main-widget-container">
    <div class="col-xs-12 col-sm-6 widget-container-col" id="widget-container-col-2">
		<div class="widget-box widget-color-blue" id="widget-box-2">
			<div class="widget-header">
				<h5 class="widget-title bigger lighter">
					<i class="ace-icon fa fa-home"></i>
					<strong>Lates Article</strong>
				</h5>
			</div>

			<div class="widget-body">
				<div class="widget-main no-padding">
					<table class="table table-striped table-bordered table-hover">
						<tbody>
							<?php if(!empty($artData)){ ?>
								<?php foreach ($artData as $key => $val) { ?>
									<tr>
										<td class=""><i class="ace-icon fa fa-circle-o" style="color: #307ecc;"></i>&nbsp;&nbsp;&nbsp;<?php echo $val['ws_article_title']; ?></td>
									</tr>
								<?php } ?>
							<?php } ?>
						
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div><!-- /.span -->

	<div class="col-xs-12 col-sm-6 widget-container-col" id="widget-container-col-2">
		<div class="widget-box widget-color-red" id="widget-box-2">
			<div class="widget-header">
				<h5 class="widget-title bigger lighter">
					<i class="ace-icon glyphicon glyphicon-book"></i>
					<strong>Lates Event</strong>
				</h5>
			</div>

			<div class="widget-body">
				<div class="widget-main no-padding">
					<table class="table table-striped table-bordered table-hover">
						<tbody>
							<?php if(!empty($eveData)){ ?>
								<?php foreach ($eveData as $key => $val) { ?>
									<tr>
										<td class=""><i class="ace-icon fa fa-circle-o" style="color: #e2755f;"></i>&nbsp;&nbsp;&nbsp;<?php echo $val['ws_event_title']; ?></td>
									</tr>
								<?php } ?>
							<?php } ?>
						
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div><!-- /.span -->

</div><!-- /.row -->

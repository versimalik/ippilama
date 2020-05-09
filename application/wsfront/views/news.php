<div class="post_section clearfix">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-8 post_left">
						<div class="post_left_section post_left_border">

						<?php if(!empty($article)){ ?>
							<?php foreach ($article as $key => $val) { ?>
							<div class="post list-content">
								<div class="post_thumb">
									<a href="<?php echo base_url('news/read/'.$val['ws_article_slug']); ?>">
										<div style="width:719; height:420;">
										<img src="<?php echo base_url('picture/article/'.$val['ws_article_id'].'/zoom_xtra_'.$val['ws_article_image_path']); ?>" alt="<?php echo $val['ws_article_title']; ?>" />
										</div>
									</a>
								</div>
								<!--end post thumb-->
								<div class="meta">
									<!-- <span class="author">By: <a href="single-post-right-sidebar.html">Alexandra Jenmi</a></span> -->
									<!-- <span class="category"> <a href="single-post-right-sidebar.html">Indesign</a></span> -->
									<span class="date">Posted : <a href="#"><?php echo tanggal_indo(date('d-m-Y',$val['ws_article_date_create']), true); ?></a></span>
								</div>
								<!--end meta-->
								<h1><a href="<?php echo base_url('news/read/'.$val['ws_article_slug']); ?>"><?php echo $val['ws_article_title']; ?></a></h1>
								<div class="post_desc">
									<?php echo $val['ws_article_summary']; ?>
								</div>
								<!--end post bottom-->
							</div>
							<?php }?>
						<?php }?>

						<?php 
							if(!empty($pagination)){
								echo $pagination;
							}else{
								echo '<ul class="pagination"><li class="active"><a href="javascrip::void();">1</a></li></ul>';
							}
						?>
						</div><!--end post left section-->
					</div>
			<!--end post_left-->
			<div class="col-xs-12 col-sm-4 post_right">
				<div class="post_right_inner">
					<div class="related_post_sec">
						<!--
						<div class="list_block">
							<h3>Latest News</h3>
							<ul>
								<li>
									<span class="rel_thumb">
										<img src="<?php echo base_url('assets/wsfront'); ?>/img/news/rel_thumb.png" alt="" />
									</span>
									<div class="rel_right">
										<a href="single-post-right-sidebar.html"><h4>Offered in small class sizes with great emphasis...</h4></a>
										<span class="date">Posted: <a href="single-post-right-sidebar.html">January 24, 2015</a></span>
									</div>
								</li>
								<li>
									<span class="rel_thumb">
										<img src="<?php echo base_url('assets/wsfront'); ?>/img/news/rel_thumb.png" alt="" />
									</span>
									<div class="rel_right">
										<a href="single-post-right-sidebar.html"><h4>Offered in small class sizes with great emphasis...</h4></a>
										<span class="date">Posted: <a href="single-post-right-sidebar.html">January 24, 2015</a></span>
									</div>
								</li>
								<li>
									<span class="rel_thumb">
										<img src="<?php echo base_url('assets/wsfront'); ?>/img/news/rel_thumb.png" alt="" />
									</span>
									<div class="rel_right">
										<a href="single-post-right-sidebar.html"><h4>Offered in small class sizes with great emphasis...</h4></a>
										<span class="date">Posted: <a href="single-post-right-sidebar.html">January 24, 2015</a></span>
									</div>
								</li>
							</ul>
							<a href="#" class="more_post">More</a>
						</div>
						-->

						<?php if(!empty($event)){ ?>
				        <div class="list_block">
							<div class="upcoming_events">
				            	<h3>Event Terbaru</h3>
				            	<ul>
				              		<?php foreach ($event as $key => $val) { ?>
				              		<li class="related_post_sec single_post">
					                	<span class="date-wrapper">
					                  	<span class="date"><span><?php echo date('d',strtotime($val['ws_event_date'])); ?></span><?php echo date('F',strtotime($val['ws_event_date'])); ?></span>
					                	</span>
					               		<div class="rel_right">
						                  	<h4><a href="<?php echo base_url('event/read/'.$val['ws_event_slug']); ?>"><?php echo $val['ws_event_title']; ?></a></h4>
							                <div class="meta meta-event">
							                    <span class="event-time"><i class="fa fa-clock-o"></i><?php echo date('H:i',strtotime($val['ws_event_date'])); ?> WIB</span>
							                </div>
					                	</div>
					                	<div class="h30"></div>
				              		</li>
				           			<?php } ?>
				           		</ul>
				            	<a href="<?php echo base_url('event'); ?>" class="btn btn-default btn-block commonBtn">Selengkapnya</a>
				          	</div>
				        </div>
				        <?php } ?>

				        <div class="list_block">
						<h3>Facebook</h3>
						<div class="facebook_section">
							<img src="<?php echo base_url('assets/wsfront'); ?>/img/news/facebook.png" alt="" />
						</div>
						<!--end facebook section-->
						</div>
						<!-- end list_block -->
						<div class="list_block">
							<h3>Twitter</h3>
							<div class="twitter_section">
								<img src="<?php echo base_url('assets/wsfront'); ?>/img/news/twitter.png" alt="" />
							</div>
							<!--end facebook section-->
						</div>
					
				        <!--
						<div class="list_block">
							<div class="formTitle news">
								<h3 class="extraPadding">"Getting into..." University Guides</h3>
								<p class="reduceMargin">Offered in small class sizes with great emphasis on the demands of the specification and exam technique.</p>
								<div class="getImage clearfix">
									<img alt="" src="<?php echo base_url('assets/wsfront'); ?>/img/home/get_image_1.png" />
								</div>
								<button class="btn btn-default btn-block commonBtn" type="submit">Get It Now</button>
							</div>
						</div>
						-->
						<!--
						<div class="list_block">
							<div class="newsletter">
								<h3>Newsletter</h3>
								<form action="#" method="post">
									<div class="form-group">
										<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Email">
									</div>
									<button type="submit" class="btn btn-default btn-block commonBtn">Subscribe</button>
								</form>
							</div>
						</div>
						-->
						<!-- formArea -->
					</div>
					<!--end related_post_sec-->
				</div>
				<!--end post right inner-->
			</div>
			<!--end post_right-->
		</div>
	</div>
</div>
<!--end post section-->
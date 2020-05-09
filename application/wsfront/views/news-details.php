<?php if(!empty($detail)){ ?>
<div class="post_section">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-8 post_left">
				<div class="post_left_section post_left_border">
					<div class="post single_post content">
					<?php if ($table == 'article') { ?>
						<div class="post_thumb">
							<img src="<?php echo base_url('picture/article/'.$detail[0]['ws_article_id'].'/zoom_xtra_'.$detail[0]['image'][0]['ws_article_image_path']); ?>" alt="" />
						</div>
						<!--end post thumb-->
						<div class="meta">
							<!-- <span class="author">By: <a href="#">Alexandra Jenmi</a></span> -->
							<!-- <span class="category"> <a href="#">Indesign</a></span> -->
							<span class="date">Posted : <a href="#"><?php echo tanggal_indo(date('d-m-Y',$detail[0]['ws_article_date_create']), true); ?></a></span>
						</div>
						<!--end meta-->
						<h1><?php echo $detail[0]['ws_article_title']; ?></h1>
						<div class="post_desc"><?php echo $detail[0]['ws_article_desc']; ?></div>
					<?php } else { ?>
						<div class="post_thumb">
							<img src="<?php echo base_url('picture/event/'.$detail[0]['ws_event_id'].'/zoom_xtra_'.$detail[0]['image'][0]['ws_event_image_path']); ?>" alt="" />
						</div>
						<!--end post thumb-->
						<div class="meta">
							<!-- <span class="author">By: <a href="#">Alexandra Jenmi</a></span> -->
							<!-- <span class="category"> <a href="#">Indesign</a></span> -->
							<span class="date">Posted : <a href="#"><?php echo tanggal_indo(date('d-m-Y',$detail[0]['ws_event_date_create']), true); ?></a></span>
						</div>
						<!--end meta-->
						<h1><?php echo $detail[0]['ws_event_title']; ?></h1>
						<div class="post_desc"><?php echo $detail[0]['ws_event_desc']; ?></div>

					<?php } ?>
						<!--end post desc-->
						<!--
						<div class="post_bottom">
							<ul>
								<li class="like">
									<a href="#">
										<img src="<?php echo base_url('assets/wsfront'); ?>/img/news/like_icon.png" alt="" />
										<span>12</span>
									</a>
								</li>
								<li class="share">
									<a href="#">
										<img src="<?php echo base_url('assets/wsfront'); ?>/img/news/share_icon.png" alt="" />
										<span>12</span>
									</a>
								</li>
								<li class="favorite">
									<a href="#">
										<img src="<?php echo base_url('assets/wsfront'); ?>/img/news/favorite_icon.png" alt="" />
										<span>12</span>
									</a>
								</li>
							</ul>
						</div>
						-->
						<!--end post bottom-->
					</div>
					<!--end post-->
					<div class="related_post_sec single_post">
						<h3>Related Posts</h3>
						<ul>
						<?php if ($table == 'article') { ?>
							<?php foreach ($article as $art) { ?>
							<li>
								<span class="rel_thumb">
									<a href=""><img src="<?php echo base_url('picture/article/'.$art['ws_article_id'].'/zoom_xtra_'.$art['ws_article_image_path']); ?>" alt=""></a>
								</span>
								<!--end rel_thumb-->
								<div class="rel_right">
									<h4><a href="<?php echo base_url('news/read/'.$art['ws_article_slug']); ?>"><?php echo $art['ws_article_title']; ?></a></h4>
									<div class="meta">
										<span class="author">By: <a href="#">Alexandra Jenmi</a></span>
										<span class="category"> <a href="#">Indesign</a></span>
										<span class="date">Posted: <a href="#"><?php echo tanggal_indo(date('d-m-Y',$art['ws_article_date_create']), true); ?></a></span>
									</div>
									<p><?php echo word_limiter($art['ws_article_summary'], 20); ?></p>
								</div>
								<!--end rel right-->
							</li>
							<?php } ?>
						<?php } else { ?>
							<?php foreach ($event as $ev) { ?>
							<li>
								<span class="rel_thumb">
									<a href=""><img src="<?php echo base_url('picture/event/'.$ev['ws_event_id'].'/zoom_xtra_'.$ev['ws_event_image_path']); ?>" alt=""></a>
								</span>
								<!--end rel_thumb-->
								<div class="rel_right">
									<h4><a href="<?php echo base_url('event/read/'.$ev['ws_event_slug']); ?>"><?php echo $ev['ws_event_title']; ?></a></h4>
									<div class="meta">
										<span class="author">By: <a href="#">Alexandra Jenmi</a></span>
										<span class="category"> <a href="#">Indesign</a></span>
										<span class="date">Posted: <a href="#"><?php echo tanggal_indo(date('d-m-Y',$ev['ws_event_date_create']), true); ?></a></span>
									</div>
									<p><?php echo word_limiter($ev['ws_event_summary'], 20); ?></p>
								</div>
								<!--end rel right-->
							</li>
							<?php } ?>
						</ul>
						<?php } ?>
					</div>
					<!--end single_post-->
					<!--end comments section-->
				</div>
				<!--end post left section-->
			</div>
			<!--end post_left-->
			
			<div class="col-xs-12 col-sm-4 post_right">
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
									<a href="news.html"><h4>Offered in small class sizes with great emphasis...</h4></a>
									<span class="date">Posted: <a href="#">January 24, 2015</a></span>
								</div>
							</li>
							<li>
								<span class="rel_thumb">
									<img src="<?php echo base_url('assets/wsfront'); ?>/img/news/rel_thumb.png" alt="" />
								</span>
								<div class="rel_right">
									<a href="news.html"><h4>Offered in small class sizes with great emphasis...</h4></a>
									<span class="date">Posted: <a href="#">January 24, 2015</a></span>
								</div>
							</li>
							<li>
								<span class="rel_thumb">
									<img src="<?php echo base_url('assets/wsfront'); ?>/img/news/rel_thumb.png" alt="" />
								</span>
								<div class="rel_right">
									<a href="news.html"><h4>Offered in small class sizes with great emphasis...</h4></a>
									<span class="date">Posted: <a href="#">January 24, 2015</a></span>
								</div>
							</li>
							<li>
								<span class="rel_thumb">
									<img src="<?php echo base_url('assets/wsfront'); ?>/img/news/rel_thumb.png" alt="" />
								</span>
								<div class="rel_right">
									<a href="news.html"><h4>Offered in small class sizes with great emphasis...</h4></a>
									<span class="date">Posted: <a href="#">January 24, 2015</a></span>
								</div>
							</li>
						</ul>
						<a href="#" class="more_post">More</a>
					</div>
					-->
					
					<!-- end list_block -->
					<?php if(!empty($event)){ ?>
					<div class="list_block">
						<div class="upcoming_events">
							<h3>Event Lainnya</h3>
							<ul>
								<?php foreach ($event as $key => $val) { ?>
				              	<li class="related_post_sec single_post">
									<span class="date-wrapper">
										<span class="date"><span><?php echo date('d',strtotime($val['ws_event_date'])); ?></span><?php echo date('F',strtotime($val['ws_event_date'])); ?></span>
									</span>
									<div class="rel_right">
										<h4><a href="<?php echo base_url('event/read/'.$val['ws_event_slug']); ?>"><?php echo $val['ws_event_title']; ?></a></h4>
										<div class="meta">
											<span class="event-time"><i class="fa fa-clock-o"></i><?php echo date('H:i',strtotime($val['ws_event_date'])); ?> WIB</span>
										</div>
									</div>
									<div class="h30"></div>
								</li>		
								<?php } ?>
							</ul>
							<a href="<?php echo base_url('event'); ?>" class="btn btn-default btn-block commonBtn">More Events</a>
						</div>
					</div>
					<?php } ?>
					<!-- end list_block -->
					<div class="list_block">
						<h3>Facebook</h3>
						<div class="facebook_section">
							<img src="<?php echo base_url('assets/wsfront'); ?>/img/news/facebook.png" alt="" />
						</div>
					</div>
					
					<div class="list_block">
						<h3>Twitter</h3>
						<div class="twitter_section">
							<img src="<?php echo base_url('assets/wsfront'); ?>/img/news/twitter.png" alt="" />
						</div>
					
					</div>
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
					<!-- end list_block -->
				</div>
				<!--end related_post_sec-->
			</div>
			<!--end post_right-->
		</div>
	</div>
</div>
<?php } ?>
<!--end post section-->
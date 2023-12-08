<?php
/*
Template Name: Спец.Страницы (КЛ и тд.)
*/
if ( is_user_logged_in() ) {
		get_header(); ?>

					<!--section-->
					<div class="col-md-9 col-xs-12">
						<div class="section">
							<?php dynamic_sidebar( 'header-block' ); ?>
							
							<!--hotnews-->
							<div class="block">
								<?php while ( have_posts() ) : the_post(); ?>
									<div class="block__title">
										<span><? the_title(); ?></span>
									</div>
									<?php the_content(); ?>

									<?php 
										global $current_user;
										get_currentuserinfo();

										$comments = get_commetns_user(get_current_user_id());
										$comments_count = 0;
										$karma = 0;
										ob_start();
										foreach ($comments as $comment) { 

											$post_type = get_post_type( $comment->comment_post_ID );

											if($post_type == 'video_post') continue;

											$comments_count++;
											$karma_loc = 0;

											$karma += get_comment_meta($comment->comment_ID, 'Likes', true) ? get_comment_meta($comment->comment_ID, 'Likes', true) : 0;
											$karma_loc +=  get_comment_meta($comment->comment_ID, 'Likes', true) ? get_comment_meta($comment->comment_ID, 'Likes', true) : 0;
											$karma -= get_comment_meta($comment->comment_ID, 'Dislikes', true) ? get_comment_meta($comment->comment_ID, 'Dislikes', true) : 0;
											$karma_loc -=  get_comment_meta($comment->comment_ID, 'Dislikes', true) ? get_comment_meta($comment->comment_ID, 'Dislikes', true) : 0;

											$comm_link = get_comment_link( $comment->comment_ID ); ?>
											<div class="profile_comment_self">
												<a class="profile_comment_self__title" href="<?php the_permalink($comment->comment_post_ID) ?>"><span><?php echo get_the_title($comment->comment_post_ID) ?></span></a>
												<div class="vote vote--comment">
													<div class="vote__value t-ff-1-500 t-fs-14 l-va-middle">
														<span><?php echo $karma_loc ?></span>
													</div>
												</div>
												<div class="profile_comment_self__text">
													<p><?php echo $comment->comment_content; ?></p>
												</div><a class="profile_comment_self__date t-link" href="<?php echo $comm_link; ?>">
													<span><?php echo human_time_diff(get_comment_date('U'), current_time('timestamp')) ?> назад</span>
												</a>
											</div>
										<?php }

										$comments_html = ob_get_contents();
										ob_end_clean();

										$comments = get_commetns_user(get_current_user_id());
										$comments_video_count = 0;
										$karma = 0;
										ob_start();
										foreach ($comments as $comment) { 

											$post_type = get_post_type( $comment->comment_post_ID );

											if($post_type != 'video_post') continue;

											$comments_video_count++;
											$karma_loc = 0;

											$karma += get_comment_meta($comment->comment_ID, 'Likes', true) ? get_comment_meta($comment->comment_ID, 'Likes', true) : 0;
											$karma_loc +=  get_comment_meta($comment->comment_ID, 'Likes', true) ? get_comment_meta($comment->comment_ID, 'Likes', true) : 0;
											$karma -= get_comment_meta($comment->comment_ID, 'Dislikes', true) ? get_comment_meta($comment->comment_ID, 'Dislikes', true) : 0;
											$karma_loc -=  get_comment_meta($comment->comment_ID, 'Dislikes', true) ? get_comment_meta($comment->comment_ID, 'Dislikes', true) : 0;

											$comm_link = get_comment_link( $comment->comment_ID ); ?>
											<div class="profile_comment_self">
												<a class="profile_comment_self__title" href="<?php the_permalink($comment->comment_post_ID) ?>"><span><?php echo get_the_title($comment->comment_post_ID) ?></span></a>
												<div class="vote vote--comment">
													<div class="vote__value t-ff-1-500 t-fs-14 l-va-middle">
														<span><?php echo $karma_loc ?></span>
													</div>
												</div>
												<div class="profile_comment_self__text">
													<p><?php echo $comment->comment_content; ?></p>
												</div><a class="profile_comment_self__date t-link" href="<?php echo $comm_link; ?>">
													<span><?php echo human_time_diff(get_comment_date('U'), current_time('timestamp')) ?> назад</span>
												</a>
											</div>
										<?php }

										$comments_video_html = ob_get_contents();
										ob_end_clean();

										$notifications_count = 0;
										ob_start();
										$query = new WP_Query([
											'post_type' => 'notifications',
											'posts_per_page' => 0,
											'author' => get_current_user_id()
										]);
										
										while ( $query->have_posts() ) {
											$query->the_post();
											$notifications_count++; ?>
											<div class="profile_comment_self">
												<a class="profile_comment_self__title" href="<?php the_permalink( get_post_meta(get_the_id(), 'page_id', true) ) ?>">
													<span><?php echo get_the_title( get_post_meta(get_the_id(), 'page_id', true) ) ?></span>
												</a>
												
												<div class="profile_comment_self__text">
													<?php the_content(); ?>
												</div>
												<a href="#" class="remove_notification" data-id="<?php the_ID(); ?>">Удалить</a>
											</div>
											<?php
										}
									
										$notifications_html = ob_get_contents();
										ob_end_clean();
										wp_reset_postdata();
										$photo = get_user_meta(get_current_user_id(), 'ulogin_photo', 1); 

										// var_dump($photo);
									?>
									<div class="user-info"> 
										<div class="profile__user">
											<div class="avarat">
												<?php 
													if($photo) {
														echo "<img src='".$photo."'>";
													} else {
														echo get_avatar( get_current_user_id(), 100 ); 	
													}
													
												?>
												<span class="user-karma"><?php echo $karma; ?></span>
												<span class="user-name"><?php echo $current_user->user_login ?></span>
											</div>
											<div class="ui_navigation l-mb-20 lm-hidden lt-hidden">
												<a href="#" class="ui_navigation__item active" data-action="comment"> Комментарии записей
													<span><?php echo $comments_count ?></span> 
												</a> 
												<a href="#" class="ui_navigation__item" data-action="comment_video"> Комментарии видео
													<span><?php echo $comments_video_count ?></span> 
												</a> 
												<a href="#" class="ui_navigation__item" data-action="get_favorite_comment"> Избранное 
													<span><?php echo get_favorite_comment_count(); ?></span> 
												</a> 
												<a href="#" class="ui_navigation__item" data-action="notifications"> Уведомления 
													<span><?php echo $notifications_count ?></span> 
												</a> 
											</div>
										</div>
										<div class="user-content">
											<div class="comments_list">
												<div class="profile__header">
													<span class="title"><?php echo declOfNum($comments_count, ['комментарий', 'комментария', 'комментариев']) ?></span>
												</div>
												<?php echo $comments_html; ?>
											</div>
											<div class="comments_list_video">
												<div class="profile__header">
													<span class="title"><?php echo declOfNum($comments_video_count, ['комментарий', 'комментария', 'комментариев']) ?></span>
												</div>
												<?php echo $comments_video_html; ?>
											</div>
											<div class="notifications_list">
												<div class="profile__header">
													<span class="title"><?php echo declOfNum($notifications_count, ['уведомление', 'уведомления', 'уведомлений']) ?></span>
												</div>
												<?php echo $notifications_html; ?>
											</div>
											<div class="content-ajax"></div>
										</div>
									</div>
									
									
								<?php endwhile; // End of the loop. ?>
							</div>
						</div>
					</div>
					<!--/section-->
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
		<!--/main-->
	<?php get_footer(); 
	
} else { wp_redirect(wp_login_url(), 302); }
?>
<?php
/**
 * The template for displaying all pages.

 */

get_header(); ?>
<!--section-->
				<div class="col-md-9 col-xs-12">
					<div class="section">
						<?php dynamic_sidebar( 'header-block' ); ?>
						<?  $category = get_queried_object();  $category_ID = $category->term_id; ?>
						<? $descr_top = get_metadata('term', $category->term_id, 'txseo_seo_top_description', 1 ); ?>
						<? if ($descr_top) { ?>
								<div class="block">
									<div class="article">
										<div class="article__body">
											<?php echo $descr_top; // выводим нижнее описание тега ?>
										</div>
									</div>
								</div>
						<? } ?>
					<div class="block news">
							<?php if ( have_posts() ) : ?>
									<div class="block__title">
										<? the_archive_title( '<div class="page-title"><span>', '</span></div>' ); ?>
									</div>
										<?php /* the_archive_description( '<div class="taxonomy-description">', '</div>' ); */ ?>
							<?php endif; ?>
									
							<div class="posts posts_borderbottom posts_flex">
								<?php
									if ( have_posts() ) : ?>
										<?php
										/* Start the Loop */
										while ( have_posts() ) : the_post();

											?>
                                            <div class="hu posts__item news__item posts__item_col posts__item_col-two posts__item_flex">
                                                <a href="<?php the_permalink(); ?>" title="<?=the_title()?>">
                                                <?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) { ?>
                                                    <div class="posts__thumbnail news__thumbnail">
                                                        <?php the_post_thumbnail( 'post-list-thumb' ); ?>

                                                        <div class="posts__thumbnail__permalink">Показать полностью</div>
                                                    </div>
                                                <?php } ?>
                                                    <? the_title( '<div class="posts__title news__title posts__title_bold">', '</div>' ); ?>
                                                </a>

                                                <div class="posts__excerpt">
                                                    <? the_excerpt(); ?>
                                                </div>
                                                <div class="posts__data-flex">
                                                    <div class="posts__meta posts__meta_static alignleft">
                                                        <span class="comment-ico view-ico_gray"><?php echo get_post_meta ($post->ID,'views',true); ?></span>
                                                        <span class="view-ico comment-ico_gray"><?php comments_number('0', '1', '%'); ?></span>
                                                    </div>
                                                    <div class="alignright posts__data">
                                                        <?php /* the_author(); */ ?> <?php  echo get_the_date('d F Y'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?

										endwhile;
/*
										the_posts_pagination( array(
											'prev_text' => twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'twentyseventeen' ) . '</span>',
											'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'twentyseventeen' ) . '</span>' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ),
											'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyseventeen' ) . ' </span>',
										) );
*/
									else :

//										get_template_part( 'template-parts/post/content', 'none' );

									endif; ?>
									
							</div>
							
							<? the_posts_pagination( array('screen_reader_text' => ' ', 'mid_size'     => 9, ) ); ?>
					</div>
							<? /* ДОБАВОЧНЫЕ ВИДЖЕТЫ */ ?>
							<? if ($category_ID==42) { ?>
								<? echo do_shortcode('[on_tags_news_in_home]'); ?>
							<? } ?>
								<? /* echo do_shortcode("[on_samie_hot_news_in_home]"); */ ?>
							
							<? $descr_down = get_metadata('term', $category->term_id, 'txseo_seo_down_description', 1 );
							if ($descr_down) { ?>
								<div class="block">
									<div class="article">
										<div class="article__body" style="border-bottom: 0 solid #b8b8b8;">
											<?php echo $descr_down; // выводим нижнее описание тега ?>
										</div>
									</div>
								</div>
							<? } ?>
							<!--reviews-->
							<div class="block">
								<div class="block__title">
									<span>Последние комментарии</span>
								</div>
								<div class="row">
									<div class="col-sm-12 col-xs-12 ">
										<div id="recentcomments" class="dsq-widget">
											<script type="text/javascript" src="https://vr-journal.disqus.com/recent_comments_widget.js?num_items=5&hide_avatars=0&avatar_size=32&excerpt_length=200"></script>
										</div>
									</div>
								</div>
			<!--				<div class="more more_border">
									<a href="#" class="more__link">Показать еще отзывы</a>
								</div> -->
							</div>
					<!--/reviews-->
				</div>
			</div>

	<?php get_sidebar(); ?>
<?php get_footer(); ?>

<?php
/**
 * The template used for displaying page content in page.php

 */

?>
							<div class="article 2">
								<? the_title( '<h1 class="article__title">', '</h1>' ); ?>
								<div class="article__body">
									<?php the_content(); ?>

									<strong>Подписывайтесь на наш</strong> <a href="https://t.me/VR_Journal">Telegram</a>
										<div class="posts__data">
													<?php the_tags(); ?>
										</div>

										<?php if( get_field('source_link', get_the_ID()) ) { ?>
											<noindex>
												<span class="show_source_link">Источник</span>
												<a class="source_link" target="_blank" rel="nofollow" href="<?php the_field('source_link') ?>"><?php the_field('source_link') ?></a>
											</noindex>
										<?php } ?>
										
								</div>
												<div class="alignright posts__data posts__data_big">
													<?php  the_author(); ?>, <?php  echo get_the_date('d F Y'); ?>
												</div>
												
								<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
								<script src="//yastatic.net/share2/share.js"></script>
                                <style>
                                    .ya-share2__container_size_m .ya-share2__icon {
                                        background-size: 30px 30px !important;
                                    }
                                </style>
								<div class="posts__data posts__data_big">Поделитесь с друзьями: <div class="ya-share2" data-services="vkontakte,facebook,twitter,telegram"></div></div>

								
							</div>
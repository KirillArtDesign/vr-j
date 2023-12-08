<?php
/**
 * The template used for displaying page content in page.php

 */

?>
							<div class="article">
								<? the_title( '<h1 class="article__title">', '</h1>' ); ?>
								<div class="article__body">
									<?php the_content(); ?>
								</div>
							</div>
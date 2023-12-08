<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package ULIT-BLOG
 */

get_header(); ?>

				<!--section-->
				<div class="col-md-9 col-xs-12">
					<div class="section">
											<!--hotnews-->
						<div class="block">
							<div class="block__title">
								<span>Страница временно не доступна</span>
							</div>
								
						</div>
						
					</div>
				</div>
				<!--/section-->
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
	<!--/main-->
<?php get_footer(); ?>
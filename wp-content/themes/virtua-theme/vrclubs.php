<?php
/**
 * Template Name: VR Клубы
 * Template Post Type: post, page
 */

 get_header();
?>
<div class="col-xs-12">
    <div>

        <?php
            $geo = get_user_geo();
            $loc = if_location_exist($geo);
            $country_id = 1586;
            $city_id = 1589;
            if($loc) {
                $country_id = $loc->parent;
                $city_id = $loc->term_id;
            }
        ?>
    </div>
    <div class="vrclubs">
        <div class="vrfilter">
            <?php
                $locations = get_terms( 'location', [
                    'hide_empty' => false,
                ] );
                $cats = get_terms( 'vrcategory', [
                    'hide_empty' => true,
                ] );
            ?>
            <div class="vrfilter__cols">
                <div class="vrfilter__col">
                    <label class="vrfilter__label">Страна</label>
                    <select class="vrfilter__select vrfilter__loc">
                        <?php foreach($locations as $location): ?>
                            <?php if($location->parent == 0): ?>
                                <?php $select = $location->term_id == $country_id ? ' selected="selected"' : ''; ?>
                                <option<?php echo $select; ?> value="<?php echo $location->term_id; ?>" data-url="<?php echo $location->slug; ?>"><?php echo $location->name; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="vrfilter__col">
                    <label class="vrfilter__label">Город</label>
                    <select class="vrfilter__select vrfilter__loc2">
                        <?php foreach($locations as $location): ?>
                            <?php if($location->parent > 0 and $location->parent == $country_id): ?>
                                <?php $select = $location->term_id == $city_id ? ' selected="selected"' : ''; ?>
                                <option<?php echo $select; ?> value="<?php echo $location->term_id; ?>" data-url="<?php echo $location->slug; ?>" data-parent="<?php echo $location->parent; ?>"><?php echo $location->name; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <?php
                    $metros = get_metro_stations_by_loc($city_id);
                    if($metros):
                ?>
                    <div class="vrfilter__col">
                        <label class="vrfilter__label">Метро</label>
                        <div class="vrfilter__select vrfilter__loc4 js-cselect">
                            <div class="cselect__info">Станция метро</div>
                            <div class="cselect__dropdown">
                                <input type="text" class="cselect__filter">
                                <ul class="cselect__list">
                                    <?php foreach($metros as $metro): ?>
                                        <li><label><input type="checkbox"><span><?php echo $metro; ?></span></label></li>
                                        <?php endforeach;?>
                                    </ul>
                                    <button class="cselect__clear">Очистить</button>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                <div class="vrfilter__col">
                    <label class="vrfilter__label">Категория</label>
                    <select class="vrfilter__select vrfilter__loc3">
                        <option value="0">Выбрать</option>
                        <?php foreach($cats as $cat): ?>
                            <option value="<?php echo $cat->term_id; ?>" data-url="<?php echo $cat->slug; ?>"><?php echo $cat->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
      
            <button class="vrfilter__submit btn_blue">Найти</button>
   
        </div>   
        <div class="vrclubs__list">
            <?php

                $the_query = new WP_Query([
                    'post_type' => 'vrclubs',
                    'posts_per_page' => -1,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'location',
                            'field' => 'term_id',
                            'terms' => $city_id
                        )
                    )
                ]);
                if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                <?php
                    $term_list = wp_get_post_terms( get_the_ID(), 'vrcategory', array('fields' => 'ids') );
                    $metro_stations = get_metro_stations_by_vrclub();
                ?>
                <div class="vritem" data-tags="<?php echo implode(',', $term_list); ?>" data-metros="<?php echo implode(',', $metro_stations); ?>">
                    <a href="<?php the_permalink(); ?>" class="vritem__link">
                        <div class="vritem__img posts__thumbnail">
                            <?php if(get_field('players_count')): ?>
                                <div class="vritem__peoples"><?php the_field('players_count'); ?></div>
                            <?php endif; ?>
                            <?php the_post_thumbnail(array(400, 250)); ?>
                            <div class="posts__thumbnail__permalink">Показать полностью</div>
                        </div>
                        <div class="vritem__info">
                            <div class="vritem__name posts__title_bold posts__title">
                                <?php the_title(); ?>
                            </div>
                            <div class="vritem__metros">
                                <?php echo implode(', ', $metro_stations); ?>
                            </div>
                            <?php
                                $term_list = wp_get_post_terms( get_the_ID(), 'vrcategory', array('fields' => 'all') );
                                if($term_list):
                            ?>
                            <div class="vritem__tags">
                                <?php foreach($term_list as $term_item): ?>
                                    <span><?php echo $term_item->name; ?></span>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </a>
                </div>
            <?php endwhile; else : ?>
                <p style="font-size: 24px;">Ничего не найдено</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
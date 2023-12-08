<?php
/**
 * Template Name: VR Клуб
 * Template Post Type: post, page
 */

 get_header();
?>
<div class="col-xs-12">
    <div class="vrc__title"><?php the_title(); ?></div>
    <div class="vrc">
        <div class="vrc__l">
            <?php
                // $term_list = wp_get_post_terms( get_the_ID(), 'vrcategory', array('fields' => 'all') );
                $term_list = false;
                if($term_list):
            ?>
            <div class="vrc__tags">
                <?php foreach($term_list as $term_item): ?>
                    <span><?php echo $term_item->name; ?></span>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            <?php
                $term_list = wp_get_post_terms( get_the_ID(), 'vrcategory', array('fields' => 'ids') );
                $metro_stations = get_metro_stations_by_vrclub();
            ?>
            <div class="vrc__h2">Метро</div>
            <div class="vrc__metro"><?php echo implode(',', $metro_stations); ?></div>
            <div class="vrc__h2">Адрес</div>
            <address class="vrc__address"><?php the_field('address'); ?></address>
            <div class="vrc__h2">Сайт</div>
            <div class="vrc__site"><a rel="noindex nofollow" target="_blank" href="<?php the_field('site'); ?>"><?php the_field('site'); ?></a></div>
            <div class="vrc__h2">Соц. сети</div>
            <div class="vrc__socs">
                <?php if(get_field('vk')): ?>
                    <a href="<?php the_field('vk'); ?>" class="vrc__socs-vk">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/VK.png" alt="VK" width="30px" height="30px">
                    </a>
                <?php endif; ?>
                <?php if(get_field('facebook')): ?>
                    <a href="<?php the_field('facebook'); ?>" class="vrc__socs-facebook">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/Facebook.png" alt="Facebook" width="30px" height="30px">
                    </a>
                <?php endif; ?>
                <?php if(get_field('instagram')): ?>
                    <a href="<?php the_field('instagram'); ?>" class="vrc__socs-instagram">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/Instagram.png" alt="Instagram" width="30px" height="30px">
                    </a>
                <?php endif; ?>
                <?php if(get_field('telegram')): ?>
                    <a href="<?php the_field('telegram'); ?>" class="vrc__socs-telegram">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/Telegram.png" alt="Telegram" width="30px" height="30px">
                    </a>
                <?php endif; ?>
                <?php if(get_field('whatsapp')): ?>
                    <a href="<?php the_field('whatsapp'); ?>" class="vrc__socs-whatsapp">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/WhatsApp.png" alt="WhatsApp" width="30px" height="30px">
                    </a>
                <?php endif; ?>
            </div>
            <div class="vrc__h2">Телефон</div>
            <?php
                $tels = get_field('tels');
                if($tels) {
                    foreach($tels as $tel) {
                        ?>
                            <div class="vrc__tel"><a href="tel:<?php echo $tel['tel']; ?>"><?php echo $tel['tel']; ?></a></div>
                            <?php
                    }
                }
                ?>
            <div class="vrc__h2 mt">График работы</div>
            <div class="vrc__time"><?php the_field('time'); ?></div>
            <div class="vrc__content"><?php the_field('desc'); ?></div>
        </div>
        <div class="vrc__r">
            <?php/* the_post_thumbnail('full'); */?>

            <div class="vrc__map">
                <script>
                    ymaps.ready(init);

                    function init () {
                        var myMap = new ymaps.Map('map', {
                            center: [55.753994, 37.622093],
                            zoom: 9,
                            controls: ['default']
                        });




                        ymaps.geocode('<?php the_field('address'); ?>', {
                            results: 1
                        }).then(function (res) {
                            var firstGeoObject = res.geoObjects.get(0),
                                coords = firstGeoObject.geometry.getCoordinates(),
                                bounds = firstGeoObject.properties.get('boundedBy');

                            myMap.geoObjects.add(firstGeoObject);
                            myMap.setBounds(bounds, {
                                checkZoomRange: true
                            });

                        });
                    }
                </script>
                <div id="map" style="margin-top: 30px; width: 400px; height: 250px;"></div>
            </div>

            <?php
                $sliders = get_field('slider_photos');
                if($sliders):
            ?>
                <ul class="vrc__slides">
                    <?php foreach($sliders as $slider): ?>
                        <li class="vrc__slide">
                            <a rel="group" class="fancybox" href="<?php echo $slider['url']; ?>">
                                <img src="<?php echo $slider['sizes']['post-list-thumb']; ?>" alt="<?php echo $slider['alt']; ?>">
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

        </div>
    </div>
    <?php if(get_field('youtube')): ?>
        <div class="vrc__youtube">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php the_field('youtube'); ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    <?php endif; ?>
    <?php
        $term_ids = [];
        $term_list = wp_get_post_terms( get_the_ID(), 'location', array('fields' => 'all') );

        foreach($term_list as $term) {
            if($term->parent != 0) {
                $term_ids[] = $term->term_id;
            }
        }

        $the_query = new WP_Query([
        'post_type' => 'vrclubs',
        'posts_per_page' => -1,
        'post__not_in' => [get_the_ID()],
        'tax_query' => array(
            array(
                    'taxonomy' => 'location',
                    'field' => 'term_id',
                    'terms' => $term_ids
                )
            )
        ]);
        if ( $the_query->have_posts() ) :
    ?>
    <div class="vrc__similar">
        <div class="vrc__similar-title">Другие клубы</div>

        <div class="vrc__similar-inner vrclubs__list">
            <?php  while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                <div class="vritem">
                    <a href="<?php the_permalink(); ?>" class="vritem__link">
                        <div class="vritem__img posts__thumbnail">
                            <?php the_post_thumbnail(array(400, 250)); ?>
                            <div class="posts__thumbnail__permalink">Показать полностью</div>
                        </div>
                        <div class="vritem__name posts__title_bold posts__title">
                            <?php the_title(); ?>
                        </div>
                    </a>
                </div>
            <?php endwhile;  ?>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php get_footer(); ?> 

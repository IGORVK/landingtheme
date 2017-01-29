<footer class="main_footer bg_dark">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php echo bloginfo('name'); ?> &copy; <?php echo date('Y'); ?>
                <div class="social_wrap">
                    <ul>
                        <?php if ( have_posts() ) : query_posts('cat=3');
                            while (have_posts()) : the_post(); ?>
                                <li><a href="<?php echo get_post_meta($post->ID,'soc_url', true); ?>" target="_blank" title="<?php the_title(); ?>"><i class="fa <?php echo get_post_meta($post->ID,'font_awesome', true); ?>"></i></a></li>
                            <? endwhile; endif; wp_reset_query(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="hidden"></div>
<!--[if lt IE 9]>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/libs/html5shiv/es5-shim.min.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/libs/html5shiv/html5shiv.min.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/libs/html5shiv/html5shiv-printshiv.min.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/libs/respond/respond.min.js"></script>
<![endif]-->

<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/libs/jquery/jquery-2.1.3.min.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/libs/parallax/parallax.min.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/libs/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/libs/mixitup/mixitup.min.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/libs/scroll2id/PageScroll2id.min.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/libs/waypoints/waypoints.min.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/libs/animate/animate-css.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/libs/jqBootstrapValidation/jqBootstrapValidation.js"></script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/common.js"></script>

<?php wp_footer(); ?>

<!-- Yandex.Metrika counter --><!-- /Yandex.Metrika counter -->
<!-- Google Analytics counter --><!-- /Google Analytics counter -->
</body>
</html>
<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 *  @package ivk_wedding
 */

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <div class="container">

                <section class="error-404 not-found text-center">
                    <header class="page-header">
                        <h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'ivk_wedding' ); ?></h1>
                        <p><a href="<?php bloginfo('url') ?>"><?php bloginfo('url') ?></a></p>
                    </header><!-- .page-header -->

                </section><!-- .error-404 -->

            </div><!--.container-->

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();

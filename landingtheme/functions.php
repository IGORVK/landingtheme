<?php

/*
 * @ package landingtheme
 */
remove_action( 'wp_head', 'feed_links_extra', 3 ); // ссылки доп. фидов (на рубрики)
remove_action( 'wp_head', 'feed_links',       2 ); // ссылки фидов (основные фиды)
// <link rel="EditURI" type="application/rsd+xml" title="RSD" href="http://site.ru/xmlrpc.php?rsd" /> для публикации статей через сторонние сервисы
remove_action( 'wp_head', 'rsd_link'            );
// <link rel="wlwmanifest" type="application/wlwmanifest+xml" href="http://site.ru/wp-includes/wlwmanifest.xml" /> . Используется клиентом Windows Live Writer.
remove_action( 'wp_head', 'wlwmanifest_link'    );
//remove_action( 'wp_head', 'index_rel_link'      ); // не поддерживается с версии 3.3

add_filter('the_generator', '__return_empty_string'); // Убираем версию WordPress

// 3.0
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10 ); // Ссылки на соседние статьи (<link rel='next'... <link rel='prev'...)
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10 );// Короткая ссылка - без ЧПУ <link rel='shortlink'

// 4.6
remove_action( 'wp_head', 'wp_resource_hints', 2); // Prints resource hints to browsers for pre-fetching, pre-rendering and pre-connecting to web sites.

//remove version wp from links
function wp_version_js_css($src) {
	if (strpos($src, 'ver=' . get_bloginfo('version')))
		$src = remove_query_arg('ver', $src);
	return $src;
}
add_filter('style_loader_src', 'wp_version_js_css', 9999);
add_filter('script_loader_src', 'wp_version_js_css', 9999);


/*SEO description, keywords, robots
 =======================================================================================================================
 */


// удалим стандартный вывод title
remove_action( 'wp_head', '_wp_render_title_tag', 1 );

// вызов всех функций
add_action( 'wp_head', 'igo_render_seo_tags', 1 );
function igo_render_seo_tags(){
    //remove_theme_support( 'title-tag' ); // не обязательно
    echo '<title>'. igo_meta_title(' » ') .'</title>'."\n\n";

    igo_meta_description('Igor Khaletskyy   - freelance full stack Worpress web developer experienced in PHP, HTML5, CSS3, JS, JQuery, Twitter Bootstrap. PSD to Wordpress');
    igo_meta_keywords('igor khaletskyy, psd to wordpress, wordpress, php, yii, js, javascript, jquery, css3, css, html5, html, twitter bootstrap, bootstrap, responsive design, web design, mobile-friendly, mobile, mysql administration, mysql, seo, pixel perfect, cross-browser support');
    igo_meta_robots();
}

/**
 * Выводит заголовок страницы <title>
 *
 * Для меток и категорий указывается в настройках, в описании: [title=Заголовок].
 * Для записей, если нужно, чтобы заголовок страницы отличался от заголовка записи,
 * создайте произвольное поле title и впишите туда произвольный заголовок.
 *
 * @ $foo            пустышка, чтобы нормально вызывалось через хук wp_title
 * @ $sep            разделитель
 * @ $add_blog_name  добавлять ли название блога в конец заголовка для архивов (true|false)
 *
 * version 3.0
 */
function igo_meta_title( $sep = '»', $add_blog_name = true ){
    global $post;

    $parts = array();
    $prev  = & $parts['prev'];
    $title = & $parts['title'];
    $after = & $parts['after'];

    if(0){}
    // 404
    elseif ( is_404() )
        $title = "Error 404: That page can’t be found";

    // поиск
    elseif ( is_search() )
        $title = 'Search Results for:  '. get_query_var('s');

    // главная
    elseif( is_front_page() ){
        $title = get_bloginfo('name');
        $after = get_bloginfo('description');
    }

    // Архив типа поста
    elseif ( is_post_type_archive() )
        $title = post_type_archive_title('', 0 );

    // таксономии
    elseif( is_category() || is_tag() || is_tax() ){
        $term = get_queried_object();

        preg_match('/\[title=(.*?)\]/i', $term->description, $match );

        $title = function_exists('get_term_meta') && ($tit=get_term_meta( $term->term_id, 'title', 1 )) ? $tit : @ $match[1];

        if( ! $title ){
            $title = single_term_title('', 0 );
            if( is_tax() )
                $prev = get_taxonomy($term->taxonomy)->labels->name;
        }
    }

    // отдельная страница
    elseif( is_singular() || ( is_home() && ! is_front_page() ) || ( is_page() && ! is_front_page() ) ){
        $title = apply_filters('igo_meta_title_singular', null, $post );

        if( ! $title ) $title = get_post_meta($post->ID, 'title', 1 );
        if( ! $title ) $title = single_post_title( '', 0 );

        if( $cpage = get_query_var('cpage') )
            $prev = 'Comments '. $cpage;
    }

    // архив автора
    elseif ( is_author() ){
        $author = get_queried_object();
        $title = 'Author\'s article: '. $author->display_name;
        $after = 'blog_name';
    }

    // архив даты
    elseif ( is_day() || is_month() || is_year() ){
        //$rus_month  = array('', 'январь', 'февраль', 'март', 'апрель', 'май', 'июнь', 'июль', 'август', 'сентябрь', 'октябрь', 'ноябрь', 'декабрь');
        //$rus_month2 = array('', 'января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря');
        $rus_month  = array('', 'January',  'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        $rus_month2 = array('', 'January',  'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        $year     = get_query_var('year');
        $monthnum = get_query_var('monthnum');
        $day      = get_query_var('day');

        if( is_year() )      $dat = "$year год";
        elseif( is_month() ) $dat = "$rus_month[$monthnum] $year year";
        elseif( is_day() )   $dat = "$day $rus_month2[$monthnum] $year year";

        $title = 'Archive'. $dat;
        $after = 'blog_name';
    }

    // другое
    else {
        //$title = function_exists('wp_get_document_title') ? wp_get_document_title() : wp_title( $sep, 0, 'right');
    }

    // номера страниц для пагинации и деления записи
    $pagenum = ( $page = get_query_var('paged') ) ? $page : get_query_var('page');
    if( $pagenum ) $title .= " (page $pagenum)";

    if( $after == 'blog_name' )
        $after = $add_blog_name ? get_bloginfo('name') : '';

    $parts = apply_filters( 'igo_meta_title_parts', $parts );

    $title = implode( ' '. trim($sep) .' ', array_filter($parts) );

    $title = wptexturize( $title );
    $title = esc_html( $title );

    return $title;
}

/**
 * Выводит метатег description
 *
 * Для элементов таксономий: метаполе description или в описании такой шоткод [description = текст описания]
 * У постов сначала проверяется, метаполе description, или цитата, или начальная часть контента.
 * Цитата или контент обрезаются до указанного в $maxchar символов.
 *
 * @ $home_description - указывается описание для главной страницы сайта.
 * @ $maxchar - Максимальная длина описания (в символах).
 *
 * version 0.5
 */
function igo_meta_description( $home_description = '', $maxchar = 160 ){
    global $wp_query, $post;

    $cut = true; // обрезать до макс символов.
    $out = '';

    if( is_front_page() )
        $out = $home_description ?: get_bloginfo( 'description', 'display' );

    elseif( is_singular() ){
        if( $out = get_post_meta($post->ID, "description", true ) )
            $cut = false;
        if( ! $out )
            $out = $post->post_excerpt ?: $post->post_content;

        $out = trim( strip_tags( $out ) );
    }
    // term
    elseif( is_category() || is_tag() || is_tax() ){
        $term = get_queried_object();

        // wp 4.4
        if( function_exists('get_term_meta') ){
            $out = get_term_meta( $term->term_id, "description", true );
            $cut = false;
        }
        // wp 4.4 -
        else{
            preg_match ('!\[description=(.*)\]!iU', $term->description, $match );
            $out = isset( $match[1] ) ? $match[1] : '';
        }
    }

    if( $out ){
        $out = str_replace( array("\n", "\r"), ' ', $out );
        $out = preg_replace("@\[[^\]]+]\]@", '', $out); // удаляем шоткоды

        if( $cut ){
            $char = mb_strlen( $out );
            if( $char > $maxchar ){
                $out      = mb_substr( $out, 0, $maxchar );
                $words    = explode(' ', $out );
                $maxwords = count($words) - 1; //убираем последнее слово, ибо оно в 90% случаев неполное
                $out      = join(' ', array_slice($words, 0, $maxwords)).' ...';
            }
        }

        echo '<meta name="description" content="'. esc_attr($out) .'" />'."\n";
    }
}

/**
 * Генерирует метатег keywords для head части сайта
 *
 * Чтобы задать свои keywords для записи, создайте произвольное поле keywords и впишите в значения необходимые ключевые слова.
 * Для постов (post) ключевые слова генерируются из меток и названия категорий, если не указано произвольное поле keywords.
 *
 * Для меток, категорий и произвольных таксономий, ключевые слова указываются в описании, в шоткоде: [keywords=слово1, слово2, слово3]
 *
 * @ $home_keywords: Для главной, ключевые слова указываются в первом параметре: igo_meta_keywords( 'слово1, слово2, слово3' );
 * @ $def_keywords: сквозные ключевые слова - укажем и они будут прибавляться к остальным на всех страницах
 *
 * version 0.5
 */
function igo_meta_keywords( $home_keywords = '', $def_keywords = '' ){
    global $wp_query, $post;
    $out = '';

    if ( is_front_page() ){
        $out = $home_keywords;
    }
    elseif( is_singular() ){
        $out = get_post_meta($post->ID, 'keywords', true);

        // для постов указываем ключами метки и категории, если не указаны ключи в произвольном поле
        if( ! $out && $post->post_type == 'post' ){
            $res = wp_get_object_terms( $post->ID, array('post_tag', 'category'), array('orderby' => 'none') ); // получаем категории и метки
            if( $res )
                foreach( $res as $tag )
                    $out .= ", $tag->name";

            $out = ltrim($out, ', ');
        }
    }
    elseif ( is_category() || is_tag() || is_tax() ){
        $term = get_queried_object();

        // wp 4.4
        if( function_exists('get_term_meta') ){
            $out = get_term_meta( $term->term_id, "keywords", true );
        }
        else{
            preg_match( '!\[keywords=([^\]]+)\]!iU', $term->description, $match );
            $out = isset($match[1]) ? $match[1] : '';
        }

    }

    if( $out && $def_keywords )
        $out = $out .', '. $def_keywords;

    if( $out )
        return print "<meta name=\"keywords\" content=\"$out\" />\n";
}

/**
 * Метатег robots
 *
 * Чтобы задать свои атрибуты метатега robots записи, создайте произвольное поле с ключом robots
 * и необходимым значением, например: noindex,nofollow
 *
 * Укажите параметр $allow_types, чтобы разрешить индексацию типов страниц.
 *
 * @ $allow_types Какие типы страниц нужно индексировать (через запятую):
 *                cpage, is_category, is_tag, is_tax, is_author, is_year, is_month, is_day, is_search, is_feed, is_post_type_archive, is_paged
 *                (можно использовать любые условные теги в виде строки)
 *                cpage - страницы комментариев
 * @ $robots      Как закрывать индексацию: noindex,nofollow
 *
 * version 0.5
 */
function igo_meta_robots( $allow_types = 'cpage, is_category, is_tag, is_tax, is_paged, is_post_type_archive', $robots = 'noindex,nofollow' ){
    global $post;

    if( ( is_home() || is_front_page() ) && ! is_paged() ) return;

    if( is_singular() ){
        $robots = get_post_meta( $post->ID, 'robots', true );
    }
    else {
        $types = preg_split('~[, ]+~', $allow_types );
        $types = array_filter( $types );

        foreach( $types as $type ){
            if( $type == 'cpage' && strpos($_SERVER['REQUEST_URI'], '/comment-page') ) $robots = false;
            elseif( function_exists($type) && $type() )                                $robots = false;
        }
    }

    $robots = apply_filters('igo_meta_robots_close', $robots );

    if( $robots ) echo "<meta name=\"robots\" content=\"$robots\" />\n";
}


/*Logo Widget
========================================================================================================================
*/


function logo_widget_init() {
	register_sidebar( array(
		'name' => __( 'Logo SVG', 'landingtheme' ),
		'id' => 'logo',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<span class="hidden">',
		'after_title'   => '</span>',
	) );
}
add_action( 'widgets_init', 'logo_widget_init' );


/* theme-options.php
========================================================================================================================
*/

require_once ( get_stylesheet_directory() . '/theme-options.php' );


/* add thumbnails
========================================================================================================================
*/
add_theme_support('post-thumbnails');
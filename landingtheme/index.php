<?php get_header(); ?>


<section id="about" class="s_about bg_light">
	<div class="section_header">
		<h2><?php
            $idObj = get_category_by_slug('about-me');
            $id = $idObj->term_id;
            echo get_cat_name($id);
            ?></h2>
		<div class="s_descr_wrap">
			<div class="s_descr"> <?php
                echo category_description( $id );
                ?> </div>
		</div>
	</div>
	<div class="section_content">
		<div class="container">
			<div class="row">

                <?php if ( have_posts() ) : query_posts('p=4');
                    while (have_posts()) : the_post(); ?>

                        <div class="col-md-4 col-md-push-4 animation_1">
                            <h3></h3>
                            <div class="person">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <a class="popup" href="<?php

                                    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
                                    echo esc_url($large_image_url[0]);

                                    ?>" title="<?php the_title_attribute(); ?>">
                                        <?php the_post_thumbnail(array(220, 220)); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-4 col-md-pull-4 animation_2">

                            <h3><?php the_title(); ?></h3>
                            <?php the_content(); ?>

                        </div>

                <? endwhile; endif; wp_reset_query(); ?>



                        <div class="col-md-4 animation_3 personal_last_block">
                            <?php if ( have_posts() ) : query_posts('p=7');
                                while (have_posts()) : the_post(); ?>
                                    <h3><?php the_title(); ?></h3>
                                    <h2 class="personal_header"><?php echo get_bloginfo('name'); ?></h2>
                                    <?php the_content(); ?>
                            <? endwhile; endif; wp_reset_query(); ?>
                            <div class="social_wrap">
                                <ul>
                                    <?php
                                    $idObj = get_category_by_slug('social-icons');
                                    $id = $idObj->term_id;
                                    if ( have_posts() ) : query_posts('cat='. $id);
                                        while (have_posts()) : the_post(); ?>
                                            <li><a href="<?php echo get_post_meta($post->ID,'soc_url', true); ?>" target="_blank" title="<?php the_title(); ?>"><i class="fa <?php echo get_post_meta($post->ID,'font_awesome', true); ?>"></i></a></li>
                                        <? endwhile; endif; wp_reset_query(); ?>
                                </ul>
                            </div>
                        </div>




			</div>
		</div>
	</div>
</section>

<section id="portfolio" class="s_portfolio bg_dark">
	<div class="section_header">
		<h2><?php
            $idObj = get_category_by_slug('portfolio');
            $id = $idObj->term_id;
            echo get_cat_name($id);
            ?></h2>
		<div class="s_descr_wrap">
			<div class="s_descr"> <?php echo category_description( $id ); ?></div>
		</div>
	</div>
	<div class="section_content">
		<div class="container">
			<div class="row">


				<div class="filter_div controls">
					<ul>
						<li class="filter active" data-filter="all">Recent works</li>
						<li class="filter" data-filter=".blog">Blog</li>
						<li class="filter" data-filter=".landing-page">Landing Page</li>
						<li class="filter" data-filter=".corporate-site">Corporate Site</li>
                        <li class="filter" data-filter=".gallery">Gallery</li>
                        <li class="filter" data-filter=".e-commerce">E-Commerce</li>
                        <li class="filter" data-filter=".responsive-design">Responsive Design</li>
					</ul>
				</div>
				<div id="portfolio_grid">

                    <?php if ( have_posts() ) : query_posts('cat=', $id);
                        while (have_posts()) : the_post(); ?>

                            <div class="mix col-md-4 col-sm-6 col-xs-12 portfolio_item
                            <?php
                            $tags = wp_get_post_tags($post->ID);
                            if ($tags) {
                                foreach($tags as $tag) {
                                    echo  ' ' . $tag->name;
                                }
                            }
                            ?>">

                                <?php the_post_thumbnail(array(400, 300)); ?>
                                <div class="port_item_cont">
                                    <h3><?php the_title(); ?></h3>
                                    <p><?php the_excerpt(); ?></p>
                                    <a href="<?php
                                    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
                                    echo esc_url($large_image_url[0]);
                                    ?>" class="popup_content">Read More</a>
                                </div>
                                <div class="hidden">
                                    <div class="podrt_descr">
                                        <div class="modal-box-content">
                                            <button class="mfp-close" type="button" title="Close (Esc)">×</button>
                                            <h3><?php the_title(); ?></h3>
                                            <?php the_content(); ?>
                                            <p><a href="<?php echo get_post_meta($post->ID,'site_url', true); ?>" class="link-to-site"><?php echo get_post_meta($post->ID,'site_url', true); ?></a></p>
                                            <?php the_post_thumbnail(array(400, 300)); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <? endwhile; endif; wp_reset_query(); ?>




				</div>
			</div>
		</div>
	</div>
</section>

    <section id="resume" class="s_resume">
        <div class="section_header">
            <h2><?php
                $idObj = get_category_by_slug('questionnaire');
                $id = $idObj->term_id;
                echo get_cat_name($id);
                ?></h2>
            <div class="s_descr_wrap">
                <div class="s_descr"><?php echo category_description( $id ); ?> </div>
            </div>
        </div>
        <div class="section_content">
            <div class="container">
                <div class="row">
                    <div class="resume_container">

                        <div class="col-md-6 col-sm-6 left">
                            <h3><?php
                                $idObj = get_category_by_slug('website');
                                $id = $idObj->term_id;
                                echo get_cat_name($id);
                                   ?></h3>
                            <div class="resume_icon"><i class="icon-basic-webpage-multiple"></i></div>

                            <?php if ( have_posts() ) : query_posts('cat=' . $id);
                                while (have_posts()) : the_post(); ?>
                                    <div class="resume_item">

                                            <div class="resume_description"><strong><div class="year"><?php the_title(); ?></div></strong></div>

                                            <?php the_content(); ?>
                                    </div>
                            <? endwhile; endif; wp_reset_query(); ?>

                        </div>

                        <div class="col-md-6 col-sm-6 right">
                            <h3><?php
                                $idObj = get_category_by_slug('project');
                                $id = $idObj->term_id;
                                echo get_cat_name($id);
                                ?></h3>
                            <div class="resume_icon"><i class="icon-basic-book-pen"></i></div>

                            <?php if ( have_posts() ) : query_posts('cat=' . $id);
                                while (have_posts()) : the_post(); ?>
                                    <div class="resume_item">

                                        <div class="resume_description"><strong><div class="year"><?php the_title(); ?></div></strong></div>

                                        <?php the_content(); ?>
                                    </div>
                                <? endwhile; endif; wp_reset_query(); ?>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

<section id="contacts" class="s_contacts bg_light">
	<div class="section_header">
		<h2>Contacts</h2>
		<div class="s_descr_wrap">
			<div class="s_descr">Get in Touch</div>
		</div>
	</div>
	<div class="section_content">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-6">

                    <div class="contact_box">
                        <div class="contacts_icon icon-basic-smartphone"></div>
                        <h3>Phone:</h3>
                        <p><a href="tel:<?php
                            $options = get_option( 'landingtheme_options' );
                            echo $options['phonetext'];

                       ?>"><?php echo $options['phonetext']; ?></a></p>

                    </div>
					<div class="contact_box">
						<div class="contacts_icon icon-basic-headset"></div>
						<h3>Skype:</h3>
						<p><a href="skype:<?php echo $options['skypetext']; ?>"><?php bloginfo('name'); ?></a></p>
					</div>
					<div class="contact_box">
						<div class="contacts_icon icon-basic-webpage-img-txt"></div>
						<h3>Website:</h3>
						<p><a href="http://<?php echo $options['sitetext']; ?>" target="_blank"><?php echo $options['sitetext']; ?></a></p>
					</div>
				</div>
				<div class="col-md-6 col-sm-6">
					<form action="https://formspree.io/igor.khaletskyy@gmail.com" class="main_form" novalidate target="_blank" method="post">
						<label class="form-group">
							<span class="color_element">*</span> Your Name:
							<input type="text" name="name" placeholder="Your Name" data-validation-required-message="Your Name is Required" required />
							<span class="help-block text-danger"></span>
						</label>
						<label class="form-group">
							<span class="color_element">*</span> Your E-mail:
							<input type="email" name="_replyto" placeholder="Your E-mail" data-validation-required-message="Your Email is Required" required />
							<span class="help-block text-danger"></span>
						</label>
						<label class="form-group">
							<span class="color_element">*</span> Your message:
							<textarea name="message" placeholder="Your message" data-validation-required-message="A Message is Required" required></textarea>
							<span class="help-block text-danger"></span>
						</label>
						<button type="submit" value="Send">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
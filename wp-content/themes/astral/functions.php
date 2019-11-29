<?php
/**
 * astral functions and code
 *
 * @package Astral
 * @since 0.1
 *
 */
/**
 * Define constants
 */
define( 'ASTRAL_PARENT_DIR', get_template_directory() );
define( 'ASTRAL_PARENT_URI', get_template_directory_uri() );
define( 'ASTRAL_PARENT_INC_DIR', ASTRAL_PARENT_DIR . '/inc' );
define( 'ASTRAL_PARENT_INC_URI', ASTRAL_PARENT_URI . '/inc' );
define( 'ASTRAL_PARENT_CORE_URI', ASTRAL_PARENT_INC_URI . '/core/' );
/* 
 * require classes 
*/
require ASTRAL_PARENT_INC_DIR . '/core/class-astral-main.php';
require ASTRAL_PARENT_INC_DIR . '/core/class-astral-abstract-main.php';
require ASTRAL_PARENT_INC_DIR . '/core/class-astral-slider-section.php';
require ASTRAL_PARENT_INC_DIR . '/core/class-astral-about-section.php';
require ASTRAL_PARENT_INC_DIR . '/core/class-astral-service-section.php';
require ASTRAL_PARENT_INC_DIR . '/core/class-astral-contact-section.php';
require ASTRAL_PARENT_INC_DIR . '/core/class-astral-blog-section.php';
require ASTRAL_PARENT_INC_DIR . '/core/class_nav_social_walker.php';

/* 
 * customizer class
*/
require( dirname( __FILE__ ) . '/inc/core/class-astral-customizer.php' );
/*
 * Load hooks.
*/
require ASTRAL_PARENT_INC_DIR . '/hooks.php';
require ASTRAL_PARENT_INC_DIR . '/header.php';
require ASTRAL_PARENT_INC_DIR . '/footer.php';

require ASTRAL_PARENT_INC_DIR . '/core/class-wp-bootstrap-navwalker.php';
/* 
 * theme extra function 
*/
require ASTRAL_PARENT_INC_DIR . '/theme-function.php';

/* class for thumbnail images */
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'astral_service' ) ) :
	class astral_service extends WP_Customize_Control {  
		public function render_content(){ ?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php $args = array( 'post_type' => 'post', 'post_status'=>'publish'); 
				$slide_id = new WP_Query( $args ); ?>
				<select <?php $this->link(); ?> >
				<?php if($slide_id->have_posts()):
					while($slide_id->have_posts()):
						$slide_id->the_post(); ?>
						<option value= "<?php echo esc_attr(get_the_id()); ?>" <?php if($this->value()== get_the_id() ) echo 'selected="selected"';?>><?php the_title(); ?></option>
						<?php
					endwhile; 
				 endif; ?>
				</select>
		<?php
		}
	}
endif;


/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function astral_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'astral_skip_link_focus_fix' );
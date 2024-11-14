<?php
/**
 * Custom functons for WooCommerce
 *
 *
 * @package krystal-lawyer
 */



/**
 * Number of products per page
*/

if ( ! function_exists( 'krystal_lawyer_number_items_page' ) ) :
function krystal_lawyer_number_items_page() {
  	$number_product_per_page = 9;
  	if( $number_product_per_page ){
  		$number = $number_product_per_page;
  	}
  	else{
  		$number=9;
  	}
  	return $number;	
}
endif;
add_filter( 'loop_shop_per_page', 'krystal_lawyer_number_items_page' );


/**
 * Number of products per row
*/

if (!function_exists('krystal_lawyer_loop_columns')) :
    function krystal_lawyer_loop_columns() {
        $product_num_per_row = 3;            
        if( $product_num_per_row ){
            $number = $product_num_per_row;
        } else {
            $number = 3;
        }
        return $number;
    }
endif;
add_filter('loop_shop_columns', 'krystal_lawyer_loop_columns');


/**
 * Related Products
*/
if (!function_exists('krystal_lawyer_filter_woocommerce_output_related_products_args')) :
function krystal_lawyer_filter_woocommerce_output_related_products_args( $args ) {     
    $args=array(    
    'posts_per_page' => 3,
    'columns' => 3,
    );

    return $args; 
};
endif;
add_filter( 'woocommerce_output_related_products_args', 'krystal_lawyer_filter_woocommerce_output_related_products_args', 10, 1 ); 


/**
 * Add Class
*/

if (!function_exists('krystal_lawyer_woo_body_columns_class')) :
    function krystal_lawyer_woo_body_columns_class( $class ) {
        $class[] = 'columns-3'; 
    	  return $class;
    }
endif;
add_action( 'body_class', 'krystal_lawyer_woo_body_columns_class');


/**
 * Check WooCommece is active
*/

if ( ! function_exists( 'krystal_lawyer_is_woocommerce_activated' ) ) :
	   function krystal_lawyer_is_woocommerce_activated() {
		    if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
	   }
endif;


/**
 * Check class and return
*/

if ( ! function_exists( 'krystal_lawyer_check_class' ) ) :
	   function krystal_lawyer_check_class($class) {
		    $body_classes = get_body_class();
		    if(in_array($class, $body_classes)){
			      return true; 
		    } 
		    else { 
			      return false; 
		    }
	   }
endif;


/**
 * Krystal Lawyer Shop Title
 */

if ( ! function_exists( 'krystal_lawyer_get_shop_title' ) ) :
function krystal_lawyer_get_shop_title() {
    if(!is_front_page()){
        if ('color' === esc_html(get_theme_mod( 'kr_page_bg_radio','color' ))) {
            ?>
                <div class="page-title" style="background:<?php echo esc_attr(get_theme_mod( 'kr_page_bg_color','#555555' )); ?>;">
            <?php
        }
        else if('image' === esc_html(get_theme_mod( 'kr_page_bg_radio','color' ))){
            if(true===get_theme_mod( 'kr_page_bg_parallax',true)) {
                ?>
                    <div class="page-title" data-parallax="scroll" data-image-src="<?php echo esc_url(get_theme_mod( 'kr_page_bg_image',get_template_directory_uri().'/img/start-bg.jpg' )); ?>">
                <?php
            }
            else{
                ?>
                    <div class="page-title"  style="background:url('<?php echo esc_url(get_theme_mod( 'kr_page_bg_image',get_template_directory_uri().'/img/start-bg.jpg' )); ?>') no-repeat scroll center center / cover"> 
                <?php
            }
        }
        else{
            ?>
                <div class="page-title default"> 
            <?php
        }
        ?>
            <div class="content-section img-overlay">
                <div class="container">
                    <div class="row text-center">
                        <div class="col-md-12">
                            <div class="section-title page-title">
                                <?php
                                    if(is_product()){ 
                                        global $product;
                                        ?><h1 class="main-title"><?php single_post_title(); ?></h1><?php
                                    }
                                    else{
                                        ?><h1 class="main-title"><?php echo esc_html(get_theme_mod( 'kr_shop_name',__('SHOP','krystal-lawyer') )) ?></h1> <?php
                                    }
                                ?>
                                <div class="bread-crumb" typeof="BreadcrumbList" vocab="http://schema.org/">
                                    <?php 
                                        if(function_exists('bcn_display')){
                                            bcn_display();
                                        }
                                    ?>
                                </div>                                                           
                            </div>            
                        </div>
                    </div>
                </div>  
            </div>
            </div>  <!-- End page-title --> 
        <?php
    } 
}
endif;
?>

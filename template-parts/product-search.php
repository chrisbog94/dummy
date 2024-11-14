<?php
/**
 * Product search template.
 *
 * @package krystal-lawyer
 */

?>
<div class="krystal-product-search">
	<form method="get" class="woocommerce-product-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php
			$terms = get_terms( array(
				'taxonomy'   => 'product_cat',
				'hide_empty' => true,
				'parent'     => 0,
			) );
		
			if (  ! empty( $terms ) && ! is_wp_error( $terms ) ) { 
				?>
					<div class="krystal-search-wrap">
						<?php 
							$current = ( isset( $_GET['product_cat'] ) ) ? esc_html( $_GET['product_cat'] ) : ''; 
						?>
						<select class="select_products" name="product_cat">
							<option value=""><?php esc_html_e( 'All Categories', 'krystal-lawyer' ); ?></option>
							<?php 
								foreach ( $terms as $cat ) { 
									?>
										<option value="<?php echo esc_attr( $cat->name ); ?>" <?php selected( $current, esc_html( $cat->name ) ); ?> ><?php echo esc_html( $cat->name ); ?></option>
									<?php 
								} 
							?>
						</select>
					</div>
				<?php 
			} 
		?>
		<div class="krystal-search-form">
			<input type="search" id="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" class="search-field" placeholder="<?php echo esc_attr__( 'Search products&hellip;', 'krystal-lawyer' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
			<input type="submit" class="fa" value="&#xf002;&nbsp;<?php echo esc_attr__('Search','krystal-lawyer') ?>" />
			<input type="hidden" name="post_type" value="product" />
		</div>
	</form>
</div>

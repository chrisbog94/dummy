<?php
/**
 * Krystal Lawyer: Dynamic CSS stylesheet
 * 
 */

function krystal_lawyer_dynamic_css_stylesheet() {    
 
    $top_menu_button_color= sanitize_hex_color(get_theme_mod( 'kr_top_menu_button_color','#b49964' ));
    $top_menu_button_text_color= sanitize_hex_color(get_theme_mod( 'kr_top_menu_button_text_color','#b49964' ));
    $top_menu_color= sanitize_hex_color(get_theme_mod( 'kr_top_menu_color','#555' ));      
    $top_menu_dd_color= sanitize_hex_color(get_theme_mod( 'kr_top_menu_dd_color','#dd3333' ));

    $css = '
    #menu-social-menu.footer-menu li{
        display: inline-block;
    }

	footer#footer a, footer#footer a:hover {
		text-decoration: none;
	}
';

if(true===get_theme_mod( 'kr_enable_last_menu_button',false)){
    if('style2'===esc_html(get_theme_mod('kr_menu_button_styles','style2'))) {
        $css .='

    		#krystal-main-menu-wrapper li.menu-button > a,
    		header.style-1.fixed #krystal-main-menu-wrapper li.menu-button > a, 
        	header.style-2.fixed #krystal-main-menu-wrapper li.menu-button > a {
        		background : none !important;
        		border: 2px solid ' . $top_menu_button_color . ' !important;
        		color: ' . $top_menu_button_text_color . ' !important;
        		padding: 10px 20px !important;
    			margin-top: -5px !important;
    			border-radius: 0 !important;
    		}

    		@media (max-width: 767px) {
				#krystal-main-menu-wrapper li.menu-button > a, 
				header.style-1 #krystal-main-menu-wrapper li.menu-button > a, 
				header.style-2 #krystal-main-menu-wrapper li.menu-button > a {
				    background : none !important;
	        		border: 2px solid ' . $top_menu_button_color . ' !important;
	        		color: ' . $top_menu_button_text_color . ' !important;
	        		padding: 10px 20px !important;
	    			margin-top: -5px !important;
	    			border-radius: 0 !important;
				}
			}
        ';   
    }
    else{
        $css .='

         	#krystal-main-menu-wrapper li.menu-button > a,
         	header.style-1.fixed #krystal-main-menu-wrapper li.menu-button > a, 
        	header.style-2.fixed #krystal-main-menu-wrapper li.menu-button > a {
        		background : ' . $top_menu_button_color . ' !important;
        		border: none !important;
        		color: ' . $top_menu_button_text_color . ' !important;
        		padding: 10px 20px !important;
    			margin-top: -5px !important;
    			font-weight: 400 !important;
    		}   

    		@media (max-width: 767px) {
				#krystal-main-menu-wrapper li.menu-button > a, 
				header.style-1 #krystal-main-menu-wrapper li.menu-button > a, 
				header.style-2 #krystal-main-menu-wrapper li.menu-button > a {
				    background : ' . $top_menu_button_color . ' !important;
	        		border: none !important;
	        		color: ' . $top_menu_button_text_color . ' !important;
	        		padding: 10px 20px !important;
	    			margin-top: -5px !important;
	    			font-weight: 400 !important;
				}
			}
        ';
    }
    
}


return apply_filters( 'krystal_lawyer_dynamic_css_stylesheet', krystal_lawyer_minimize_css($css));

}
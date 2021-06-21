<?php

if (!class_exists('ECTFeedbackNotice')) {
    class ECTFeedbackNotice {
        /**
         * The Constructor
         */
        public function __construct() {
            // register actions
        
            if(is_admin()){
                add_action( 'admin_notices',array($this,'admin_notice_for_reviews'));
               add_action( 'wp_ajax_ect_dismiss_notice',array($this,'ect_dismiss_review_notice' ) );
               add_action( 'wp_ajax_ect_dismiss_ele_addon_notice',array($this,'ect_dismiss_ele_addon_notice' ) );
               // Notice if the Elementor is not active
               if ( did_action( 'elementor/loaded' ) ) {
                if (!class_exists('Events_Calendar_Addon')) {
                    add_action( 'admin_notices',array($this,'admin_notice_for_elementor_addon'));
                }
                }
            }
               
        }
        public function ect_dismiss_ele_addon_notice(){
            $rs=update_option( 'dismiss_ele_addon_notice','yes' );
            echo  json_encode( array("success"=>"true") );
            exit;
        }
        public function admin_notice_for_elementor_addon(){
            if( !current_user_can( 'update_plugins' ) ){
                return;
             }
             $alreadyRated =get_option( 'dismiss_ele_addon_notice' )!=false?get_option( 'dismiss_ele_addon_notice'):"no";
             // check user already rated 
            if( $alreadyRated=="yes") {
                return;
                } 
             $ajax_url=admin_url( 'admin-ajax.php' );
             $ajax_callback='ect_dismiss_ele_addon_notice';
             $ele_logo= ECT_PLUGIN_URL.'assets/images/events-widgets-elementor-logo.png';
             $output='';
           
             $output='<div  data-ajax-url="'.$ajax_url.'"  
             data-ajax-callback="'.$ajax_callback.'" 
             class="ele_addon_notice_wrp notice notice-info">
             <a href="javascript:void(0);" class="button dismiss_it" title="Not Interested! Close This Box.">Not Interested!.</a>
             <a href="https://wordpress.org/plugins/events-widgets-for-elementor-and-the-events-calendar/">
             
             <div class="logo_container"><img src="'.$ele_logo.'"></a>
             </div>
             <div  class="message_container">
              Hi! We checked that you are using <strong>Elementor Page Builder</strong>.
              <br/>Please try latest <a target="_blank" href="https://wordpress.org/plugins/events-widgets-for-elementor-and-the-events-calendar/"><strong>The Events Calendar Widgets For Elementor</strong></a> plugin developed by <a href="https://coolplugins.net">Cool Plugins</a>
                 & <br/> represents The Events Calendar events in the Elementor page builder pages.
               
                </div>
              </div><style>
              
              .ele_addon_notice_wrp .logo_container {
                width:58px;
                display:inline-block;
                margin-right: 10px;
                vertical-align: top;
            }
            .ele_addon_notice_wrp .logo_container img {
                width:64px;
                height:auto;
            }
            .ele_addon_notice_wrp .message_container {
                width: calc(100% - 140px);
                display: inline-block;
                margin: 0;
                vertical-align: middle;
                margin: 8px;
                font-size: 16px;
                line-height: 23px;
            }
            .ele_addon_notice_wrp  a.button.dismiss_it {
                float: right;
                position: absolute;
                right: 28px;
                margin: 5px;
            }
    
            </style>';
    
            $inline_js="<script>jQuery(document).ready(function ($) {
                $('.ele_addon_notice_wrp').find('a.dismiss_it').on('click', function (event) {
                    var thisE = $(this);
                    var wrapper=thisE.parents('.ele_addon_notice_wrp');
                    var ajaxURL=wrapper.data('ajax-url');
                    var dismissAjaxCallback=wrapper.data('ajax-callback');
                    $.post(ajaxURL, { 'action':dismissAjaxCallback }, function( data ) {
                        wrapper.slideUp('fast');
                      }, 'json');
                });
            });</script>";
            $output.=$inline_js;
    
           echo $output;
        }
// ajax callback for review notice
    public function ect_dismiss_review_notice(){
        $rs=update_option( 'ect-ratingDiv','yes' );
        echo  json_encode( array("success"=>"true") );
        exit;
    }
   // admin notice  
    public function admin_notice_for_reviews(){

        if( !current_user_can( 'update_plugins' ) ){
            return;
         }
         // get installation dates and rated settings
         $installation_date = get_option( 'ect-installDate' );
         $alreadyRated =get_option( 'ect-ratingDiv' )!=false?get_option( 'ect-ratingDiv'):"no";

         // check user already rated 
         if( $alreadyRated=="yes") {
                return;
            }

            // grab plugin installation date and compare it with current date
            $display_date = date( 'Y-m-d h:i:s' );
            $install_date= new DateTime( $installation_date );
            $current_date = new DateTime( $display_date );
            $difference = $install_date->diff($current_date);
            $diff_days= $difference->days;
          
            // check if installation days is greator then week
            if (isset($diff_days) && $diff_days>=3) {
                echo $this->create_notice_content();
                }
       }  

       // generated review notice HTML
       function create_notice_content(){
        $ajax_url=admin_url( 'admin-ajax.php' );
        $ajax_callback='ect_dismiss_notice';
        $wrap_cls="notice notice-info is-dismissible";
        $img_path=ECT_PLUGIN_URL.'assets/images/ect-icon.png';
        $p_name="Events Shortcodes & Templates Addon";
        $like_it_text='Rate Now! ★★★★★';
        $already_rated_text=esc_html__( 'I already rated it', 'cool-timeline' );
        $not_interested=esc_html__( 'Not Interested', 'ect' );
        $not_like_it_text=esc_html__( 'No, not good enough, i do not like to rate it!', 'cool-timeline' );
        $p_link=esc_url('https://wordpress.org/support/plugin/template-events-calendar/reviews/#new-post');
        $pro_url=esc_url('https://1.envato.market/calendar');
       
        $message="Thanks for using <b>$p_name</b>. We hope it meets your expectations! <br/>Please give us a quick rating, it works as a boost for us to keep working on more <a href='https://coolplugins.net' target='_blank'><strong>Cool Plugins</strong></a>!<br/>";
      
        $html='<div data-ajax-url="%8$s"  data-ajax-callback="%9$s" class="cool-feedback-notice-wrapper %1$s">
        <div class="logo_container"><a href="%5$s"><img src="%2$s" alt="%3$s"></a></div>
        <div class="message_container">%4$s
        <div class="callto_action">
        <ul>
            <li class="love_it"><a href="%5$s" class="like_it_btn button button-primary" target="_new" title="%6$s">%6$s</a></li>
            <li class="already_rated"><a href="javascript:void(0);" class="already_rated_btn button ect_dismiss_notice" title="%7$s">%7$s</a></li>
            <li class="already_rated"><a href="javascript:void(0);" class="already_rated_btn button ect_dismiss_notice" title="%11$s">%11$s</a></li>
            <li class="buy_pro"><a
             href="%10$s" class="button" target="_blank">Buy Pro Version - $26</a></li>
        </ul>
        <div class="clrfix"></div>
        </div>
        </div>
        </div>';
        $inline_css='<style>.ect-feedback-notice-wrapper.notice.notice-info.is-dismissible {
            padding: 5px;
            display: table;
            width: 100%;
            max-width: 820px;
            clear: both;
            border-radius: 5px;
            border: 2px solid #b7bfc7;
        }
        .ect-feedback-notice-wrapper .logo_container {
            width: 100px;
            display: table-cell;
            padding: 5px;
            vertical-align: middle;
        }
        .ect-feedback-notice-wrapper .logo_container a,
        .ect-feedback-notice-wrapper .logo_container img {
            width:100%;
            height:auto;
            display:inline-block;
        }
        .ect-feedback-notice-wrapper .message_container {
            display: table-cell;
            padding: 5px 20px 5px 5px;
            vertical-align: middle;
        }
        .ect-feedback-notice-wrapper ul li {
            float: left;
            margin: 0px 10px 0 0;
        }
        .ect-feedback-notice-wrapper ul li.already_rated a:before {
            color: #f12945;
            content: "\f153";
            font: normal 18px/22px dashicons;
            display: inline-block;
            vertical-align: middle;
            margin-right: 3px;
        }
        .ect-feedback-notice-wrapper ul li .button-primary {
            background: #008bff;
        }
        .ect-feedback-notice-wrapper ul li .button-primary:hover {
            background: #0f1031;
            border-color: transparent;
        }
        .ect-feedback-notice-wrapper a {
            color: #008bff;
        }
        
        /* This css is for license registration page */
        .ect-notice-red.uninstall {
            max-width: 700px;
            display: block;
            padding: 8px;
            border: 2px solid #157d0f;
            margin: 10px 0;
            background: #13a50b;
            font-weight: bold;
            font-size: 13px;
            color: #ffffff;
        }
        .clrfix{
            clear:both;
        }</style>';
        $inline_js="<script>jQuery(document).ready(function ($) {
            $('.ect_dismiss_notice').on('click', function (event) {
                var thisE = $(this);
                var wrapper=thisE.parents('.cool-feedback-notice-wrapper');
                var ajaxURL=wrapper.data('ajax-url');
                var ajaxCallback=wrapper.data('ajax-callback');
                $.post(ajaxURL, { 'action':ajaxCallback }, function( data ) {
                    wrapper.slideUp('fast');
                  }, 'json');
            });
        });</script>";
        $output =  sprintf($html,
        $wrap_cls,
        $img_path,
        $p_name,
        $message,
        $p_link,
        $like_it_text,
        $already_rated_text,
        $ajax_url,// 8
        $ajax_callback,//9
        $pro_url,//10
        $not_interested
        );
        $output.=$inline_css. ' '.$inline_js;
        return $output;
       }

    } //class end

} 




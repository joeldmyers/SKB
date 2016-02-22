<?php
/**
 * Template for displaying content for single deal
 */

if (have_posts()) {

    while (have_posts()) {

        the_post();
        
        $deal_meta = get_post_meta($post->ID);
        
        $deal_user_id = $deal_meta['investment_deal_user'][0];
        $deal_user = get_user_by( 'id', $deal_user_id );
        
        $offering = get_post($deal_meta['investment_offering_id'][0]);
        $offering_meta = get_post_meta($offering->ID);
        $sub_id = $deal_meta['investment_sub_id'][0];
      //  $subs = Ninja_Forms()->subs()->get( array('form_id', $offering_meta['investment_deal_id']) );
        
     //   echo '<pre>'; var_dump($deal_meta); echo '</pre>';
        ?>
            
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    
                        <div class="col-md-4 col-xs-2 thumbnail">
                            <a href="<?php echo $offering->guid; ?>">
                                <?php echo get_the_post_thumbnail($offering->ID, 'thumbnail'); ?>
                            </a>
                        </div>

                        <div class="col-md-8 bg-success">
                            <div class="col-md-6"><underline><?php echo $offering->post_title; ?></underline></div>
                            <div class="col-md-6"><?php the_title(); ?></div>
                        </div>


                    <div class="col-md-8 col-xs-10 description">
                        <div class="col-md-4 col-xs-5">Investor: <?php echo $deal_user->user_firstname . ' ' . $deal_user->user_lastname; ?></div>
                        <div class="col-md-4 col-xs-5">Username: <?php echo $deal_user->user_login; ?></div>
                        <div class="col-md-4 col-xs-2">Date: <?php echo $post->post_date; ?></div>
                    </div>

                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">

                    <form method="post" action="">
                        <div class="form-group">
                            <div class="col-md-2"><button class="form-control input">Approve Investment</button></div>
                            <div class="col-md-2"><button class="form-control input">Create Docs</button></div>
                            <div class="col-md-2"><button class="form-control input disabled">Sign Docs</button></div>
                            <div class="col-md-2"><button class="form-control input">Send Docs</button></div>
                            <div class="col-md-2"><button class="form-control input">Download Docs</button></div>
                        </div>
                    </form>

                </div>
            </div>
            <div class="col-md-12">
                <?php //ninja_forms_display_form($sub_id);
                    $args = array(
                     //   'form_id'   => 55,
                        'user_id'   => $deal_user_id,
                    //    'fields'    => array(
                     //     '34'      => 'checked',
                     //     '54'      => 'Hello World',
                    );
                    $subs = Ninja_Forms()->subs()->get( $args );
                    foreach ( $subs as $sub ) {
                        var_dump($sub_id);
                        if ($sub->sub_id == $sub_id) {
                            
                            
                            $form_id = $sub->form_id;
                            $user_id = $sub->user_id;
                            // Returns an array of [field_id] => [user_value] pairs
                            $all_fields = $sub->get_all_fields();
                            // Echoes out the submitted value for a field
                            //echo $sub->get_field( 34 );
                            foreach($all_fields as $field) {
                                echo $form_id.' '.$field. '<br/>';

                            }
                        }
                      }
                
                ?>
            </div>
        </div>

        <?php
    }
}
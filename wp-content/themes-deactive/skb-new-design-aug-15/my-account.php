<?php /* Template Name: My Account */
get_header();
$theme_settings = get_option('skb_theme_settings');
$sidebar_content = $theme_settings['main_sidebar'];
$show_title = get_post_meta( get_the_id(), 'show_title', true );

if ( ! is_user_logged_in() ) {

	if ( have_posts() ) { 

	    while ( have_posts() ) { 

	        the_post();

	        if ( has_post_thumbnail() ) {

	            $hero_image_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'full' );
	            $hero_image = '<img class="img-responsive" src="' . $hero_image_src[0] . '">';
	            echo '<div class="hero">' . $hero_image . '</div>';
	            echo '<br><br>';
	        
	        } 

		    echo '<div class="container">';

		    echo '<div class="row">';

	        if ( $sidebar_content != '' ) {

	        	echo '<div class="col-xs-12 col-sm-7 col-md-8" id="main-content">';
	        	$sidebar = true;
	        
	        } else {

	        	echo '<div class="col-xs-12" id="main-content">';
	        	$sidebar = false;
	    
	        }
	    
	    	the_content();

			echo '<div class="col-xs-12" id="main-content">';

	        echo '<h1 id="login_form">Investor Login</h1>';

            echo do_shortcode( '[skb_login_form]' );

            echo '</div>';

            echo '</div>';

	        if ( $sidebar ) {

	            echo '<div class="hidden-xs col-sm-5 col-md-4">';
	            echo '<div class="well">';
	            echo do_shortcode( wpautop( $sidebar_content ) );
	            echo '</div>';
	            echo '</div>';

	        }

	    }

	} else {

	    echo '<div class="col-xs-12"><p>' . __( 'Page not found.', 'skb-theme' ) . '</p></div>';

	}

	echo '</div>';

	echo '</div>';

} else { 

	global $skb_error; 
	$user = wp_get_current_user();
	$investor_name = $user->first_name . ' ' . $user->last_name;

?>

<div class="container">

    <div class="row">

		<div class="col-xs-12">

			<?php if ( 'Yes' == $show_title ) { echo '<h1>' . get_the_title() . '</h1>'; } ?>

		</div>

		<?php get_template_part( 'library/templates/nav', 'my_account' ); ?>

		<div class="tab-content">

			<div role="tabpanel" class="tab-pane fade in active" id="account">

		    	<div class="col-xs-12 col-sm-7">

					<div class="alert alert-success alert-dismissible fade in hide" id="alert-account" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<div id="ajax_account_response"></div>
					</div>

					<form id="account_form" method="post" class="form-horizontal">
						<div class="form-group">
							<label for="first_name" class="col-sm-2 control-label">First Name</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="first_name" id="first-name" value="<?php echo $user->first_name; ?>" placeholder="Enter your first name" required>
							</div>
						</div>
						<div class="form-group">
							<label for="last_name" class="col-sm-2 control-label">Last Name</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="last_name" id="last-name" value="<?php echo $user->last_name; ?>" placeholder="Enter your last name" required>
							</div>
						</div>
						<div class="form-group">
							<label for="phone" class="col-sm-2 control-label">Phone</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="phone" id="phone" value="<?php echo get_user_meta( $user->ID, 'phone', true ); ?>" placeholder="Enter your phone number" required>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<input type="submit" class="btn btn-primary" id="update_account" name="update_account" value="Update Account">
							</div>
						</div>
					</form>

				</div>		

			</div>	


			<div role="tabpanel" class="tab-pane fade" id="entities">
				
				<div class="col-xs-12">

		        <?php 
                                /* moving this to add_action */
				//$args = array(
					//'user_id'   => $user->id,
				//);

				// This will return an array of sub objects.
				//$forms = Ninja_Forms()->subs()->get( $args );
                                //$uslg = esc_html($user->user_login);
                                $args = array(
                                        'posts_per_page'   => -1,
                                        'offset'           => 0,
                                        'orderby'          => 'date',
                                        'order'            => 'DESC',
                                        'meta_key'         => 'investment_entity_user_id',
                                        'meta_value'       => $user->ID,
                                        'post_type'        => 'investment_entity',
                                        'post_mime_type'   => '',
                                        'post_parent'      => '',
                                        'author'	   => '',
                                        'post_status'      => array('publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash', 'approved', 'processing'),
                                        'suppress_filters' => true 
                                );
                                $entities = get_posts( $args );
                                write_log($user->ID.' is user id');
                                //echo $user->ID;
                             //  echo '<pre>'; var_dump(get_post_meta($entities[0]->ID));echo '</pre>';
                                //var_dump($entities);
                               // $entities = get_posts($args);

				// This is a basic example of how to interact with the returned objects.
				// See other documentation for all the methods and properties of the submission object.

				//$entities = array();

				$i = 0;
                                
                               // foreach ( $entities as $entity) {
                               //     echo '<pre>';var_dump(get_post_meta($entity->ID));echo '</pre>';
                               // }
                              //  die();

				/*foreach ( $forms as $form ) {
					
					$form_id = $form->form_id;
					$all_fields = $form->get_all_fields();
                                        //var_dump($all_fields);
					// To retrieve a field value just do 
					// $form->get_field( # )

					switch ( $form_id ) {

						case '2': // Individual
							$entities[$i]['sub_id'] = $form->sub_id;
							$entities[$i]['title'] = $investor_name . ' - Individual';
							break;

						case '4': // Trust
							$entities[$i]['sub_id'] = $form->sub_id;
							$entities[$i]['title'] = $form->get_field( 157 );
							break;

						case '6': // Joint Tenants
							$entities[$i]['sub_id'] = $form->sub_id;
							$entities[$i]['title'] = $investor_name . ' - Joint Tenants';
							break;

						case '7': // Tenants in Common
							$entities[$i]['sub_id'] = $form->sub_id;
							$entities[$i]['title'] = $investor_name . ' - Tenants in Common';
							break;

						case '8': // Community Property
							$entities[$i]['sub_id'] = $form->sub_id;
							$entities[$i]['title'] = $investor_name . ' - Community Property';
							break;

						case '9': // IRA 
							$entities[$i]['sub_id'] = $form->sub_id;
							$entities[$i]['title'] = $form->get_field( 375 );
							break;

						case '11': // Limited Partnership 
							$entities[$i]['sub_id'] = $form->sub_id;
							$entities[$i]['title'] = $form->get_field( 508 );
							break;

						case '12': // LLC 
							$entities[$i]['sub_id'] = $form->sub_id;
							$entities[$i]['title'] = $form->get_field( 589 );
							break;

						case '14': // Corporation 
							$entities[$i]['sub_id'] = $form->sub_id;
							$entities[$i]['title'] = $form->get_field( 747 );
							break;

						case '1':
						case '3':
						default:
							// not an AIQ form;
							break;

					}

					$i++;

				} */
				
		        if ( $entities ) { ?>

		        	<div class="table-responsive">
						<table class="table table-hover table-striped">
							<thead>
								<tr class="active">
									<th>ID</th>
                                                                        <th>Status</th>
                                                                        <th>Name</th>
                                                                        <th>Date Added</th>
                                                                        <th>Investment Type</th>
                                                                        <th># of Deals</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ( $entities as $entity ) { ?>
                                                        
								<tr>
                                                                    <td><?php echo $entity->ID; ?></td>
                                                                    
                                                                    <td><?php 
                                                                    
                                                                    $post_status = get_post_status_object( get_post_status( $entity->ID) );
                                                                    if ($post_status->label == 'Draft') {
                                                                        $post_status->label = 'Processing';
                                                                    }
                                                                    
                                                                    echo ucfirst($post_status->label); 
                                                                    
                                                                    ?></td>
								
                                                                    <td><?php echo $entity->post_title; ?></td>
                                                               
                                                                    <td><?php echo get_the_date('l, M. j, Y', $entity->ID); ?></td>
                                                               
                                                                    <td><?php echo ucfirst( get_post_meta($entity->ID, 'investment_entity_type', true )); ?></td>
                                                                    <td><?php echo count( get_post_meta($entity->ID, 'investment_entity_all_deals', false )); ?></td>
                                                                    <?php //echo '<pre>'; var_dump(get_post_meta($entity->ID, 'investment_entity_all_deals', false)); echo '</pre>'; ?>
                                                                </tr>
								<?php } ?>
				       		</tbody>
				        	<tfoot>
					        </tfoot>
				      	</table>
				    </div>

				    <p><a class="btn btn-primary" href="<?php echo esc_url( get_site_url() . '/aiq-form' ); ?>">Add New Entity</a></p>
		      	
		      	<?php } else { ?>

					<div style="display: table; width: 100%; min-height: 300px; background-color: lightgray;">
						<div style="display: table-cell; color: white; font-size: 30px; font-weight: bold; text-align: center; vertical-align: middle; padding: 0 20%;">
							<p>You have no entities.<br><a href="<?php echo esc_url( get_site_url() . '/aiq-form' ); ?>">Add New Entity.</a></p>
						</div>
					</div>
					<br>

				<?php } ?>

				</div>

			</div>
                    
                    


			<div role="tabpanel" class="tab-pane fade" id="photo">

			    <div class="col-xs-12">

		    		<?php echo do_shortcode( '[avatar_upload]' ); ?>

		    	</div>		

		    </div>			


			<div role="tabpanel" class="tab-pane fade" id="verification">

				<div class="col-xs-12 col-sm-6">

					<?php 

						if ( get_user_meta( $user->ID, 'user_verification', true ) ) {

							echo 'Your Verification Date: ' . get_user_meta( $user->ID, 'user_verification', true ); 

						}

						echo do_shortcode( '[ninja_forms id=42]' );
						echo '<br>';

					?>

				</div>

			</div>

			<div role="tabpanel" class="tab-pane fade" id="address">
				
				<div class="col-xs-12 col-sm-7">

					<div class="alert alert-success alert-dismissible fade in hide" id="alert-address" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<div id="ajax_address_response"></div>
					</div>

					<form id="address_form" method="post" class="form-horizontal">
						<div class="form-group">
							<label for="address_1" class="col-sm-2 control-label">Address 1</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="address_1" id="address-1" value="<?php echo get_user_meta( $user->ID, 'address_1', true ); ?>" placeholder="Enter your street address" required>
							</div>
						</div>
						<div class="form-group">
							<label for="address_2" class="col-sm-2 control-label">Address 2</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="address_2" id="address-2" value="<?php echo get_user_meta( $user->ID, 'address_2', true ); ?>" placeholder="Enter apartment number or mailbox">
							</div>
						</div>
						<div class="form-group">
							<label for="city" class="col-sm-2 control-label">City</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="city" id="city" value="<?php echo get_user_meta( $user->ID, 'city', true ); ?>" placeholder="Enter your city" required>
							</div>
						</div>
						<div class="form-group">
							<label for="state" class="col-sm-2 control-label">State</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="state" id="state" value="<?php echo get_user_meta( $user->ID, 'state', true ); ?>" placeholder="Enter your state" required>
							</div>
						</div>	
						<div class="form-group">
							<label for="zip_code" class="col-sm-2 control-label">Postal Code</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="postal_code" id="postal-code" value="<?php echo get_user_meta( $user->ID, 'postal_code', true ); ?>" placeholder="Enter your postal code" required>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<input type="submit" class="btn btn-primary" id="save-address" name="save_address" value="Save Address">
							</div>
						</div>
					</form>

				</div>

			</div>

			<div role="tabpanel" class="tab-pane fade" id="password">
				
				<div class="col-xs-12 col-sm-7">

					<div class="alert alert-warning alert-dismissible fade in hide" id="alert-password-error" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<div id="ajax_password_error"></div>
					</div>

					<div class="alert alert-success alert-dismissible fade in hide" id="alert-password" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<div id="ajax_password_response"></div>
					</div>

					<form id="password_form" method="post" class="form-horizontal">
						<div class="form-group">
							<label for="current_password" class="col-sm-3 control-label">Current Password</label>
							<div class="col-sm-9">
								<input type="password" class="form-control" name="current_password" id="current-password" value="" placeholder="Enter current password" required>
							</div>
						</div>
						<div class="form-group">
							<label for="new_password" class="col-sm-3 control-label">New Password</label>
							<div class="col-sm-9">
								<input type="password" class="form-control" name="new_password" id="new-password" value="" placeholder="Enter a new password" required>
							</div>
						</div>
						<div class="form-group">
							<label for="confirm_password" class="col-sm-3 control-label">Confirm Password</label>
							<div class="col-sm-9">
								<input type="password" class="form-control" name="confirm_password" id="confirm-password" value="" placeholder="Confirm new password" required>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-9">
								<input type="submit" class="btn btn-primary" id="change_password" name="change_password" value="Change Password">
							</div>
						</div>
					</form>

				</div>

			</div>
                    
                    <div role="tabpanel" class="tab-pane fade" id="preferences">
                        <div class="col-xs-12 panel-group" id="accordion-preferences">
                            <div class="panel panel-default" >

                                <div class="panel-toggle panel-heading"  data-toggle="collapse" data-target="#email-panel">
                                    <div class="panel-container container-fluid">
                                        <div class="pull-left">
                                            <h2 class="panel-title">
                                                <a data-toggle="collapse" data-parent="accordion-email" href="#">Email</a>
                                            </h2>
                                        </div>
                                        <div class="toggle-icon pull-right icon-grey text-right glyphicon glyphicon-small glyphicon-chevron-down"></div>
                                    </div>
                                </div>

                                <div class="panel-collapse collapse" id="email-panel">
                                    <div class="panel-body">
                                        <div> 
                                            <p>Manage your email preferences below</p>
                                            <div class="form-group">
                                           
                                                <label for="preference_email">Email
                                                    <input type="email" class="input-lg" id="preference_email" name="preference_email" value="<?php echo $user->user_email; ?>" />
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel-footer">
                                        <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-11 small">Last updated: <?php echo date('d-m-Y') . ' at ' . date('h:m:s'); ?></div>
                                            <div class="col-md-1 download-all small" id="">
                                                <a href="#accordion-preferences">^ top</a>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<<<<<<< HEAD
                    
                    <div role="tabpanel" class="tab-pane fade in" id="documents">

                            <div class="col-xs-12 col-sm-7">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                            <thead>
                                                    <tr class="active">
                                                            <th>document</th>
                                                            <th>Status</th>
                                                            <th></th>
                                                    </tr>
                                            </thead>

                                                    <tr>
                                                        <td>Summary of Changes</td>
                                                        <td>Completed</td>
                                                        <td><button>View</button></td>
                                                    </tr>
                                            </tbody>
                                            <tfoot>

                                            </tfoot>
                                    </table>
                                </div>
                        </div>
                    </div>
            </div>
    </div>
=======

		</div>

	</div>

>>>>>>> master
</div>
<?php }

//echo '<!-- Registration Date: ' . get_user_meta( $user->ID, 'user_registered', true ) . ' -->';

get_footer();
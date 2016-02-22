<?php /* Template Name: Dashboard */
if ( ! is_user_logged_in() ) {
	wp_redirect( home_url( '/my-account' ) );
}
get_header();
$user_id = get_current_user_id();
$theme_settings = get_option('skb_theme_settings');
setlocale(LC_MONETARY, 'en_US');
?>
<div class="container">

    <div class="row">

		<div class="col-xs-12">

			<h1>Investor Dashboard</h1>

		</div>

		<?php get_template_part( 'library/templates/nav', 'dashboard' ); ?>

		<div class="tab-content">

			<div role="tabpanel" class="tab-pane fade in active" id="overview">

		    	<div class="col-xs-12 col-md-8">
		    		<div class="row">
						<div class="col-xs-12 col-md-4">
					    	<div class="well well-sm">
					    		<span style="font-size: 28px">
					    			<?php 
					    				if ( get_user_meta( $user_id, 'current_capital', TRUE ) ) { 
											echo money_format( '%(#10.2n', get_user_meta( $user_id, 'current_capital', TRUE ) );
										} else {
											echo money_format( '%(#10.2n', '0' );
										}
					    			?>
					    		</span>
					    		<h5>Current Capital</h5>
					    	</div>
					    </div>
						<div class="col-xs-12 col-md-4">
					    	<div class="well well-sm">
					    		<span style="font-size: 28px">
					    			<?php 
					    				if ( get_user_meta( $user_id, 'committed_capital', TRUE ) ) { 
											echo money_format( '%(#10.2n', get_user_meta( $user_id, 'committed_capital', TRUE ) );
										} else {
											echo money_format( '%(#10.2n', '0' );
										}
					    			?>
					    		</span>
					    		<h5>Committed Capital</h5>
					    	</div>
						</div>
						<div class="col-xs-12 col-md-4">
					    	<div class="well well-sm">
					    		<span style="font-size: 28px">
					    			<?php 
					    				if ( get_user_meta( $user_id, 'distributions', TRUE ) ) { 
											echo money_format( '%(#10.2n', get_user_meta( $user_id, 'distributions', TRUE ) );
										} else {
											echo money_format( '%(#10.2n', '0' );
										}
					    			?>
					    		</span>
					    		<h5>Distributions</h5>
					    	</div>
					    </div>
					 </div>
					 <div class="row">  
						<div class="col-xs-12 col-md-6">

							<div class="panel panel-default">
						      <div class="panel-heading"><h4>Account Balance</h4></div>
						      <table class="table">
						        <tbody>
						          <tr>
						            <td>Capital Balance</td>
					    			<td>
					    			<?php 
					    				if ( get_user_meta( $user_id, 'account_balance_capital_balance', TRUE ) ) { 
											echo money_format( '%(#10.2n', get_user_meta( $user_id, 'account_balance_capital_balance', TRUE ) );
										} else {
											echo money_format( '%(#10.2n', '0' );
										}
					    			?>
						            </td>
						          </tr>
						          <tr>
						            <td>Bridge Loan</td>
						            <td>
						            <?php 
					    				if ( get_user_meta( $user_id, 'account_balance_bridge_loan', TRUE ) ) { 
											echo money_format( '%(#10.2n', get_user_meta( $user_id, 'account_balance_bridge_loan', TRUE ) );
										} else {
											echo money_format( '%(#10.2n', '0' );
										}
					    			?>
									</td>
						          </tr>
						          <tr>
						            <td>Reservations</td>
						            <td>
						            <?php 
					    				if ( get_user_meta( $user_id, 'account_balance_reservations', TRUE ) ) { 
											echo money_format( '%(#10.2n', get_user_meta( $user_id, 'account_balance_reservations', TRUE ) );
										} else {
											echo money_format( '%(#10.2n', '0' );
										}
					    			?>
					    			</td>
						          </tr>
						          <tr>
						            <td>Equity</td>
						            <td>
						            <?php 
					    				if ( get_user_meta( $user_id, 'account_balance_equity', TRUE ) ) { 
											echo money_format( '%(#10.2n', get_user_meta( $user_id, 'account_balance_equity', TRUE ) );
										} else {
											echo money_format( '%(#10.2n', '0' );
										}
					    			?>
					    			</td>
						          </tr>
						          <tr>
						            <td>Committed Capital</td>
						            <td>
						            <?php 
					    				if ( get_user_meta( $user_id, 'account_balance_committed_capital', TRUE ) ) { 
											echo money_format( '%(#10.2n', get_user_meta( $user_id, 'account_balance_committed_capital', TRUE ) );
										} else {
											echo money_format( '%(#10.2n', '0' );
										}
					    			?>
					    			</td>
						          </tr>
						        </tbody>
						        <tfoot>
						          <tr>
						            <th>Total Capital</th>
						            <th>
						            <?php 
					    				if ( get_user_meta( $user_id, 'account_balance_total_capital', TRUE ) ) { 
											echo money_format( '%(#10.2n', get_user_meta( $user_id, 'account_balance_total_capital', TRUE ) );
										} else {
											echo money_format( '%(#10.2n', '0' );
										}
					    			?>
					    			</th>
						          </tr>
						        </tfoot>
						      </table>
						    </div>

						</div>
						<div class="col-xs-12 col-md-6">				

							<div class="panel panel-default">
						      <div class="panel-heading"><h4>Distributions</h4></div>
						      <table class="table">
						        <tbody>
						          <tr>
						            <td>Bridge Loan</td>
						            <td>
						            <?php 
					    				if ( get_user_meta( $user_id, 'distributions_bridge_loan', TRUE ) ) { 
											echo money_format( '%(#10.2n', get_user_meta( $user_id, 'distributions_bridge_loan', TRUE ) );
										} else {
											echo money_format( '%(#10.2n', '0' );
										}
					    			?>
					    			</td>
						          </tr>
						          <tr>
						            <td>Interest</td>
						            <td>
						            <?php 
					    				if ( get_user_meta( $user_id, 'distributions_interest', TRUE ) ) { 
											echo money_format( '%(#10.2n', get_user_meta( $user_id, 'distributions_interest', TRUE ) );
										} else {
											echo money_format( '%(#10.2n', '0' );
										}
					    			?>
					    			</td>
						          </tr>
						          <tr>
						            <td>Equity</td>
						            <td>
						            <?php 
					    				if ( get_user_meta( $user_id, 'distributions_equity', TRUE ) ) { 
											echo money_format( '%(#10.2n', get_user_meta( $user_id, 'distributions_equity', TRUE ) );
										} else {
											echo money_format( '%(#10.2n', '0' );
										}
					    			?>
					    			</td>
						          </tr>
						          <tr>
						            <td>Distributions</td>
						            <td>
						            <?php 
					    				if ( get_user_meta( $user_id, 'distributions_distributions', TRUE ) ) { 
											echo money_format( '%(#10.2n', get_user_meta( $user_id, 'distributions_distributions', TRUE ) );
										} else {
											echo money_format( '%(#10.2n', '0' );
										}
					    			?>
					    			</td>
						          </tr>
						        </tbody>
						        <tfoot>
						          <tr>
						            <th>Total Distributions</th>
						            <th>
						            <?php 
					    				if ( get_user_meta( $user_id, 'distributions_total', TRUE ) ) { 
											echo money_format( '%(#10.2n', get_user_meta( $user_id, 'distributions_total', TRUE ) );
										} else {
											echo money_format( '%(#10.2n', '0' );
										}
					    			?>
					    			</th>
						          </tr>
						        </tfoot>
						      </table>
						    </div>

						</div>
					 </div>
					 <div class="row">  
						<div class="col-xs-12 col-md-6">

							<div class="panel panel-default">
						      <div class="panel-heading"><h4>Account Activity</h4></div>
						      <table class="table">
						        <tbody>
						          <tr>
						            <td>Investments</td>
						            <td>(
						            <?php 
					    				if ( get_user_meta( $user_id, 'account_activity_investments', TRUE ) ) { 
											echo money_format( '%(#10.2n', get_user_meta( $user_id, 'account_activity_investments', TRUE ) );
										} else {
											echo money_format( '%(#10.2n', '0' );
										}
					    			?>
					    			)</td>
						          </tr>
						          <tr>
						            <td>Refunded</td>
						            <td>
						            <?php 
					    				if ( get_user_meta( $user_id, 'account_activity_refunded', TRUE ) ) { 
											echo money_format( '%(#10.2n', get_user_meta( $user_id, 'account_activity_refunded', TRUE ) );
										} else {
											echo money_format( '%(#10.2n', '0' );
										}
					    			?>
					    			</td>
						          </tr>
						          <tr>
						            <td>Capital Returned</td>
						            <td>
						            <?php 
					    				if ( get_user_meta( $user_id, 'account_activity_capital_returned', TRUE ) ) { 
											echo money_format( '%(#10.2n', get_user_meta( $user_id, 'account_activity_capital_returned', TRUE ) );
										} else {
											echo money_format( '%(#10.2n', '0' );
										}
					    			?>
					    			</td>
						          </tr>
						        </tbody>
						        <tfoot>
						          <tr>
						            <th>Total Distributions</th>
						            <th>
						            <?php 
					    				if ( get_user_meta( $user_id, 'account_activity_total_distributions', TRUE ) ) { 
											echo money_format( '%(#10.2n', get_user_meta( $user_id, 'account_activity_total_distributions', TRUE ) );
										} else {
											echo money_format( '%(#10.2n', '0' );
										}
					    			?>
					    			</th>
						          </tr>
						        </tfoot>
						      </table>
						    </div>

						</div>
					 </div>
				</div>
		    	<div class="col-xs-12 col-md-4">
		    		<div class="well">
		    			<h2>Following</h2>
		    			<?php echo get_following_investments(); ?>
		    		</div>
		    	</div>

			</div>	
			

			<div role="tabpanel" class="tab-pane fade" id="investments">
				
				<div class="col-xs-12">

		        <?php 

		        $investments = get_user_meta( $user_id, 'investor_investments', TRUE );

		        if ( $investments ) { ?>

		        	<div class="table-responsive">
						<table class="table table-hover table-condensed">
							<thead>
								<tr class="active">
									<th>Investment</th>
									<th>Investment Entity</th>
									<th>Investment Type</th>
									<th>Investment Status</th>
									<th>Original Capital</th>
									<th>Returned Capital</th>
									<th>Transfer / Adjustments</th>
									<th>Current Capital</th>
									<th>Income Distributions</th>
									<th>Other Distributions</th>
								</tr>
							</thead>
							<tbody>
					        	<?php piklist( get_stylesheet_directory() . '/library/templates/piklist-investor_investments.php', array( 'data' => $investments, 'loop' => 'data' ) ); ?>
				       		</tbody>
				        	<tfoot>
				        		<tr class="success">
					        		<th>Totals</th>
					        		<td>-</td>
					        		<td>-</td>
					        		<td>-</td>
					        		<td style="white-space:nowrap;"><?php echo money_format( '%(#10.2n', array_sum( $investments['investor_investment_original_capital'] ) );?></td>
									<td style="white-space:nowrap;"><?php echo money_format( '%(#10.2n', array_sum( $investments['investor_investment_returned_capital'] ) );?></td>
					        		<td style="white-space:nowrap;"><?php echo money_format( '%(#10.2n', array_sum( $investments['investor_investment_transfer_adjustments'] ) );?></td>
					        		<td style="white-space:nowrap;"><?php echo money_format( '%(#10.2n', array_sum( $investments['investor_investment_current_capital'] ) );?></td>
					        		<td style="white-space:nowrap;"><?php echo money_format( '%(#10.2n', array_sum( $investments['investor_investment_income_distributions'] ) );?></td>
					        		<td style="white-space:nowrap;"><?php echo money_format( '%(#10.2n', array_sum( $investments['investor_investment_other_distributions'] ) );?></td>
					        	</tr>
					        </tfoot>
				      	</table>
				     </div>
		      	
		      	<?php } else { ?>

					<div style="display: table; width: 100%; min-height: 300px; background-color: lightgray;">
						<div style="display: table-cell; color: white; font-size: 30px; font-weight: bold; text-align: center; vertical-align: middle; padding: 0 20%;">
							<p>You have no investments.<br><a href="/investments">Start Browsing Opportunities</a></p>
						</div>
					</div>

				<?php } ?>

				</div>

			</div>

			<div role="tabpanel" class="tab-pane fade" id="transactions">
				
				<div class="col-xs-12">

		        <?php 

		        $transactions = get_user_meta( $user_id, 'investor_transactions', TRUE );

		        if ( $transactions ) { ?>

					<table class="table">
						<thead>
							<tr>
								<th>Date</th>
								<th>Investment</th>
								<th>Investment Entity</th>
								<th>Download</th>
							</tr>
						</thead>
						<tbody>
							<?php piklist( get_stylesheet_directory() . '/library/templates/piklist-investor_transactions.php', array('data' => $transactions, 'loop' => 'data')); ?>
				        </tbody>
			      	</table>

		      	<?php } else { ?>

					<div style="display: table; width: 100%; min-height: 300px; background-color: lightgray;">
						<div style="display: table-cell; color: white; font-size: 30px; font-weight: bold; text-align: center; vertical-align: middle; padding: 0 20%;">
							<p>You have no investment transactions.</p>
						</div>
					</div> 

				<?php } ?>

				</div>

			</div>


			<div role="tabpanel" class="tab-pane fade" id="updates">
				
				<div class="col-xs-12">

					<?php 

					$investments = get_user_meta( $user_id, 'investor_investments', TRUE );

			        $updates = false;

			        $investment_updates = array();

					if ( $investments ) {

						$args = array(
							'post_type' => 'investment_update',
							'posts_per_page' => -1,
							'meta_query' => array(
								array(
									'key'     => 'investment_id',
									'value'   => $investments["investor_investment"],
									'compare' => 'IN',
								),
							),
						);

						$query = new WP_Query( $args );

						if ( $query->have_posts() ) {

							$updates = true;
							$i = 0;
							while ( $query->have_posts() ) { 

								$query->the_post();

								$investment_updates["investment_update-date"][$i] = get_the_date();
								$investment_updates["investment_title"][$i] = get_the_title( get_post_meta( get_the_id(), 'investment_id', TRUE ) );
								$investment_updates["investment_update-document"][$i] = get_post_meta( get_the_id(), 'investment_document', TRUE );

								$i++;
							}

						}

						wp_reset_postdata();

					}

			        if ( $updates ) { ?>

					<table class="table">
						<thead>
							<tr>
								<th>Date</th>
								<th>Investment</th>
								<th>Download</th>
								</tr>
						</thead>
						<tbody>
							<?php piklist( get_stylesheet_directory() . '/library/templates/piklist-investment_update.php', array('data' => $investment_updates, 'loop' => 'data')); ?>
				        </tbody>
			      	</table>

			      	<?php } else { ?>

					<div style="display: table; width: 100%; min-height: 300px; background-color: lightgray;">
						<div style="display: table-cell; color: white; font-size: 30px; font-weight: bold; text-align: center; vertical-align: middle; padding: 0 20%;">
							<p>You have no investment updates.</p>
						</div>
					</div>

			      	<?php } ?>

				</div>

			</div>


			<div role="tabpanel" class="tab-pane fade" id="messages">

				<div class="col-xs-12">

					<?php 

					$messages = false;
					$i = 0;
					$args = array(
						'post_type' => 'investor_message',
						'posts_per_page' => -1,
						'meta_key'     => 'investor_message_user',
						'meta_value'   => $user_id,
						'meta_compare' => '=',
					);

					$query = new WP_Query( $args );

					if ( $query->have_posts() ) {

						$messages = true;
						while ( $query->have_posts() ) { 

							$query->the_post();

							$investor_messages["investor_message_postid"][$i] = get_the_id();
							$investor_messages["investor_message_date"][$i] = get_the_date();
							$investor_messages["investor_message_investment"][$i] = get_the_title( get_post_meta( get_the_id(), 'investor_message_investment', TRUE ) );
							$investor_messages["investor_message_subject"][$i] = get_post_meta( get_the_id(), 'investor_message_subject', TRUE );
							$investor_messages["investor_message_content"][$i] = get_post_meta( get_the_id(), 'investor_message_content', TRUE );
							$investor_messages["investor_message_status"][$i] = get_post_meta( get_the_id(), 'investor_message_status', TRUE );

							$i++;
						}

					}

					wp_reset_postdata();

			        if ( $messages ) { ?>

					<div class="panel panel-default">

						<table class="table">
				        	<thead>
								<tr>
									<th>Select</th>
									<th>Date</th>
									<th>Investment</th>
									<th>Investment Entity</th>
									<th>Subject</th>
									<th>Status</th>
								</tr>
					        </thead>
					        <tbody>
						        <?php piklist( get_stylesheet_directory() . '/library/templates/piklist-investor_messages.php', array('data' => $investor_messages, 'loop' => 'data')); ?>
					        </tbody>
				      	</table>

					</div>

			      	<?php } else { ?>

					<div style="display: table; width: 100%; min-height: 300px; background-color: lightgray;">
						<div style="display: table-cell; color: white; font-size: 30px; font-weight: bold; text-align: center; vertical-align: middle; padding: 0 20%;">
							<p>You have no messages.</p>
						</div>
					</div>

			      	<?php } ?>

				</div>

			</div>


			<div role="tabpanel" class="tab-pane fade" id="taxes">

				<div class="col-xs-12">

					<?php 

			        $taxes = get_user_meta( $user_id, 'investor_taxes', TRUE );

			        if ( $taxes ) { ?>

					<table class="table">
						<thead>
							<tr>
								<th>Year</th>
								<th>Investment</th>
								<th>Investment Entity</th>
								<th>Tax Form</th>
								<th>Download</th>
							</tr>
						</thead>
						<tbody>
					        <?php piklist( get_stylesheet_directory() . '/library/templates/piklist-investor_taxes.php', array('data' => $taxes, 'loop' => 'data')); ?>
				        </tbody>
			      	</table>

			      	<?php } else { ?>

					<div style="display: table; width: 100%; min-height: 300px; background-color: lightgray;">
						<div style="display: table-cell; color: white; font-size: 30px; font-weight: bold; text-align: center; vertical-align: middle; padding: 0 20%;">
							<p>You have no tax documents.</p>
						</div>
					</div>

			      	<?php } ?>

				</div>	

			</div>

		</div>

	</div>

</div>


<?php get_footer();
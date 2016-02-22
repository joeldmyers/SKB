<?php
/*
 * Template Name: Investments tab
 */

$args = array(
    'posts_per_page' => -1,
    'offset' => 0,
    'orderby' => 'date',
    'order' => 'DESC',
    'post_type' => 'investment_deal',
    'post_mime_type' => '',
    'post_parent' => '',
    'author' => '',
    'post_status' => array('publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash', 'approved', 'processing'),
    'suppress_filters' => true
);
$investments = get_posts($args);

// new investments toggle
$new_investments = false;
?>
<div role="tabpanel" class="tab-pane fade in inactive" id="investments">
    <div class="col-xs-12 col-sm-12">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr class="active">
                        <th>ID</th>
                        <th>Status</th>
                        <th>Name</th>
                        <th>Date Added</th>
                        <th>Entity</th>
                        <th>Offering</th>
                        <th></th>
                        <th></th>
                        <th></th> 
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($investments as $investment) { ?>
                    
                        <tr>
                            
                                <td><a href="<?php echo $investment->guid; ?>"><?php echo $investment->ID; ?></a></td> 

                                <td>
                                    <?php
                                    $post_status = get_post_status_object(get_post_status($investment->ID));
                                    if ($post_status->label == 'Pending') {
                                        $new_investments = true;
                                        echo '<form method="post" action=""><button class="form-control" id="approve_entity_id" name="approve_entity_id" value="' . $investment->ID . '">Approve</button></form>';
                                    } else {
                                        echo ucfirst($post_status->label);
                                    }
                                    ?>
                                </td>

                                <td><?php echo $investment->post_title; ?></td>

                                <td><?php echo get_the_date('l, M. j, Y', $investment->ID); ?></td>

                                <td><?php echo ucfirst(get_post_meta($investment->ID, 'investment_deal_entity', true)); ?></td>

                                <td><?php echo get_the_title(get_post_meta($investment->ID, 'investment_deal_investment', true)); ?></td>

                                <td>
                                    <?php
                                    $doc_status = 'unsigned'; //get_post_status_object( get_post_status( $entity->ID) );
                                    // TODO
                                    if ($doc_status == 'unsigned') {
                                        echo '<a href="create-docs/?i_id='.$investment->ID.'"><button class="form-control" id="create_docs" name="create_docs" value="' . $investment->ID . '">Create Docs</button></a>';
                                    }
                                    ?>
                                </td>

                                <td>
                                    <?php
                                    $return_sign_status = true; //get_post_status_object( get_post_status( $entity->ID) );
                                    // TODO
                                    if ($return_sign_status == true) {
                                        echo '<a href="create-docs/?i_id='.$investment->ID.'"><button class="form-control" id="sign_docs" name="sign_docs" value="' . $investment->ID . '">Sign Docs</button></a>';
                                    } else {
                                        echo 'Docs Signed';
                                    }
                                    ?>
                                </td>

                                <td><?php
                                    // if docs not signed show button echo ucfirst( get_post_meta($investment->ID, 'investment_entity_type', true )); 
                                    echo '<form method="post" action=""><button class="form-control" id="send_investment_docs" name="send_investment_docs" value="' . $investment->ID . '">Send Docs</button></form>';
                                    ?>
                                </td>


                                <?php //echo '<pre>'; var_dump(get_post_meta($entity->ID, 'investment_entity_all_deals', false)); echo '</pre>';  ?>
                            
                        </tr>
                    
                        <?php } 
                        
                        if ($return_sign_status) {
                            echo '<script type="text/javascript">';
                            echo 'jQuery("#return-sign-status").show();';
                            echo '</script>';
                        }
                        
                        if ($new_investments) {
                            echo '<script type="text/javascript">';
                            echo 'jQuery("#portal-new-investments").show();';
                            echo '</script>';
                        }
                        
                        ?>
                </tbody>
                <tfoot>
                </tfoot>
            </table>
        </div>
    </div>
</div>
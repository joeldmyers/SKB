<<<<<<< HEAD
<?php
/*
 * 
 */

// show login form for logged out users
if (!is_user_logged_in() || !current_user_can('manage_options')) {

    echo '<div class="col-xs-12" id="main-content">';
    echo '<h1 id="login_form">Investor Login</h1>';
    echo do_shortcode('[skb_login_form]');
    echo '</div>';

    return;
}

?>

=======
<?php /*
 * 
 */
if ( !is_user_logged_in() || !current_user_can( 'manage_options' ) ) {
    
    echo '<div class="col-xs-12" id="main-content">';
    echo '<h1 id="login_form">Investor Login</h1>';
    echo do_shortcode( '[skb_login_form]' );
    echo '</div>';
    
    return;
}

$args = array(
        'posts_per_page'   => -1,
        'offset'           => 0,
        'orderby'          => 'date',
        'order'            => 'DESC',
        'post_type'        => 'investment_entity',
        'post_mime_type'   => '',
        'post_parent'      => '',
        'author'	   => '',
        'post_status'      => array('publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash', 'approved', 'processing'),
        'suppress_filters' => true 
);
$entities = get_posts( $args );

$args = array(
        'posts_per_page'   => -1,
        'offset'           => 0,
        'orderby'          => 'date',
        'order'            => 'DESC',
        'post_type'        => 'investment_deal',
        'post_mime_type'   => '',
        'post_parent'      => '',
        'author'	   => '',
        'post_status'      => array('publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash', 'approved', 'processing'),
        'suppress_filters' => true 
);
$investments = get_posts( $args );

if (isset($_POST['approve_entity_id'])) {
    wp_update_post(
            array(
                'ID' => $_POST['approve_entity_id'],
                'post_status' => 'publish'
                )
            );
}
?>

<div class="container">

    <div class="row">
        
>>>>>>> master
        <div class="col-xs-12">
            <ul class="nav nav-tabs" role="tablist" id="portal">
                <li role="presentation" class="active"><a href="#entities" aria-controls="entities" role="tab" data-toggle="tab">Entities</a></li>
                <li role="presentation" class="inactive"><a href="#investments" aria-controls="investments" role="tab" data-toggle="tab">Investments</a></li>
<<<<<<< HEAD
                <li role="presentation" class="inactive"><a href="#read" aria-controls="read" role="tab" data-toggle="tab">Read / Watch List</a></li>
=======
>>>>>>> master
            </ul>
            <br><br>	
        </div>

        <div class="tab-content">

<<<<<<< HEAD
            <?php get_template_part('portal/entities', 'tab'); ?>
            <?php get_template_part('portal/investments', 'tab'); ?>
            <?php get_template_part('portal/read', 'tab'); ?>

        </div>
=======
            <div role="tabpanel" class="tab-pane fade in active" id="entities">
                <div class="col-xs-12 col-sm-12">
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
                                        echo '<form method="post" action=""><button class="form-control" id="approve_entity_id" name="approve_entity_id" value="'.$entity->ID.'">Approve</button></form>';
                                    } else {
                                        echo ucfirst($post_status->label);
                                    }

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
            </div>
        </div>
            
        <div role="tabpanel" class="tab-pane fade in active" id="investments">
            <div class="col-xs-12 col-sm-12">
                    <div class="table-responsive">
                            <table class="table table-hover table-striped">
                            <thead>
                                <tr class="active">
                                        <th>ID</th>
                                        <th>Status</th>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Date Added</th>
                                        <th>Investment Type</th>
                                        <th># of Deals</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ( $investments as $investment ) { ?>

                                <tr>
                                    <td><?php echo $investment->ID; ?></td>

                                    <td><?php 

                                    $post_status = get_post_status_object( get_post_status( $investment->ID) );
                                    if ($post_status->label == 'Pending') {
                                        echo '<form method="post" action=""><button class="form-control" id="approve_entity_id" name="approve_entity_id" value="'.$investment->ID.'">Approve</button></form>';
                                    } else {
                                        echo ucfirst($post_status->label);
                                    }

                                    ?></td>
                                    
                                    <td><?php // if docs not signed show button echo ucfirst( get_post_meta($investment->ID, 'investment_entity_type', true )); 
                                        echo '<form method="post" action=""><button class="form-control" id="send_investment_docs" name="send_investment_docs" value="'.$investment->ID.'">Send Docs</button></form>';
                                    
                                    ?></td>

                                    <td><?php echo $investment->post_title; ?></td>

                                    <td><?php echo get_the_date('l, M. j, Y', $investment->ID); ?></td>

                                    <td><?php echo ucfirst( get_post_meta($investment->ID, 'investment_entity_type', true )); ?></td>
                                    <td><?php echo count( get_post_meta($investment->ID, 'investment_entity_all_deals', false )); ?></td>
                                    <?php //echo '<pre>'; var_dump(get_post_meta($entity->ID, 'investment_entity_all_deals', false)); echo '</pre>'; ?>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                            </tfoot>
                    </table>
                </div>
        </div>
    </div>
</div>
>>>>>>> master

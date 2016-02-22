<?php
/*
 * Template Name: Entities Tab
 */

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
$documents_creation = false;
// approve button
if (isset($_POST['approve_entity_id'])) {
    wp_update_post(
            array(
                'ID' => $_POST['approve_entity_id'],
                'post_status' => 'publish'
            )
    );
}

?>

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
                                        $documents_creation = true;
                                        echo '<form method="post" action=""><button class="form-control" id="approve_entity_id" name="approve_entity_id" value="'.$entity->ID.'">Approve</button></form>';
                                    } else {
                                        echo ucfirst($post_status->label);
                                    }
                                    ?>
                                    </td>                              
                                    

                                    <td><?php echo $entity->post_title; ?></td>

                                    <td><?php echo get_the_date('l, M. j, Y', $entity->ID); ?></td>

                                    <td><?php echo ucfirst( get_post_meta($entity->ID, 'investment_entity_type', true )); ?></td>
                                    <td><?php echo count( get_post_meta($entity->ID, 'investment_entity_all_deals', false )); ?></td>
                                    <?php //echo '<pre>'; var_dump(get_post_meta($entity->ID, 'investment_entity_all_deals', false)); echo '</pre>'; ?>
                                </tr>
                                <?php } 
                                
                                if ($documents_creation) {
                                    echo '<script type="text/javascript">';
                                    echo 'jQuery("#portal-documents-creation").show();';
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
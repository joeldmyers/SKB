<?php
/*
 * Template Name: Who has read this offering
 * Displays list of offerings read by investors
 */

$args = array(
    'post_type' => 'investment',
    'posts_per_page' => -1,
    'offset' => 0
);
$posts = get_posts($args);

?>

<div role="tabpanel" class="tab-pane fade in inactive" id="read">
    <div class="col-xs-12 col-sm-12">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <caption>Read List</caption>
                <thead>
                    <tr class="active">
                        <th>Offering</th>
                        <th>Investor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($posts as $post){ 
                        
                            $title = $post->post_title;
                            $read_list = array_unique(get_post_meta($post->ID, '_read_list', false));
//echo '<pre>';var_dump(get_post_meta($post->ID));echo '</pre>';
                            foreach ($read_list as $user_id) {
                                
                                $user = get_userdata($user_id);
                                $username = $user->user_login;
                                
                                
                                if (isset($username)){
                                    echo '<tr>';
                                    echo '<td>'.$title.'</td>';
                                    echo '<td>'.$username.'</td>';
                                    echo '</tr>';
                                }
                            }
                        }
                    ?>
                       
                </tbody>
                <tfoot>
                </tfoot>
            </table>
            
            <table class="table table-hover table-striped">
                <caption>Watch List</caption>
                <thead>
                    <tr class="active">
                        <th>Offering</th>
                        <th>Investor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($posts as $post){ 
                        
                            $title = $post->post_title;
                            $read_list = array_unique(get_post_meta($post->ID, '_watch_list', false));
//echo '<pre>';var_dump(get_post_meta($post->ID));echo '</pre>';
                            foreach ($read_list as $user_id) {
                                
                                $user = get_userdata($user_id);
                                $username = $user->user_login;
                                
                                
                                if (isset($username)){
                                    echo '<tr>';
                                    echo '<td>'.$title.'</td>';
                                    echo '<td>'.$username.'</td>';
                                    echo '</tr>';
                                }
                            }
                        }
                    ?>
                       
                </tbody>
                <tfoot>
                </tfoot>
            </table>
            
            <table class="table table-hover table-striped">
                <caption>Followers</caption>
                <thead>
                    <tr class="active">
                        <th>Offering</th>
                        <th>Investor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($posts as $post){ 
                        
                            $title = $post->post_title;
                            $read_list = array_unique(get_post_meta($post->ID, '_investment_followers', false));
                            
                            foreach ($read_list as $user_id) {
                                
                                $user = get_userdata($user_id);
                                $username = $user->user_login;
                                
                                
                                if (isset($username)){
                                    
                                    echo '<tr>';
                                    echo '<td>'.$title.'</td>';
                                    echo '<td>'.$username.'</td>';
                                    echo '</tr>';
                                }
                            }
                        }
                    ?>
                       
                </tbody>
                <tfoot>
                </tfoot>
            </table>
        </div>
    </div>
</div>
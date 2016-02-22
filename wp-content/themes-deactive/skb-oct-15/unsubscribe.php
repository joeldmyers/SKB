<?php 
/*
 * Template Name: Unsubscribe
 * handles unsubscribing
 */

if (!is_user_logged_in()) {
    wp_redirect(home_url('/my-account'));
}

get_header(); ?>

<div class="container">
    
    <div class="row">
        <div class="col-xs-12">
            <p class="text-center">&nbsp;</p>
        </div>
        <div class="col-xs-12">
            <div>
                <form>
                    <label for="unsubscribe_email">Enter your email address to unsubscribe
                    <input type="email" id="unsubscribe_email" name="unsubscribe_email" class="input input-lg" />
                    </label>
                    <input type="submit" value="Unsubscribe" class="input input-lg" />
                </form>
            </div>
        </div>
    </div>
    
</div>

<?php get_footer();
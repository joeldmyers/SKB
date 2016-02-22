<?php 
global $user;
if ( is_wp_error( $user ) ) {

    echo '<div class="alert alert-danger" role="alert">' . $user->get_error_message() . '</div>';

}

if ( isset( $_GET['register_user'] ) ) {

    $user_id = substr( $_GET['register_user'], 8 );

    $user = get_user_by( 'id', $user_id );

    if ( $user ) {

        $roles = $user->roles;

        if ( count( $roles == 1 ) && in_array( 'pending_investor', $roles ) ) {

            $user->remove_all_caps();
            $user->set_role( 'registered_investor' );

            echo '<div class="alert alert-info" role="alert">Thank you for confirming your email address. Please login below.</div>';

        }
    }
}

?>

<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" class="row">
    <div class="form-group col-xs-12 col-sm-6">
        <label for="username">Email</label>
        <input type="text" class="form-control" id="username" name="username" value="" placeholder="Enter your username/email">
    </div>
    <div class="form-group col-xs-12 col-sm-6">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" value="" placeholder="Enter your password">
    </div>
    <div class="form-group col-xs-12 col-sm-6">
        <input type="submit" class="btn btn-primary btn-lg" id="log_in" name="log_in" value="Log In"><br><br>
        <!-- <label><input type="checkbox" id="remember" name="remember" value="yes"> Remember me</label> -->
    </div>
</form>

<div class="clearfix"></div>

<p><a href="<?php echo wp_lostpassword_url( home_url( '/my-account' ) ); ?>" title="Reset your password">Forget your password?</a> | Not registered? <a href="<?php echo home_url( '/register/' ); ?>" title="Register">Get started now</a>!</p>
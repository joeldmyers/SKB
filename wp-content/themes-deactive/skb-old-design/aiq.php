<?php /* Template Name: AIQ */
if ( ! is_user_logged_in() ) {
  wp_redirect( home_url( '/my-account' ) );
}
get_header();
$theme_settings = get_option('skb_theme_settings');
$sidebar_content = $theme_settings['main_sidebar'];

$posts_page = get_queried_object();
$posts_page_id = get_queried_object_id();

if ( has_post_thumbnail( $posts_page_id ) ) {

    $hero_image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $posts_page_id ), 'full' );
    $hero_image = '<img class="img-responsive" src="' . $hero_image_src[0] . '">';
    echo '<div class="hero">' . $hero_image . '</div>';
    echo '<br><br>';

} 

echo '<div class="container">';
echo '<div class="row">';

if ( $sidebar_content != '' ) {

    echo '<div class="col-xs-12 col-sm-8">';
    $sidebar = true;

} else {

    echo '<div class="col-xs-12">';
    $sidebar = false;

}        

echo '<h1>' . get_the_title( $posts_page_id ) . '</h1>';

echo apply_filters( 'the_content', $posts_page->post_content );

$user_id = get_current_user_id();

$args = array(
    'user_id'   => $user_id,
);

$subs = Ninja_Forms()->subs()->get( $args );

foreach ( $subs as $sub ) {

    $form_ids[] = $sub->form_id;

}

?>

<?php if ( ! in_array( '2', $form_ids ) ) { ?>

<div class="radio">
  <label data-toggle="tooltip" data-placement="right" title="An individual who purchases securities for him/herself.">
    <input type="radio" name="redirect" id="individual" value="individual">
    Individual
  </label>
</div>

<?php }  ?>

<div class="radio">
  <label data-toggle="tooltip" data-placement="right" title="A legal arrangement in which an individual (the trustor) gives fiduciary control of property to a person or institution (the trustee) for the benefit of beneficiaries of the trust.">
    <input type="radio" name="redirect" id="trust" value="trust">
    Trust
</label>
</div>

<?php if ( ! in_array( '6', $form_ids ) ) { ?>

<div class="radio">
  <label data-toggle="tooltip" data-placement="right" title="Ownership of property by two or more people in which the survivors automatically gain ownership of a decedent's interest.">
    <input type="radio" name="redirect" id="joint-tenant" value="joint-tenant">
    Joint Tenants (Available only for married couples)
  </label>
</div>

<?php } ?>

<?php if ( ! in_array( '7', $form_ids ) ) { ?>

<div class="radio">
  <label data-toggle="tooltip" data-placement="right" title="Ownership of property by two or more people in which a decedent’s interest is passed on to the decedent’s heirs">
    <input type="radio" name="redirect" id="tenants-common" value="tenants-common">
    Tenants in Common (Available only for married couples)
  </label>
</div>

<?php } ?>

<?php if ( ! in_array( '8', $form_ids ) ) { ?>

<div class="radio">
  <label data-toggle="tooltip" data-placement="right" title="Any property that a married couple has acquired during their marriage.">
    <input type="radio" name="redirect" id="community-property" value="community-property">
    Community Property
  </label>
</div>

<?php } ?>

<div class="radio">
  <label data-toggle="tooltip" data-placement="right" title="IRA. A tax-deferred retirement account for an individual that permits individuals to set aside money each year, with earnings tax-deferred until withdrawals begin at age 59 1/2 or later.">
    <input type="radio" name="redirect" id="individual-retirement" value="individual-retirement">
    Individual Retirement Account
  </label>
</div>
<div class="radio">
  <label data-toggle="tooltip" data-placement="right" title="A business organization with one or more general partners, who manage the business and assume legal debts and obligations, and one or more limited partners, who are liable only to the extent of their investments and who receive the tax benefits of a general partnership.">
    <input type="radio" name="redirect" id="limited-partnership" value="limited-partnership">
    Limited Partnership
</label>
</div>
<div class="radio">
  <label data-toggle="tooltip" data-placement="right" title="LLC. A type of company whose owners and managers receive the limited liability of a corporation and (usually) the tax benefits of a general partnership.">
    <input type="radio" name="redirect" id="limited-liability" value="limited-liability">
    Limited Liability Company
  </label>
</div>
<div class="radio">
  <label data-toggle="tooltip" data-placement="right" title="The most common form of business organization, and one which is chartered by a state and given many legal rights and is taxed as an entity separate from its owners who have limited liability and control of its affairs and who do not receive the tax benefits of a general partnership.">
    <input type="radio" name="redirect" id="corporation" value="corporation">
    Corporation
  </label>
</div>

<!-- Existing Investors will be directed to this form from the signup page

<hr>

<div class="radio">
  <label>
    <input type="radio" name="redirect" id="existing_investor" value="existing-investor">
    I have already completed an Investor Questionnaire with SKB
</label>
</div>

-->

<script>
jQuery(document).ready( function (){
    jQuery('input[type="radio"]').on('click', function() {
     window.location = jQuery(this).val();
    });

    jQuery(function () {
        jQuery('[data-toggle="tooltip"]').tooltip()
    });
});
</script>

<?php

echo '</div>';

if ( $sidebar ) {

    echo '<div class="col-xs-12 col-sm-4">';
    echo '<div class="well">';
    echo do_shortcode( wpautop( $sidebar_content ) );
    echo '</div>';
    echo '</div>';

}

echo '</div>';
echo '</div>';

get_footer();
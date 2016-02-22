<?php /* Template Name: Opportunities */


get_header(); 


set_query_var( 'current_section', '' );
rewind_posts();


?>
<div class="row opportunities-top"><h2>IT'S ABOUT MORE<br />THAN JUST YOUR MONEY.</h2>
<p>We develop relationships with our investment partners, which is why our opportunities are only appropriate for a select group of qualified people. After all, not everyone is cut out for realizing not just investments — but long-term visions.</p>
</div>


<div class="container" id="active-deals">
	
    <div class="row">
        <div class="col-xs-12">
            <form name='investment-filters' id='investment-filters' method='POST' action='' enctype="application/x-www-form-urlencoded">
                <div class="form-group  col-lg-2">
                    <label for="states">States:</label>
                    <select class="form-control input-lg" name="states" id="states">
                        <option>ALL</option>
                        <option value="AL">Alabama</option>
                        <option value="AK">Alaska</option>
                        <option value="AZ">Arizona</option>
                        <option value="AR">Arkansas</option>
                        <option value="CA">California</option>
                        <option value="CO">Colorado</option>
                        <option value="CT">Connecticut</option>
                        <option value="DE">Delaware</option>
                        <option value="DC">District Of Columbia</option>
                        <option value="FL">Florida</option>
                        <option value="GA">Georgia</option>
                        <option value="HI">Hawaii</option>
                        <option value="ID">Idaho</option>
                        <option value="IL">Illinois</option>
                        <option value="IN">Indiana</option>
                        <option value="IA">Iowa</option>
                        <option value="KS">Kansas</option>
                        <option value="KY">Kentucky</option>
                        <option value="LA">Louisiana</option>
                        <option value="ME">Maine</option>
                        <option value="MD">Maryland</option>
                        <option value="MA">Massachusetts</option>
                        <option value="MI">Michigan</option>
                        <option value="MN">Minnesota</option>
                        <option value="MS">Mississippi</option>
                        <option value="MO">Missouri</option>
                        <option value="MT">Montana</option>
                        <option value="NE">Nebraska</option>
                        <option value="NV">Nevada</option>
                        <option value="NH">New Hampshire</option>
                        <option value="NJ">New Jersey</option>
                        <option value="NM">New Mexico</option>
                        <option value="NY">New York</option>
                        <option value="NC">North Carolina</option>
                        <option value="ND">North Dakota</option>
                        <option value="OH">Ohio</option>
                        <option value="OK">Oklahoma</option>
                        <option value="OR">Oregon</option>
                        <option value="PA">Pennsylvania</option>
                        <option value="RI">Rhode Island</option>
                        <option value="SC">South Carolina</option>
                        <option value="SD">South Dakota</option>
                        <option value="TN">Tennessee</option>
                        <option value="TX">Texas</option>
                        <option value="UT">Utah</option>
                        <option value="VT">Vermont</option>
                        <option value="VA">Virginia</option>
                        <option value="WA">Washington</option>
                        <option value="WV">West Virginia</option>
                        <option value="WI">Wisconsin</option>
                        <option value="WY">Wyoming</option>
                    </select>
                </div>
                <div class="form-group  col-lg-3">
                    <label for="categories">Investment Categories:</label>
                    <select class="form-control input-lg" name="categories" id="categories">
                        <option>ALL</option>
                        <option>Core</option>
                        <option>Core Plus</option>
                        <option>Value Add</option>
                        <option>Opportunistic</option>
                    </select>
                </div>
                <div class="form-group  col-lg-3">
                    <label for="types">Property Types:</label>
                    <select class="form-control input-lg" name="types" id="types">
                        <option>ALL</option>
                        <option>Office</option>
                        <option>Mixed-Use</option>
                        <option>Retail</option>
                        <option>Flex</option>
                        <option>Industrial</option>
                    </select>
                </div>
                <div class="form-group  col-lg-3">
                    <label for="search">Search Investments:</label>
                    <input type="text" class="form-control input-lg" name="search" id="search" />
                    
                <?php //get_search_form(); ?>
                </div>
                <div class="form-group  col-lg-1">
                    <label for="search-submit"></label>
                    <input type='submit' value='SEARCH' id='search-submit' />
                </div>
            </form>
        </div>
    </div>
    <div class="row"> 
		<div class="col-xs-12">
			<h2>Active Deals</h2>
		</div>
	</div>
	<div class="row"> 
            
		<?php get_template_part( 'library/templates/loop', 'investment' ); ?>
	</div>
</div>
<hr>
<?php
set_query_var( 'current_section', 'coming' );
rewind_posts();
?>
<div class="container" id="coming-attractions">
	<div class="row"> 
		<div class="col-xs-12">
			<h2>Coming Attractions</h2>
		</div>
	</div>
	<div class="row"> 
		<?php get_template_part( 'library/templates/loop', 'investment' ); ?>
	</div>
</div>
<hr>
<?php
set_query_var( 'current_section', 'closed' );
rewind_posts(); 
?>
<div class="container" id="closed-deals">
	<div class="row"> 
		<div class="col-xs-12">
			<h2>Closed Deals <span style="font-size: 12px;"><i class="dashicons dashicons-plus-alt" style="font-size: 12px; height: 12px; width: 12px; vertical-align: text-top;"></i> Indicates Case Study</span></h2>
		</div>
	</div>
	<div class="row"> 
		<?php get_template_part( 'library/templates/loop', 'investment' ); ?>
	</div>
</div>



<?php get_footer(); ?>

<script type="text/javascript">
    jQuery(document).ready(function($) {
    
    <?php if (isset($_POST['states'])): ?>
        $('#states').val('<?php echo $_POST['states']; ?>');
        if ('<?php echo $_POST['states']; ?>' != 'ALL') {
            $('div.deal-container:not(".<?php echo $_POST['states']; ?>")').addClass('states-disabled');
        }
    <?php endif; ?>
        
    <?php if (isset($_POST['categories'])): ?>
        $('#categories').val('<?php echo $_POST['categories']; ?>');
        if ('<?php echo $_POST['categories']; ?>' != 'ALL') {
            $('div.deal-container:not(".<?php echo $_POST['categories']; ?>")').addClass('categories-disabled');
        }
    <?php endif; ?>
        
    <?php if (isset($_POST['types'])): ?>
        $('#types').val('<?php echo $_POST['types']; ?>');
        if ('<?php echo $_POST['types']; ?>' != 'ALL') {
            $('div.deal-container:not(".<?php echo $_POST['types']; ?>")').addClass('types-disabled');
        }
    <?php endif; ?>
        
    <?php if (isset($_POST['search'])): ?>
        $('#investment-filters').after('<div class="col-xs-12"><h2>Searching for "<?php echo $_POST['search']; ?>"</h2></div>');
        $('#search').val('<?php echo $_POST['search']; ?>');
    <?php endif; ?>
        
        
        $('#states, #categories, #types').on('input', function() {
        var s = this.value;
        console.log(this.value);
            if (s == 'ALL') {
                $('.deal-container').removeClass(this.id+'-disabled');
                return;
            }
            $('.deal-container').removeClass(this.id+'-disabled');
            $("div.deal-container:not('."+this.value+"')").addClass(this.id+'-disabled');
        });
    });
</script>
        
<?php
        
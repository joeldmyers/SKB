<?php

/**
 * Don't give direct access to the template
 */ 
if(!class_exists("RGForms")){
   return;
}

 global $gfpdf;

 $config_data = $gfpdf->get_default_config_data($form_id);

/**
 * Load the form data to pass to our PDF generating function 
 */
$form = RGFormsModel::get_form_meta($form_id);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <link rel="stylesheet" href="<?php echo GFCommon::get_base_url(); ?>/css/print.css" type="text/css" />
    <link rel='stylesheet' href='<?php echo PDF_PLUGIN_URL .'initialisation/template.css'; ?>' type='text/css' />
    <title>Gravity PDF</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
    <body>
        <div class="two_row">
            <?php
                /*
                 * Loop through the entries
                 * There is usually only one but you can pass more IDs through the lid URL parameter
                 */
                foreach($lead_ids as $lead_id) {
                    /* load the lead information */
                    $lead = RGFormsModel::get_lead($lead_id);

                    /* generate the entry HTML */
                    GFPDFEntryDetail::do_lead_detail_grid($form, $lead, $config_data);
                }
            ?>
        </div>
    </body>
</html>
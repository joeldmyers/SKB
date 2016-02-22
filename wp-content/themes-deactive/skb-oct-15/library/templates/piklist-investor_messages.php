<tr>
    <td></td>
    <td scope="row"><?php echo $data['investor_message_date']; ?></td>
    <td><?php //echo $data['investor_message_entity']; ?></td>
    <td><?php echo $data['investor_message_investment']; ?></td>    
    <td><?php echo $data['investor_message_subject']; ?></td>
    <td><button type="button" class="btn-xs btn-primary" id="<?php echo $data['investor_message_postid']; ?>" data-toggle="modal" href="#modal_<?php echo $i; ?>" aria-expanded="false" aria-controls="collapse<?php echo $i; ?>"><span class="dashicons dashicons-plus-alt"></span></button></td>
<td id="<?php echo 'msg_status_' . $data['investor_message_postid'] ?>"><?php echo $data['investor_message_status']; ?></td>
</tr>    
   
    
<div id="modal_<?php echo $i; ?>" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Subject: <?php echo $data['investor_message_subject']; ?></h4>
                </div>
                <div class="modal-body">
                  
                  <p class="small"><?php echo $data['investor_message_investment']; ?></p>
                  <p class="small"><?php echo $data['investor_message_date']; ?></p>
                  <p>---</p>
                  <p><?php echo $data['investor_message_content']; ?></p>
                  
                  
                </div>
                <div class="modal-footer">
                    <div class="col-xs-10 text-left">
                        <span class="glyphicon glyphicon-print" type="button"></span>
                        <span class="glyphicon glyphicon-download" type="button"></span>
                    </div>
                    <div class="col-xs-2 text-right">
                        <button class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


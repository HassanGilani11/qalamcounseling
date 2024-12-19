<div class="quomodo-container-fluid ">
     <div class="quomodo-row">
         <div class="quomodo-col-12">
             <div class="cr-email-header">
                <h3> <?php echo esc_html__("Customer Request Email List"); ?> </h3>
             </div>
         </div>
     </div>
     <div class="quomodo-row">
         <div class="quomodo-col-12">
             <?php $email_list = $this->ecollect(); ?>
            <table id="element-ready-cf-email-list" class="display element-ready-pro-email-list-table" style="width:100%">
                <thead>
                    <tr>
                        <th><?php echo esc_html__('Id','element-ready-pro') ?></th>
                        <th><?php echo esc_html__('Email','element-ready-pro') ?></th>
                    
                    </tr>
                </thead>
                <tbody>
                
                    <?php foreach($email_list as $id => $item): ?>
                    <tr>
                        <td> <?php echo esc_attr(++$id); ?> </td>
                        <td><?php echo esc_html($item->email); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                    
                    </tr>
                </tfoot>
            </table>
         </div>
     </div>
</div>

<script>
    jQuery(document).ready(function($) {
        //use ajax to speed loading
    $('#element-ready-cf-email-list').DataTable();
    $.fn.dataTableExt.oStdClasses["sFilter"] = "my-style-class";
} );
</script>
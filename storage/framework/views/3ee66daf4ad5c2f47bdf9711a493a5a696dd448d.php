<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo e($invoice->name); ?></title>
        <style>
            * {
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
            }

            h1,h2,h3,h4,h5,h6,p,span,div { 
                font-family: DejaVu Sans; 
                font-size:10px;
                font-weight: normal;
            }

            th,td { 
                font-family: DejaVu Sans; 
                font-size:10px;
            }

            .panel {
                margin-bottom: 20px;
                background-color: #fff;
                border: 1px solid transparent;
                border-radius: 4px;
                -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
                box-shadow: 0 1px 1px rgba(0,0,0,.05);
            }

            .panel-default {
                border-color: #ddd;
            }

            .panel-body {
                padding: 15px;
            }

            table {
                width: 100%;
                max-width: 100%;
                margin-bottom: 0px;
                border-spacing: 0;
                border-collapse: collapse;
                background-color: transparent;

            }

            thead  {
                text-align: left;
                display: table-header-group;
                vertical-align: middle;
            }

            th, td  {
                border: 1px solid #ddd;
                padding: 6px;
            }

            .well {
                min-height: 20px;
                padding: 19px;
                margin-bottom: 20px;
                background-color: #f5f5f5;
                border: 1px solid #e3e3e3;
                border-radius: 4px;
                -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
                box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
            }
        </style>
        <?php if($invoice->duplicate_header): ?>
            <style>
                @page  { margin-top: 140px;}
                header {
                    top: -100px;
                    position: fixed;
                }
            </style>
        <?php endif; ?>
    </head>
    <body>
        <header>
            <div style="position:absolute; left:0pt; width:250pt;">
                <img class="img-rounded" height="<?php echo e($invoice->logo_height); ?>" src="<?php echo e($invoice->logo); ?>">
            </div>
            <div style="margin-left:300pt;">
                <b>Date: </b> <?php echo e($invoice->date->formatLocalized('%A %d %B %Y')); ?><br />
                <?php if($invoice->due_date): ?>
                    <b>Due date: </b><?php echo e($invoice->due_date->formatLocalized('%A %d %B %Y')); ?><br />
                <?php endif; ?>
                <?php if($invoice->number): ?>
                    <b>Invoice #: </b> <?php echo e($invoice->number); ?>

                <?php endif; ?>
                <br />
            </div>
            <br />
            <h2><?php echo e($invoice->name); ?> <?php echo e($invoice->number ? '#' . $invoice->number : ''); ?></h2>
        </header>
        <main>
            <div style="clear:both; position:relative;">
                <div style="position:absolute; left:0pt; width:250pt;">
                    <h4>Business Details:</h4>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php echo $invoice->business_details->count() == 0 ? '<i>No business details</i><br />' : ''; ?>

                            <?php echo e($invoice->business_details->get('name')); ?><br />
                            ID: <?php echo e($invoice->business_details->get('id')); ?><br />
                            <?php echo e($invoice->business_details->get('phone')); ?><br />
                            <?php echo e($invoice->business_details->get('location')); ?><br />
                            <?php echo e($invoice->business_details->get('zip')); ?> <?php echo e($invoice->business_details->get('city')); ?>

                            <?php echo e($invoice->business_details->get('country')); ?><br />
                        </div>
                    </div>
                </div>
                <div style="margin-left: 300pt;">
                    <h4>Customer Details:</h4>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php echo $invoice->customer_details->count() == 0 ? '<i>No customer details</i><br />' : ''; ?>

                            <?php echo e($invoice->customer_details->get('name')); ?><br />
                            ID: <?php echo e($invoice->customer_details->get('id')); ?><br />
                            <?php echo e($invoice->customer_details->get('phone')); ?><br />
                            <?php echo e($invoice->customer_details->get('location')); ?><br />
                            <?php echo e($invoice->customer_details->get('zip')); ?> <?php echo e($invoice->customer_details->get('city')); ?>

                            <?php echo e($invoice->customer_details->get('country')); ?><br />
                        </div>
                    </div>
                </div>
            </div>
            <h4>Items:</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <?php if($invoice->shouldDisplayImageColumn()): ?>
                            <th>Image</th>
                        <?php endif; ?>
                        <th>ID</th>
                        <th>Item Name</th>
                        <th>Price</th>
                        <th>Amount</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $invoice->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <?php if($invoice->shouldDisplayImageColumn()): ?>
                                <td><?php if(!is_null($item->get('imageUrl'))): ?> <img src="<?php echo e(url($item->get('imageUrl'))); ?>" /><?php endif; ?></td>
                            <?php endif; ?>
                            <td><?php echo e($item->get('id')); ?></td>
                            <td><?php echo e($item->get('name')); ?></td>
                            <td><?php echo e($item->get('price')); ?> <?php echo e($invoice->formatCurrency()->symbol); ?></td>
                            <td><?php echo e($item->get('ammount')); ?></td>
                            <td><?php echo e($item->get('totalPrice')); ?> <?php echo e($invoice->formatCurrency()->symbol); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <div style="clear:both; position:relative;">
                <?php if($invoice->notes): ?>
                    <div style="position:absolute; left:0pt; width:250pt;">
                        <h4>Notes:</h4>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <?php echo e($invoice->notes); ?>

                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div style="margin-left: 300pt;">
                    <h4>Total:</h4>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td><b>Subtotal</b></td>
                                <td><?php echo e($invoice->subTotalPriceFormatted()); ?> <?php echo e($invoice->formatCurrency()->symbol); ?></td>
                            </tr>
                            <?php $__currentLoopData = $invoice->tax_rates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax_rate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <b>
                                            <?php echo e($tax_rate['name'].' '.($tax_rate['tax_type'] == 'percentage' ? '(' . $tax_rate['tax'] . '%)' : '')); ?>

                                        </b>
                                    </td>
                                    <td><?php echo e($invoice->taxPriceFormatted((object)$tax_rate)); ?> <?php echo e($invoice->formatCurrency()->symbol); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><b>TOTAL</b></td>
                                <td><b><?php echo e($invoice->totalPriceFormatted()); ?> <?php echo e($invoice->formatCurrency()->symbol); ?></b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php if($invoice->footnote): ?>
                <br /><br />
                <div class="well">
                    <?php echo e($invoice->footnote); ?>

                </div>
            <?php endif; ?>
        </main>

        <!-- Page count -->
        <script type="text/php">
            if (isset($pdf) && $GLOBALS['with_pagination'] && $PAGE_COUNT > 1) {
                $pageText = "{PAGE_NUM} of {PAGE_COUNT}";
                $pdf->page_text(($pdf->get_width()/2) - (strlen($pageText) / 2), $pdf->get_height()-20, $pageText, $fontMetrics->get_font("DejaVu Sans, Arial, Helvetica, sans-serif", "normal"), 7, array(0,0,0));
            }
        </script>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\language\vendor\consoletvs\invoices\Templates\default.blade.php ENDPATH**/ ?>
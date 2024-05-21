

<?php $__env->startSection('title', __('labels.backend.payments.title').' | '.app_name()); ?>

<?php $__env->startSection('content'); ?>

    <div class="card">
        <div class="card-header">
            <h3 class="page-title d-inline"><?php echo app('translator')->get('labels.backend.payments.title'); ?></h3>
            <div class="float-right">
                <a href="<?php echo e(route('admin.payments.withdraw_request')); ?>"
                   class="btn btn-success"><?php echo app('translator')->get('labels.backend.payments.add_withdrawal_request'); ?></a>

            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-lg-3">
                    <div class="card text-white bg-primary text-center">
                        <div class="card-body">
                            <h2 class=""><?php echo e($appCurrency['symbol'].' '.number_format($total_earnings,2)); ?></h2>
                            <h5><?php echo app('translator')->get('labels.backend.payments.total_earnings'); ?></h5>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-3">
                    <div class="card text-white bg-primary text-center">
                        <div class="card-body">
                            <h2 class=""><?php echo e($appCurrency['symbol'].' '.number_format($total_withdrawal,2)); ?></h2>
                            <h5><?php echo app('translator')->get('labels.backend.payments.total_withdrawals'); ?></h5>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-3">
                    <div class="card text-white bg-primary text-center">
                        <div class="card-body">
                            <h2 class=""><?php echo e($appCurrency['symbol'].' '.number_format($total_withdrawal_pending,2)); ?></h2>
                            <h5><?php echo app('translator')->get('labels.backend.payments.total_withdrawal_pending'); ?></h5>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-3">
                    <div class="card text-white bg-primary text-center">
                        <div class="card-body">
                            <h2 class=""><?php echo e($appCurrency['symbol'].' '.number_format($total_balance,2)); ?></h2>
                            <h5><?php echo app('translator')->get('labels.backend.payments.total_balance'); ?></h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a data-toggle="tab" class="nav-link active " href="#earning">
                                <?php echo e(__('labels.backend.payments.earnings')); ?>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="tab" class="nav-link" href="#withdrawal">
                                <?php echo e(__('labels.backend.payments.withdrawals')); ?>

                            </a>
                        </li>
                    </ul>
                </div><!--col-->
            </div><!--row-->
            <div class="tab-content">
                <!---Earning Tab--->
                <div id="earning" class="tab-pane container active">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="earningTable" class="table table-bordered table-striped ">
                                <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('labels.general.sr_no'); ?></th>
                                    <th><?php echo app('translator')->get('labels.general.id'); ?></th>
                                    <th><?php echo app('translator')->get('labels.backend.orders.fields.reference_no'); ?></th>
                                    <th><?php echo app('translator')->get('labels.backend.certificates.fields.course_name'); ?></th>
                                    <th><?php echo app('translator')->get('labels.backend.reports.fields.user'); ?></th>
                                    <th><?php echo app('translator')->get('labels.backend.payments.fields.amount'); ?></th>
                                    <th><?php echo app('translator')->get('labels.backend.payments.fields.date'); ?></th>
                                    <th><?php echo app('translator')->get('strings.backend.general.actions'); ?></th>
                                </tr>
                                </thead>

                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="withdrawal" class="tab-pane container">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="withdrawalTable" class="table table-bordered table-striped ">
                                <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('labels.general.sr_no'); ?></th>
                                    <th><?php echo app('translator')->get('labels.general.id'); ?></th>
                                    <th><?php echo app('translator')->get('labels.backend.payments.fields.amount'); ?></th>
                                    <th><?php echo app('translator')->get('labels.backend.payments.fields.payment_type'); ?></th>
                                    <th><?php echo app('translator')->get('labels.backend.payments.fields.status'); ?></th>
                                    <th><?php echo app('translator')->get('labels.backend.payments.fields.remarks'); ?></th>
                                    <th><?php echo app('translator')->get('labels.backend.payments.fields.date'); ?></th>
                                </tr>
                                </thead>

                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-scripts'); ?>
    <script>

        $(document).ready(function () {
            var withdrawal_route = '<?php echo e(route('admin.payments.get_withdrawal_data')); ?>';
            var earning_route = '<?php echo e(route('admin.payments.get_earning_data')); ?>';


            $('#earningTable').DataTable({
                processing: true,
                serverSide: true,
                iDisplayLength: 10,
                retrieve: true,
                dom: 'lfBrtip<"actions">',
                buttons: [
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [ 0,1, 2,3,4,6]
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [ 0,1, 2,3,4,6]
                        }
                    },
                    'colvis'
                ],
                ajax: earning_route,
                columns: [

                    {data: "DT_RowIndex", name: 'DT_RowIndex', width: '8%'},
                    {data: "id", name: 'id', width: '8%'},
                    {data: "reference_no", name: 'reference_no'},
                    {data: "course", name: 'course'},
                    {data: "user", name: 'user'},
                    {data: "amount", name: 'amount'},
                    {data: "created_at", name: 'created_at'},
                    {data: "actions", name: 'actions'},
                ],
                createdRow: function (row, data, dataIndex) {
                    $(row).attr('data-entry-id', data.id);
                },
                language:{
                    url : "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/<?php echo e($locale_full_name); ?>.json",
                    buttons :{
                        colvis : '<?php echo e(trans("datatable.colvis")); ?>',
                        pdf : '<?php echo e(trans("datatable.pdf")); ?>',
                        csv : '<?php echo e(trans("datatable.csv")); ?>',
                    }
                },

            });

            $('#withdrawalTable').DataTable({
                processing: true,
                serverSide: true,
                iDisplayLength: 10,
                retrieve: true,
                dom: 'lfBrtip<"actions">',
                buttons: [
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: ':visible',
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: ':visible',
                        }
                    },
                    'colvis'
                ],
                ajax: withdrawal_route,
                columns: [

                    {data: "DT_RowIndex", name: 'DT_RowIndex', width: '8%'},
                    {data: "id", name: 'id', width: '8%'},
                    {data: "amount", name: 'amount'},
                    {data: "payment_type", name: 'payment_type'},
                    {data: "status", name: 'status'},
                    {data: "remarks", name: 'remarks'},
                    {data: "created_at", name: 'created_at'},
                ],
                language:{
                    url : "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/<?php echo e($locale_full_name); ?>.json",
                    buttons :{
                        colvis : '<?php echo e(trans("datatable.colvis")); ?>',
                        pdf : '<?php echo e(trans("datatable.pdf")); ?>',
                        csv : '<?php echo e(trans("datatable.csv")); ?>',
                    }
                },
                createdRow: function (row, data, dataIndex) {
                    $(row).attr('data-entry-id', data.id);
                },
            });
        });

    </script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\language\resources\views/backend/payments/payment.blade.php ENDPATH**/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>

    <style>
        * {
            margin: 0;
            box-sizing: border-box;
        }

        body {
            margin: 0;
            height: 100%;
            width: 100%;
            page-break-inside: avoid;
        }

        table {
            width: 100%;
            height: 9%;
            text-align: center;
        }

        .header, .footer {
            background-color: #60a5fa;
        }

        td {
            vertical-align: middle;
        }

        .container {
            width: 100%;
            /* margin: 5% 0; */
        }

        .inner-table {
            width: 80%;
            border: 1px solid black;
            margin: 5% auto; /* Center the table horizontally */
        }

        td.inner-cell {
            height: 50px;
            width: 50%;
        }

        td.course-cell {
            height: 50px;
            width: 33%;
        }

    </style>
</head>
<body>
    <table class="header">
        <tr>
            <td>
                <h1>Margie's Magical Verbs</h1>
            </td>
        </tr>
    </table>

    <div class="container">
        <table class="inner-table">
            <tr>
                <td class="inner-cell">
                    <h3>Invoice: <?php echo e($order->id ?? 'N/A'); ?></h3>
                </td>
                <td class="inner-cell">
                    <h3>Date: <?php echo e(optional($order->created_at)->format('d-m-y') ?? 'N/A'); ?></h3>
                </td>
            </tr>
        </table>

        <table class="inner-table">
            <tr>
                <td class="inner-cell">
                    <h3>To:</h3>
                    <p><?php echo e($user->name); ?></p>
                </td>
                <td class="inner-cell">
                    <h3>From:</h3>
                    <p>Margie's Magical Verbs</p>
                </td>
            </tr>
        </table>

        <table class="inner-table">
            <tr>
                <th>ID</th>
                <th>Course</th>
                <th>Price</th>
            </tr>
            
            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="items">
                    <td class="course-cell"><?php echo e($item['item']['id'] ?? 'N/A'); ?></td>
                    <td class="course-cell"><?php echo e($item['item']['title'] ?? 'N/A'); ?></td>
                    <td class="course-cell"><?php echo e($item['item']['price'] ?? 'N/A'); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
        </table>

        <table class="inner-table">
        <tr>
        <td>Total: $<?php echo e(number_format($orderTotal, 2)); ?></td>
    </tr>
        </table>
    </div>

    <table class="footer">
        <tr>
            <td>
                <h5>ABN: 0330 404 282</h5>
            </td>
        </tr>
    </table>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\language\resources\views/vendor/invoices/default.blade.php ENDPATH**/ ?>
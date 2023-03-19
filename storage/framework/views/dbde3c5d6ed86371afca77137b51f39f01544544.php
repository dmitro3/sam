<?php $__env->startSection('page-title', trans('app.terminal')); ?>
<?php $__env->startSection('page-heading', trans('app.terminal')); ?>

<?php $__env->startSection('content'); ?>

<section class="content-header">
    <?php echo $__env->make('backend.partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</section>

<section class="content">
    <div class="subuheader">
        <div class="row">
            <div class="col-md-6">
                <div class="heading"><?php echo app('translator')->get('app.terminal'); ?> Details</div>
            </div>
            <div class="col-md-6 text-right">
                <a type="button" class="btn btn-primary text-uppercase text-white" data-toggle="modal"
                    data-target="#terminalAdd">
                    <i class="fa fa-plus-square"></i> <?php echo app('translator')->get('app.add_new_terminal'); ?></a>
            </div>
        </div>
    </div>
    <div class="mt-2">
        <div class="terminalsummary">
            <table class="table vm">
                <tr>
                    <td>
                        <div>
						<p class=""></p> <!-- comment this line -->
                            <!--<p class="usrimg"><img src="/back/img/novostarSL2.png" alt=""></p>-->
							<p class="usrimg"><img src="/back/img/10.png" alt=""></p>
                            <p class="usrname"><?php echo e($response['terminal']->username); ?></p>
                        </div>
                    </td>
                    <td>
                        <div>
                            <p>Balance</p>
                            <p><?php echo e(number_format(floatval($response['terminal']->balance), 2, '.', '')); ?></p>
                        </div>
                    </td>
                    <td>
                        <div>
                            <p>Total In</p>
                            <p><?php echo e(number_format(floatval($response['terminal']->total_in), 2, '.', '')); ?></p>
                        </div>
                    </td>
                    <td>
                        <div>
                            <p>Total Out</p>
                            <p><?php echo e(number_format(floatval($response['terminal']->total_out), 2, '.', '')); ?></p>
                        </div>
                    </td>
                    <td>
                        <div>
                            <p>Total</p>
                            <p><?php echo e(number_format(floatval($response['terminal']->count_balance), 2, '.', '')); ?></p>
                        </div>
                    </td>
                    <?php if(Auth::user()->hasRole('admin')): ?>
                    <td>
                        <p>
                            <a type="button" class="btn btn-success text-uppercase fw-bold text-white"
                                data-toggle="modal" data-target="#addCredit">
                                <i class="fa fa-plus-square"></i> Add
                            </a>
                        </p>
                        <p>
                            <a type="button" class="btn btn-danger text-uppercase fw-bold text-white"
                                data-toggle="modal" data-target="#outCredit">
                                <i class="fa fa-minus-square"></i> Out
                            </a></p>
                    </td>
                    <?php endif; ?>
                </tr>
            </table>
        </div>
    </div>

    <div class="mt-1">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a id="details-tab" class="fw-bold" data-toggle="tab" href="#details" aria-expanded="false">
                        Edit <?php echo app('translator')->get('app.terminal'); ?> </a>
                </li>
                <li>
                    <a id="authentication-tab" class="fw-bold" data-toggle="tab" href="#login-details"
                        aria-expanded="true">
                        Activity </a>
                </li>
                <li>
                    <a id="authentication-tab" class="fw-bold" data-toggle="tab" href="#ticketDetails"
                        aria-expanded="true">
                        Tickets </a>
                </li>
            </ul>

            <div class="tab-content" id="nav-tabContent">
                <!-- Edit user -->
                <div class="tab-pane active terminaldetails " id="details">
                    <form action="" method="POST">
                        <?php echo csrf_field(); ?>
                        <table class="table vm">
                            <tr>
                                <td>Shops</td>
                                <td class="w300"><input type="text" name="name" disabled class="form-control"
                                        value="<?php echo e($response['shop']->name); ?>"></td>

                                <td class="text-right">Username</td>
                                <td class=""><input type="text" name="username" class="form-control w250"
                                        value="<?php echo e($response['terminal']->username); ?>"></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>
                                    <select name="status" class="form-control w250">
                                        <?php $__currentLoopData = $response['statuses']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($status); ?>"
                                            <?=($response['terminal']->status==$status)?'selected':''?>><?php echo e($status); ?>

                                        </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                <td class="text-right">Language</td>
                                <td>
                                    <select name="language" class="form-control w250">
                                        <?php $__currentLoopData = $response['langs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($language); ?>"
                                            <?=($response['terminal']->language==$language)?'selected':''?>>
                                            <?php echo e($language); ?>

                                        </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td colspan="3"><input type="text" name="password" class="form-control w200"
                                        value="<?php echo e($response['terminal']->password); ?>"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td colspan="3">
                                    <button type="submit" class="btn btn-primary" id="update-details-btn">
                                        Update <?php echo app('translator')->get('app.terminal'); ?> </button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>

                <!-- Activity -->
                <div class="tab-pane" id="login-details">
                    <?php if(count($response['userActivity'])>0): ?>
                    <table class="table text-center table-bordered vm">
                        <thead>
                            <td>Date</td>
                            <td>IP Address</td>
                            <td>Country</td>
                            <td>City</td>
                            <td>Device</td>
                            <td>OS</td>
                            <td>Browser</td>
                            <td class="text-left">User Agent</td>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $response['userActivity']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($item->created_at); ?></td>
                                <td><?php echo e($item->ip_address); ?></td>
                                <td><?php echo e($item->country); ?></td>
                                <td><?php echo e($item->city); ?></td>
                                <td><?php echo e($item->device); ?></td>
                                <td><?php echo e($item->os); ?></td>
                                <td><?php echo e($item->browser); ?></td>
                                <td><?php echo e($item->user_agent); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                    <p class="noData">No activity from this user yet.</p>
                    <?php endif; ?>
                </div>

                <!-- Tickets -->
                <div class="tab-pane ticketDetails" id="ticketDetails">
                    <?php if(count($response['payTickets'])>0): ?>
                    <table class="table text-center table-bordered vm">
                        <thead>
                            <td class="text-left">PIN</td>
                            <td class="w150">Amount</td>
                            <td class="w150">Status</td>
                            <td class="w150">Updated On</td>
                            <td class="w150">Created On</td>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $response['payTickets']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="fw-bold text-left fs-20"><?php echo e($item->ticket_pin); ?></td>
                                <td class="fs-20 fw-bold">
                                    <?php echo e(number_format(floatval($item->ticket_amount), 2, '.', '')); ?></td>
                                <td>
                                    <span
                                        class="<?=($item->ticket_status==1)?'success':'pending'?>"><?=($item->ticket_status==1)?'Success':'Pending'?></span>
                                </td>
                                <td><?php echo e($item->updated_at); ?></td>
                                <td><?php echo e($item->created_at); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                    <p class="noData">No tickets from this user yet.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
	
	<section class="content-header">
    <style>
.btn-close:hover {
  color: #919191;
}
.modale:before {
  content: "";
  display: none;
  background: rgba(0, 0, 0, 0.6);
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  z-index: 10;
}
.opened:before {
  display: block;
}
.opened .modal-dialog {
  -webkit-transform: translate(0, 0);
  -ms-transform: translate(0, 0);
  transform: translate(0, 0);
  top: 20%;
}
.modal-dialog {
  background: #fefefe;
  /* border: #333333 solid 0px; */
  border-radius: 5px;
  margin-left: -100px;
  text-align:center;
  position: fixed;
  left: 50%;
  top: -100%;
  z-index: 11;
  width: 340px;
  padding-top:20px;
  padding-bottom:10px;
  box-shadow:0 5px 10px rgba(0,0,0,0.3);
  -webkit-transform: translate(0, -500%);
  -ms-transform: translate(0, -500%);
  transform: translate(0, -500%);
  -webkit-transition: -webkit-transform 2s ease-out;
  -moz-transition: -moz-transform 2s ease-out;
  -o-transition: -o-transform 2s ease-out;
  transition: transform 1s ease-out;
}
h2 {
    display:flex;
    font-size:22px;
    padding-left: 30px;

}
.modal-body {
  padding: 20px;
}
</style>

</section>

<section class="content">

        
    <div class="box box-primary">
        <div class="box-header with-border" style="display:flex; justify-content: center; align-items:center;">
            <h3 class="box-title" style="font-size: 24px; display:flex; justify-content:center;">Period</h3>
        </div>
    </div>
    
    <div class="grid-container" id="dateFromPicker">
        <div class="ui-bar-b">
            From
        </div>
        <div class="date-from grid-date input-group date">
            <input id="dateFrom" type="text" class="data-display-form form-control" value="" readonly>
            <div class="input-group-addon">
                <div class="datepicker-icon"></div>
            </div>
        </div>
        <div class="grid-time input-group date">
            <input id="timeFrom" type="text" name="time" class="time-display-form form-control" value="" readonly style="background-color: inherit;
        outline: none; border: none; font-size: 18px; font-weight: normal; padding-left: 0.475em; display: flex;
        align-items: center; height: unset; box-shadow: none;">
            <div class="input-group-addon" id="time-picki-from" style="cursor: pointer;">
                <div class="img-icon-clock"></div>
            </div>
        </div>
    </div>
    <div class="grid-container" id="dataTopicker" style="margin-top: 6px;">
        <div class="ui-bar-b">
            To
        </div>
        <div class="date-from grid-date input-group date">
            <input id="dateTo" class="data-display-form form-control" value="" readonly>
            <div class="input-group-addon">
                <div class="datepicker-icon"></div>
            </div>
        </div>
        <div class="grid-time input-group date">
            <input id="timeTo" type="text" name="time" class="time-display-form form-control" style="background-color: inherit;
        outline: none; border: none; font-size: 18px; font-weight: normal; padding-left: 0.475em; display: flex;
        align-items: center; height: unset; box-shadow: none" value="" readonly>
            <div class="input-group-addon" id="time-picki-to">
                <div class="img-icon-clock"></div>
            </div>
        </div>
    </div>
    <div class="grid-balance">
        <div class=" balance-title">In</div>
        <div class=" balance-title">Out</div>
        <div class=" balance-title">Netto</div>
    </div>
    <div class="grid-balance-content">
        <div id="totalIn" class=" balance-val">0.00 EUR</div>
        <div id="totalOut" class=" balance-val">0.00 EUR</div>
        <div id="netto" class=" balance-val">0.00 EUR</div>
    </div>
    <div class="box box-primary" >
        <div class="box-header with-border" style="border-radius:5px 5px 0px 0px; display:flex; align-items:center;">
            <h3 class="box-title" style="display:flex; padding-left:30px; font-size: 24px;">Transaction</h3>
        </div>
    </div>
    <div id="transaction_content">
            </div>


    
</section>

    <!-- Modals -->
    <?php echo $__env->make('backend.terminal.modals.add_credit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('backend.terminal.modals.out_credit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('backend.terminal.modals.terminal_add', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    var triggerTabList = [].slice.call(document.querySelectorAll('#myTab a'))
triggerTabList.forEach(function (triggerEl) {
  var tabTrigger = new bootstrap.Tab(triggerEl)

  triggerEl.addEventListener('click', function (event) {
    event.preventDefault()
    tabTrigger.show()
  })
})
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\localhost\resources\views/backend/terminal/details.blade.php ENDPATH**/ ?>
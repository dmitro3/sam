<div class="modal fade cusModel danger" id="outCredit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">

        <div class="modal-content text-center">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Balance Out
                </h5>
            </div>
            <form action="<?php echo e(url('backend/terminal/balance/out')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="user_id" value="<?php echo e($response['terminal']->id); ?>">
                <div class="modal-body">
                    <table class="table vm table-bordered">
                        <tr>
                            <td class="w200">
                                Amount
                                <p><span class="hint">Enter the amount you want to out.</span></p>
                            </td>
                            <td class="text-left"><input type="text" name="amount" required class="form-control fs-20 w250">

                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div><?php /**PATH C:\OSPanel\domains\localhost\resources\views/backend/terminal/modals/out_credit.blade.php ENDPATH**/ ?>
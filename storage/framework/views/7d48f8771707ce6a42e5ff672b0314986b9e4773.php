<html lang="en" class="">

<head>
    <meta charset="utf-8">
    <title>Admin | Panel</title>
    <meta name="description" content="Admin || GGinc || BackOffice">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="https://netbo.gapi.lol/css/v1/login/animate.css" type="text/css">
    <link rel="stylesheet" href="https://netbo.gapi.lol/css/v1/login/font-awesome.css" type="text/css">
    <link rel="stylesheet" href="https://netbo.gapi.lol/css/v1/login/simple-line-icons.css" type="text/css">
    <link rel="stylesheet" href="https://netbo.gapi.lol/css/v1/login/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="https://netbo.gapi.lol/css/v1/login/font.css" type="text/css">
    <link rel="stylesheet" href="https://netbo.gapi.lol/css/v1/login/app.css" type="text/css">
    <script src="/back/bower_components/jquery/dist/jquery.min.js"></script>
</head>

<body>
    <div class="app app-header-fixed">
        <div class="container w-xxl w-auto-xs">
            <a href="" class="navbar-brand block m-t">Administration Panel</a>
            <div class="m-b-lg">
               <div class="wrapper text-center">
                  
				    <strong>GoldSvet Mrs   </strong>
                </div>
                <?php echo $__env->make('backend.partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <form name="form" method="post" class="form-validation" action="<?= route('backend.auth.login.post') ?>">
                  <input type="hidden" value="<?= csrf_token() ?>" name="_token">
                  <div class="text-danger wrapper text-center" ng-show="authError">
                    </div>
                    <div class="list-group list-group-sm">
                        <div class="list-group-item">
                            <input type="text" placeholder="Username" name="username" class="form-control no-border"
                                required="">
                        </div>
                        <div class="list-group-item">
                            <input type="password" placeholder="Password" name="password" class="form-control no-border"
                                required="">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-lg btn-primary btn-block">Log in</button>
                    <div class="line line-dashed"></div>
                </form>
                         
                <?php echo $__env->make('backend.partials.localeSelector', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				                      <center> <strong>Go24Net,SARL <br> @2017-2022</strong></center>
            </div>
            <div class="text-center">
                <p>
                    <small class="text-center"><br></small>
                </p>
            </div>
        </div>
    </div>


</body>

</html>

<?php $__env->startSection('scripts'); ?>
    <?php echo JsValidator::formRequest('VanguardLTE\Http\Requests\Auth\LoginRequest', '#login-form'); ?>

<?php $__env->stopSection(); ?>
<?php /**PATH C:\OSPanel\domains\Gs85\resources\views/backend/auth/login.blade.php ENDPATH**/ ?>
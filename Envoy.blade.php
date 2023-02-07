@setup

$app_name = $_ENV['APP_NAME'] ?? 'Budget App';
$deploy_path = $_ENV['DEPLOY_PATH'] ?? null;
$branch = isset($branch) ? $branch : "main";
$date = ( new DateTime )->format('Y/m/d H:i:s');
$path = rtrim($deploy_path, '/');
$releases = $path.'/releases';
$release = $releases.'/'.$date;

$txt_msg =   $app_name . " - Has Been Completed Successfully Published New Release : " . $date . " - ";
$notification_msg = $txt_msg . 'at Branch : ' . $branch;

@endsetup

@servers(['prod' => ['bdeployer@104.248.137.37']])

{{-- first task  --}}
@task('deploy', ['on' => 'prod'])

{{-- do not use orginal_path variable here ,, it is not work probaply --}}
cd /var/www/applications/budgetapp

    git checkout {{ $branch }}
    git pull

{{-- this recommended with deploy but we have problem with thih this project so we will use composer update --}}
composer install --optimize-autoloader
{{--composer update--}}

{{--migratiion in main project and modules  --}}
@if ($with_m)
    @if ($module_m)
        php artisan module:migrate {{ $module_m }}
    @else
    php artisan migrate
    @endif
@endif

@php
// to change folder permission but need root access
// to do ,, make solution for this to make it can delete cache in this folder
 //   echo "chmod -R 777 storage/framework";
@endphp

{{--php artisan cache:clear--}}
php artisan config:clear
php artisan view:clear
php artisan config:cache
php artisan view:cache

@endtask

@task('deployment_npm')
    echo "Installing npm dependencies .."
    npm install --no-audit --no-fund --no-optional
    echo "Running npm..."
    npm run dev

    {{-- go to inside module and run npm --}}
    @if($module_npm)
        cd /var/www/applications/budgetapp/Modules/{{ $module_npm }}
        echo "Installing npm dependencies .. In "
        npm install --no-audit --no-fund --no-optional
        npm run dev
        cd /var/www/applications/budgetapp
    @endif

@endtask


@php

@endphp

@finished
    @telegram('5711589225:AAE0GyyhhIHBgjKpjFHwyEYcMSUG2rqxfGM','266984908',$notification_msg)
@endfinished

{{--@finished--}}
{{--        writeln('Congratulation ,, Your Deployment Process Completed Successfully ^_^ ');--}}
{{--@endfinished--}}




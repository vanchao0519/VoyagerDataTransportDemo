# VoyagerDataTransportDemo
A demonstrate how to use package <a href="https://github.com/vanchao0519/VoyagerDataTransport">VoyagerDataTransport</a>
<br>
This demo only list necessary files. You must create a laravel project before you check this demo
## Step 1
```php
php artisan voyager:data:transport posts
```
After you execute this command line. Your project will create these files below
<ul>
    <li>app
      <ul>
        <li>VoyagerDataTransport
            <ul>
                <li>Http
                    <ul>
                        <li>Controllers
                            <ul>
                                <li>ExportPosts.php</li>
                                <li>ImportPosts.php</li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul>
                <li>config
                    <ul>
                        <li>permissions
                            <ul>
                                <li>tables
                                <ul>
                                    <li>posts.php</li>
                                </ul>
                                </li>
                            </ul>
                            <ul>
                                <li>config.php</li>
                            </ul>
                        </li>
                    </ul>
                    <ul>
                        <li>route
                            <ul>
                                <li>tables
                                <ul>
                                    <li>posts.php</li>
                                </ul>
                                </li>
                            </ul>
                            <ul>
                                <li>config.php</li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
      </ul>
    </li>
</ul>
<ul>
    <li>resources
      <ul>
        <li>views
            <ul>
                <li>vendor
                    <ul>
                        <li>voyager
                            <ul>
                                <li>posts
                                    <ul>
                                        <li>browse.blade.php</li>
                                        <li>import-data.blade.php</li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
      </ul>
    </li>
</ul>

## Step 2
Manually add code to the file below:
<ul>
    <li>app
      <ul>
        <li>VoyagerDataTransport
            <ul>
                <li>config
                    <ul>
                        <li>permissions
                            <ul>
                                <li>config.php</li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
      </ul>
    </li>
</ul>

Add code snippet to the file
```php
$_configs = [];

foreach (glob(__DIR__ . '/tables/*.php') as $file) {
    $_config = require $file;
    $_config = !empty($_config) ? $_config : [];
    $_configs = array_merge($_configs, $_config) ;
}

return $_configs;
```
Manually add code to the file below:
<ul>
    <li>app
      <ul>
        <li>VoyagerDataTransport
            <ul>
                <li>config
                    <ul>
                        <li>route
                            <ul>
                                <li>config.php</li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
      </ul>
    </li>
</ul>

Add code snippet to the file
```php
$_configs = [];

foreach (glob(__DIR__ . '/tables/*.php') as $file) {
    $_config = require $file;
    $_config = !empty($_config) ? $_config : [];
    $_configs[] = $_config;
}

return $_configs;
```
Manually add code to the file below:
<ul>
    <li>app
        <ul>
            <li>Providers
                <ul>
                    <li>AuthServiceProvider.php</li>
                </ul>
            </li>
        </ul>
    </li>
</ul>

Add code snippet in boot function
```php
//Regist the privilege which can be used in blade template
$configs = require dirname(__DIR__, 1) . '/VoyagerDataTransport/config/permissions/config.php';

$configs = !empty($configs) ? $configs : [];

foreach ( $configs as $permission ) {
    Gate::define($permission, function (User $user) use ($permission) {
        return $user->hasPermission($permission);
    });
}

```

<ul>
    <li>routes
        <ul>
            <li>
                web.php
            </li>
        </ul>
    </li>
</ul>

Add code snippet at the bottom:
```php
Route::group(['prefix' => 'admin'], function () {
    $configs = require  dirname(__DIR__, 1) . "/app/VoyagerDataTransport/config/route/config.php";
    foreach ($configs as $config) {
        foreach ($config as $verb => $dataSets) {
            $verb = strtolower($verb);
            if (in_array($verb, ['get', 'post'])) {
                foreach ($dataSets as $dataSet) {
                    Route::$verb( $dataSet['url'], [
                        $dataSet['controllerName'],
                        $dataSet['actionName']
                    ])
                        ->name($dataSet['alias'])
                        ->middleware('admin.user');
                }
            }
        }
    }
});
```
## Step 3
Add your roles export/import privilege to your admin account, details below:
<br>
<br>
![gui-screen-shot-01](/guides/assets/images/screen-shot-01.png)
<br>
<br>
![gui-screen-shot-02](/guides/assets/images/screen-shot-02.png)
<br>
<br>
![gui-screen-shot-03](/guides/assets/images/screen-shot-03.png)
<br>
<br>


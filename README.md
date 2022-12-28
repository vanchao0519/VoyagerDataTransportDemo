# VoyagerDataTransportDemo
A demonstrate how to use package <a href="https://github.com/vanchao0519/VoyagerDataTransport">VoyagerDataTransport</a>
<br>
This demo only list necessary files. You must create a laravel project before you watch this demo
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
    Gate::define('browse_import_posts', function (App\Models\User $user) {
        return $user->hasPermission('browse_import_posts');
    });
    Gate::define('browse_export_posts', function (App\Models\User $user) {
        return $user->hasPermission('browse_export_posts');
    });
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
        Route::get('/import_posts', [App\VoyagerDataTransport\Http\Controllers\ImportPosts::class, 'index'])->name('voyager.browse_import_posts')->middleware('admin.user');
        Route::get('/export_posts', [App\VoyagerDataTransport\Http\Controllers\ExportPosts::class, 'export'])->name('voyager.browse_export_posts')->middleware('admin.user');
        Route::post('/import_posts/upload', [App\VoyagerDataTransport\Http\Controllers\ImportPosts::class, 'upload'])->name('voyager.import_posts.upload')->middleware('admin.user');
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


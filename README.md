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
                                        <li>export-data.blade.php</li>
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


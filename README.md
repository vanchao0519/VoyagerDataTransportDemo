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

## Step2
Manully add code to the files below:
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

Add code snippet to ImportPosts.php below:
```php
protected function importData(array $data)
{
    try {
        DB::transaction(
            function () use ($data) {
                DB::table('posts')
                    ->insert([
                        'title' => $data[self::TITLE_COL],
                        'excerpt' => $data[self::EXCERPT_COL],
                        'body' => $data[self::BODY_COL],
                        'image' => $data[self::IMAGE_COL],
                        'slug' => $data[self::SLUG_COL],
                        'meta_description' => $data[self::META_DESCRIPTION_COL],
                        'meta_keywords' => $data[self::META_KEYWORDS_COL],
                        'status' => $data[self::STATUS_COL],
                        'author_id' => 0,
                        'featured' => 0,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
            }
        );
        return ['status' => true, 'message' => 'data insert success'];
    } catch (\Exception $e) {
        DB::rollBack();
        return ['status' => false, 'message' => "{$e->getMessage()}"];
    }
}
```

Add code snippet to ExportPosts.php below:
```php
    protected function setSpreadSheet()
    {

        $title_col = 1;
        $excerpt_col = 2;
        $body_col = 3;
        $image_col = 4;
        $slug_col = 5;
        $meta_description_col = 6;
        $meta_keywords_col = 7;
        $status_col = 8;

        $colTitleMaps = [
            $title_col => 'title',
            $excerpt_col => 'excerpt',
            $body_col => 'body',
            $image_col => 'image',
            $slug_col => 'slug',
            $meta_description_col => 'meta_description',
            $meta_keywords_col => 'meta_keywords',
            $status_col => 'status',
        ];

        $colFieldMaps = [
            $title_col => function( $list ) { return $list->title; },
            $excerpt_col => function( $list ) { return $list->excerpt; },
            $body_col => function( $list ) { return $list->body; },
            $image_col => function( $list ) { return $list->image; },
            $slug_col => function( $list ) { return $list->slug; },
            $meta_description_col => function( $list ) { return $list->meta_description; },
            $meta_keywords_col => function( $list ) { return $list->meta_keywords; },
            $status_col => function( $list ) { return $list->status; },
        ];

        $row = 1;

        // Set header
        foreach ($colTitleMaps as $col => $title) {
            $this->sheet->setCellValueByColumnAndRow($col, $row, $title);
        }

        DB::table('posts')
            ->select($colTitleMaps)
            ->orderBy('id', 'asc')
            ->chunk(10, function($lists) use ( &$row, $colFieldMaps ) {
                foreach ($lists as $list) {
                    $row += 1;
                    foreach ($colFieldMaps as $col => $objFunc) {
                        $this->sheet->setCellValueByColumnAndRow($col, $row, $objFunc($list));
                    }
                }
            });
    }
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


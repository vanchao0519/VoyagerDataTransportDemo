<?php

namespace App\VoyagerDataTransport\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use VoyagerDataTransport\Traits\VoyagerImportData;

class ImportPosts extends Controller
{
    use VoyagerImportData;

    const TITLE_COL = 0;
    const EXCERPT_COL = 1;
    const BODY_COL = 2;
    const IMAGE_COL = 3;
    const SLUG_COL = 4;
    const META_DESCRIPTION_COL = 5;
    const META_KEYWORDS_COL = 6;
    const STATUS_COL = 7;

    public function index()
    {
        $this->authorize('browse_import_posts');
        return view('vendor.voyager.posts.import-data', []);
    }

    protected function setRedirectUrl()
    {
        $this->_redirectUrl = '/admin/posts';
    }

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

}

<?php

namespace App\VoyagerDataTransport\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use VoyagerDataTransport\Traits\VoyagerExportData;

class ExportPosts extends Controller
{
    use VoyagerExportData;

    protected function setWriterType()
    {
        $this->writerType = 'xlsx';
    }

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

}

@php
$_table_name = "posts";
$import_privilege = "browse_import_{$_table_name}";
$export_privilege = "browse_export_{$_table_name}";
$import_url = route("voyager.{$import_privilege}");
$export_url = route("voyager.{$export_privilege}");
@endphp
@extends('voyager::bread.browse')

@section('css')
    @parent
    <style>
        .mr-1 { margin-right: 0.325rem; }
    </style>
@stop
@section('javascript')
    @parent
    <script>
        function _dataInOutButton (href, btn_color_class, voyager_fonts_class, btn_text) {
            var _dom = '<a href="';
            _dom += href;
            _dom += '" class="btn ' + btn_color_class + ' mr-1">';
            _dom += '<i class="' + voyager_fonts_class + '"></i>';
            _dom += ' <span>' + btn_text + '</span>';
            _dom += '</a>';
            $( _dom ).insertBefore( ".table-responsive" );
        }
    </script>
    @can($import_privilege)
        <script>
            var btn_href = "{{$import_url}}";
            var btn_color_class = 'btn-success';
            var voyager_fonts_class = 'voyager-plus';
            var btn_text = 'Import Data';
            _dataInOutButton(btn_href, btn_color_class, voyager_fonts_class, btn_text);
        </script>
    @endcan
    @can($export_privilege)
        <script>
            var btn_href = "{{$export_url}}";
            var btn_color_class = 'btn-warning';
            var voyager_fonts_class = 'voyager-book-download';
            var btn_text = 'Export Data';
            _dataInOutButton(btn_href, btn_color_class, voyager_fonts_class, btn_text);
        </script>
    @endcan
@stop

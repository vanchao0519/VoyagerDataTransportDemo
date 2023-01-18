@php
    $_table_name = "posts";
    $download_url = route("voyager.export_{$_table_name}.download");
@endphp
@extends('voyager::master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <form action="{{$download_url}}" id="form" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <h4>Export type select</h4>
                                            <div>
                                                <label>xlsx</label>
                                                <input type="radio" name="export_type" value="10" checked/>
                                            </div>
                                            <div>
                                                <label>csv</label>
                                                <input type="radio" name="export_type" value="20"/>
                                            </div>
                                            <div>
                                                <label>pdf</label>
                                                <input type="radio" name="export_type" value="30"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box-footer">
                                            <input type="submit" class="btn btn-primary" name="submit" value="Download"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script>
    </script>
@stop

@php
    $_table_name = "posts";
    $upload_url = route("voyager.import_{$_table_name}.upload");
@endphp
@extends('voyager::master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <form action="{{$upload_url}}" id="form" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>File XLS / CSV</label>
                                            <input type="file" name="userfile" class="form-control" required/>
                                            <div class="help-block">
                                                File type supported only: XLS, XLSX, CSV
                                            </div>
                                            <div>
                                                <label>Skip header</label>
                                                <input type="radio" name="shouldSkipHeader" value="10" checked/>
                                            </div>
                                            <div>
                                                <label>Do not skip header</label>
                                                <input type="radio" name="shouldSkipHeader" value="20"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box-footer">
                                            <input type="submit" class="btn btn-primary" name="submit" value="Upload & Import"/>
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

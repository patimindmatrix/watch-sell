@php

    if(empty($singleRecord)){
        $singleRecord = [];
        $form_action = route("admin." . $controllerName . ".store");
    }else{
        $form_action = route("admin." . $controllerName . ".update", ["id" => $singleRecord["id"]]);
    }
@endphp

@extends("admin.layout")
@section('content_main')
    <div class="row">
        <div class="col-lg-12">
            <div class="box box-dark">
                <form action="{{ $form_action }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        @include("admin.template.error")
                        <div class="content-tab">
                            <!------- Tab navigate ------->
                            @php
                                $keyActive = "general_tab";
                                //dd(config("permission"));
                            @endphp
                            <ul class="nav nav-tabs" role="tablist">
                                @foreach($fieldForm as $index => $tabs)
                                    <li class="nav-item">
                                        <a class="nav-link @if($index == $keyActive) active @endif" data-toggle="tab"
                                           href="#{{ $index }}" role="tab">{{ $tabs["tab_label"] }}</a>
                                    </li>
                                @endforeach
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab"
                                       href="#permission_tab" role="tab">Permissions</a>
                                </li>
                            </ul>
                            <!------- End Tab ------->

                            <!------- Tab Content ------->
                            <div class="tab-content">
                                @foreach($fieldForm as $index => $items)
                                    <div class="tab-pane @if($index == $keyActive) active @endif"
                                         id="{{ $index }}" role="tabpanel">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                {!! App\Helper\Form::renderItems($items['items'], @$singleRecord) !!}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @php
                                    $permissions = config("permission");
                                    //dd($singleRecord);
                                    if(!empty($singleRecord))
                                    {
                                        //json_decode($objec, true) => array (json_decode giải mã đoạn json thành array)
                                        $decodePermissions = json_decode($singleRecord -> permissions, true);
                                    }
                                @endphp
                                <div class="tab-pane"
                                     id="permission_tab" role="tabpanel">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                @foreach($permissions as $model => $actions)
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-6 role-permissions">
                                                        <div>
                                                            <div class="check-all-wrapper bg-success d-flex justify-content-between align-items-center">
                                                                <h4 class="model-title"> {{ $model }} </h4>
                                                                <div class="form-group pure-checkbox mb-0">
                                                                    <input type="checkbox" id="checkall-{{ $model }}" class="checkbox-all">
                                                                    <label for="checkall-{{ $model }}" class="mb-0">Check All</label>
                                                                </div>
                                                            </div>
                                                            @foreach($actions as $key => $action)
                                                                @php
                                                                    $strAction = $model . "." . $key;
                                                                @endphp
                                                                <div class="form-group pure-checkbox pt-2">
                                                                    <input class="uncheck-permission"
                                                                           type="hidden"
                                                                           name="permissions[{{$model}}][{{$key}}]"
                                                                           value="off">
                                                                    <input class="checkbox-permission"
                                                                           type="checkbox"
                                                                           name="permissions[{{$model}}][{{$key}}]"
                                                                           id="{{ $action }}"
                                                                           value="on"
                                                                           {{ @$decodePermissions[$strAction] == true ? "checked" : "" }}>
                                                                    <label for="{{ $action }}">{{ $action }}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!------- End Tab Content ------->
                        </div>
                        <button type="submit" class="btn btn-success">Save</button>
                        <a class="btn btn-dark" href="{{ route("admin." . $controllerName . ".index") }}">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
<style>
    .model-title {
        text-transform: capitalize;
        font-weight: bold;
        font-size: 20px;
    }
    .check-all-wrapper{
        color: white;
        padding: 8px 15px;
        border-radius: 15px;
    }
</style>

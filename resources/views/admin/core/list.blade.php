
<div class="table-content">
    <table class="table mb-0">
        <thead class="thead-dark">
            <tr>
                @foreach($fieldList as $key => $value)
                    <th scope="col" class="col-label">{{ $value["label"] }}</th>
                @endforeach
                @canany([$controllerName . ".delete", $controllerName . ".edit"])
                    <th scope="col" class="col-label">Hành động</th>
                @endcanany()
            </tr>
        </thead>
        <tbody class="tbody">
            @if($data->count() > 0)
                @foreach($data as $record)
                    <tr>
                        @foreach($fieldList as $key => $name)
                            @switch($name["type"])
                                @case("id")
                                <th scope="row">{{ $record -> {$name["name"]} }}</th>
                                @break
                                @case("text")
                                <td>{{ $record -> {$name["name"]} }}</td>
                                @break
                                @case("first_name")
                                <td>{{ $record -> {$name["name"]} }}</td>
                                @break
                                @case("last_name")
                                <td>{{ $record -> {$name["name"]} }}</td>
                                @break
                                @case("status")
                                @if( $record -> {$name["name"]} == "active")
                                    <td>
                                        <label class="label label-success">{{ $record -> {$name["name"]} }}</label>
                                    </td>
                                @else
                                    <td>
                                        <label class="label label-danger">{{ $record -> {$name["name"]} }}</label>
                                    </td>
                                @endif
                                @break
                                @case("role")
                                @php
                                    $roleName = $record -> roles -> pluck('name') -> toArray();
                                @endphp
                                <td>
                                    @foreach($roleName as $value)
                                        <label class="label label-success">{{ $value }}</label>
                                    @endforeach
                                </td>
                                @break
                                @case("picture")
                                <td class="show-image">
                                    <img src="{{ \App\Helper\Functions::getImage($folderUpload, $record -> {$name["name"]}) }}">
                                </td>
                                @break
                                @case("dateFormat")
                                <td>{{ $record -> {$name["name"]} -> format('d/m/Y') }}</td>
                                @break
                            @endswitch
                        @endforeach
                        @canany([$controllerName . ".delete", $controllerName . ".edit"])
                            <td>@include("admin.template.action")</td>
                        @endcanany
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="{{count($fieldList) + 1}}">Không có dữ liệu</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

<style>
    .table-content{
        padding: 15px 0;
    }
    .col-label{
        text-transform: capitalize;
    }
    th,td{
        text-align: center;
    }
</style>

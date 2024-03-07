<div class="form-group">
    <label>{{ $item['label'] }}</label>
    <input multiple name="{{ $item['name'] }}[]" type="file" class="form-control gallery_picture" id="{{ $item['name'] }}">
    <div class="preview_gallery_picture">
        @if(!empty($old_record) && is_object($old_record))
            @php
                $multipleImage = json_decode($old_record[$item['name']]);
            @endphp
            @if($multipleImage != null)
                @foreach($multipleImage as $src)
                    <img class="image_preview"
                         src="{{ \App\Helper\Functions::getImage($folderUpload, $src)}}"
                         width="300" alt="">
                @endforeach
            @endif
        @endif
    </div>
</div>

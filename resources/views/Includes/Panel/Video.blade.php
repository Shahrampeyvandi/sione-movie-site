@isset($post)
@if (count($post->videos))
@foreach ($post->videos as $video)
<div class="row upload-season-file mx-2 mb-2 pb-2" style="position: relative;padding-top:35px">
    <a href="" onclick="deleteVideo(event,'{{$video->id}}')" class="text-danger" style="position: absolute;
    left: 13px;
    top: 0;">حذف ویدیو</a>
    <div class="form-group col-md-9">
        <label for=""> فایل: </label>
        <input required type="text" name="file[1][1]" id="video-url" class="form-control" value="{{$video->url}}" />
    </div>
    <div class="col-md-3 form-group">
        <label for=""> کیفیت: </label>
        <select name="file[1][2]" id="" class=" custom-select  ">
            <option value="360" {{$video->quality->name == '360' ? 'selected' : ''}}>360</option>
            <option value="480" {{$video->quality->name == '480' ? 'selected' : ''}}>480</option>
            <option value="576" {{$video->quality->name == '576' ? 'selected' : ''}}>576</option>
            <option value="720" {{$video->quality->name == '720' ? 'selected' : ''}}>720</option>
            <option value="1028" {{$video->quality->name == '1028' ? 'selected' : ''}}>1028</option>
        </select>
    </div>
    @foreach ($video->captions as $caption)
    <span>{{$caption->lang}}</span>
    @endforeach

    <div class="col-md-12 row">
        <label for="" class="col-md-2">زیرنویس</label>
        <div class="col-md-3 ">
            <select name="file[1][3][][1]" id="" class="custom-select">
                <option value="زیرنویس فارسی">زیرنویس فارسی</option>
                <option value="زیرنویس انگلیسی">زیرنویس انگلیسی</option>
            </select>
        </div>
        <div class="col-md-3">
            <input type="file"  name="file[1][3][][2]" id="" class="form-control" />
        </div>
    </div>
    <a href="#" onclick="addCaption(event)" class="pr-3">افزودن زیرنویس </a>
</div>
<div class="row mx-2 clone">
    <div class="col-md-12">
        <a href="#" onclick="cloneFile(event)"><i class="fas fa-plus"></i></a>
    </div>
</div>
@endforeach
@else  
<div class="row upload-season-file mx-2 mb-2 pb-2">
    <div class="form-group col-md-9">
        <label for=""> فایل: </label>
        <input required type="text" name="file[1][1]" id="" class="form-control" />
    </div>
    <div class="col-md-3 form-group">
        <label for=""> کیفیت: </label>
        <select name="file[1][2]" id="" class=" custom-select  ">
            <option value="360">360</option>
            <option value="480">480</option>
            <option value="576">576</option>
            <option value="720">720</option>
            <option value="1028">1028</option>

        </select>
    </div>

    <div class="col-md-12 row">
        <label for="" class="col-md-2">زیرنویس</label>
        <div class="col-md-3 ">
            <select name="file[1][3][][1]" id="" class="custom-select">
                <option value="زیرنویس فارسی">زیرنویس فارسی</option>
                <option value="زیرنویس انگلیسی">زیرنویس انگلیسی</option>
            </select>
        </div>
        <div class="col-md-3">
            <input type="file"  name="file[1][3][][2]" id="" class="form-control" />
        </div>
    </div>
    <a href="#" onclick="addCaption(event)">افزودن زیرنویس </a>
</div>
<div class="row mx-2 clone">
    <div class="col-md-12">
        <a href="#" onclick="cloneFile(event)"><i class="fas fa-plus"></i></a>
    </div>
</div>

@endif

@else
<div class="row upload-season-file mx-2 mb-2 pb-2">
    <div class="form-group col-md-9">
        <label for=""> فایل: </label>
        <input required type="text" name="file[1][1]" id="" class="form-control" />
    </div>
    <div class="col-md-3 form-group">
        <label for=""> کیفیت: </label>
        <select name="file[1][2]" id="" class=" custom-select  ">
            <option value="360">360</option>
            <option value="480">480</option>
            <option value="576">576</option>
            <option value="720">720</option>
            <option value="1028">1028</option>

        </select>
    </div>

    <div class="col-md-12 row">
        <label for="" class="col-md-2">زیرنویس</label>
        <div class="col-md-3 ">
            <select name="file[1][3][][1]" id="" class="custom-select">
                <option value="زیرنویس فارسی">زیرنویس فارسی</option>
                <option value="زیرنویس انگلیسی">زیرنویس انگلیسی</option>
            </select>
        </div>
        <div class="col-md-3">
            <input type="file"  name="file[1][3][][2]" id="" class="form-control" />
        </div>
    </div>
    <a href="#" onclick="addCaption(event)">افزودن زیرنویس </a>
</div>
<div class="row mx-2 clone">
    <div class="col-md-12">
        <a href="#" onclick="cloneFile(event)"><i class="fas fa-plus"></i></a>
    </div>
</div>

@endisset
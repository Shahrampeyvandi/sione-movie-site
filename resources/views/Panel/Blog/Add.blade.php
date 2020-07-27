@extends('Layout.Panel')

@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h5 class="text-center">افزودن </h5>
                <hr />
            </div>
            <form id="add-blog" method="post" @isset($blog) action="{{route('Panel.EditBlog',$blog)}}" @else
                action="{{route('Panel.AddBlog')}}" @endisset enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input required type="text" class="form-control" name="name" id="name"
                                    value="{{$blog->title ?? ''}}" placeholder="عنوان وبلاگ">
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">

                                <h6 class="">دسته بندی : </h6>
                                <input type="text" class="form-control mb-2" name="" id="" placeholder="جدید">
                                <a href="#" class="btn btn-sm btn-primary mb-3" onclick="addBCategory(event)">افزودن</a>
                                <div class="cat-wrapper">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="catb" name="category" value="اخبار"
                                            class="custom-control-input" @if(!isset($blog)) checked @endif>
                                        <label class="custom-control-label" for="catb">اخبار</label>
                                    </div>
                                    @foreach (\App\BlogCategory::all() as $key => $cat)
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="blogc-{{$key+1}}" name="category" value="{{$cat->name}}"
                                            class="custom-control-input" @isset($blog)
                                            {{$blog->categories()->pluck('id')->contains($cat->id) ? 'checked' : ''}}
                                            @endisset>
                                        <label class="custom-control-label"
                                            for="blogc-{{$key+1}}">{{$cat->name}}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>

                        <div class="row mt-3">
                            <div class="form-group col-md-12">

                                <div class="form-row">
                                    <div class="col-md-3">
                                        <label for=""> پوستر فیلم: </label>
                                    </div>
                                    <div class="col-md-9">
                                        <img alt="" id="preview" width="100%" style="max-height: 400px" src="@isset($blog)
                                             {{asset($blog->poster)}} 
                                                @else
                                                 {{asset('assets/images/640x360.png')}} 
                                            @endisset">
                                        <input type="file" name="poster" id="poster" />

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="desc">توضیحات : در صورت نیاز میتوانید به حالت دراگ دراپ تصویر اضافه
                                    نمایید</label>
                                <textarea class="form-control" name="desc" id="desc" cols="30" rows="8">

                                    {{$blog->description ?? ''}}
                                </textarea>
                            </div>
                        </div>
                        <label for="">منابع: </label>
                        @if(isset($blog) && count($blog->links))
                        @foreach ($blog->links as $link)
                        <div class=" row">
                            <div class="col-md-6 ">
                                <input  type="text" class="form-control" name="link_name[]" id="link_name"
                            value="{{$link->name}}" placeholder="نام منبع">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="link_url[]" id="link_url" 
                                value="{{$link->url}}"
                                    placeholder="آدرس">
                            </div>
                        </div>
                        @endforeach

                        @else
                        <div class=" row">
                            <div class="col-md-6 ">
                                <input  type="text" class="form-control" name="link_name[]" id="link_name"
                                    value="" placeholder="نام منبع">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="link_url[]" id="link_url" value=""
                                    placeholder="آدرس">
                            </div>
                        </div>
                        @endif

                        <a href="#" onclick="addBlogLink(event)" class="pr-3">افزودن </a>
                    </div>

                </div>
                <div class="row mt-3">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">
                            @isset($blog)
                            ویرایش
                            @else    
                            ثبت
                            @endisset
                            اطلاعات </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('assets/vendors/ckeditor/ckeditor.js')}}"></script>
<script>
    CKEDITOR.replace('desc',{
            contentsLangDirection: 'rtl',
            filebrowserUploadUrl: '{{route('UploadImage')}}?type=file',
            imageUploadUrl: '{{route('UploadImage')}}?type=image',
        });


</script>
@endsection
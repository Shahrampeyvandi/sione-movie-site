@extends('Layout.Panel')

@section('content')

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">اخطار</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                موارد علامت زده شده حذف شوند؟
            </div>
            <div class="modal-footer">
                <form action="" method="post">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="video_id" id="video_id" value="">
                    <a href="#" class="deleteposts btn btn-danger text-white">حذف! </a>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="container_icon card-body d-flex justify-content-end">
        <div class="delete-edit" style="display:none;">
            <a href="#" title="حذف " data-toggle="modal" data-target="#exampleModal" class="order-delete   m-2">
                <span class="__icon bg-danger">
                    <i class="fa fa-trash"></i>
                </span>
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="card-title">
            <h5 class="text-center">مدیریت وبلاگ ها</h5>
            <hr>
        </div>
        <table id="example1" class="table table-striped table-bordered w-100">
            <thead>
                <tr>
                    <th></th>
                    <th>ردیف</th>
                    <th> عنوان </th>
                    <th>دسته بندی </th>
                    <th>امتیاز</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach($blogs as $key=>$blog)
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox custom-control-inline" style="margin-left: -1rem;">
                            <input data-id="{{$blog->id}}" type="checkbox" id="blog_{{ $key}}"
                                name="customCheckboxInline1" class="custom-control-input" value="1">
                            <label class="custom-control-label" for="blog_{{$key}}"></label>
                        </div>
                    </td>
                    <td>{{$key+1}}</td>
                    <td>
                        <a href="#" class="text-primary">{{$blog->title}}</a>
                    </td>
               

                    <td>
                        @foreach ($blog->categories as $category)
                        {{$category->name}}
                        @endforeach
                    </td>
                    <td>
                        6.1 از 10
                    </td>
                    <td>
                        <a href="{{route('Panel.EditBlog',$blog)}}" class="btn btn-sm btn-info">ویرایش</a>
                    </td>
                    @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
@section('css')

@endsection

@section('js')
<script>
    $('table input[type="checkbox"]').change(function(){
            if( $(this).is(':checked')){
            $(this).parents('tr').css('background-color','#41f5e07d');
            }else{
                $(this).parents('tr').css('background-color','');

            }
            array=[]
            $('table input[type="checkbox"]').each(function(){
                if($(this).is(':checked')){
                array.push($(this).attr('data-id'))

               }
               if(array.length !== 0){
                $('.delete-edit').show()
                if (array.length !== 1) {
                    $('.container_icon').removeClass('justify-content-end')
                    $('.container_icon').addClass('justify-content-between')
                    $('.edit-personal').hide()
                }else{

                    $('.container_icon').removeClass('justify-content-end')
                    $('.container_icon').addClass('justify-content-between')
                    $('.edit-personal').show()
                    
                   
                }
            }
            else{
                $('.container_icon').removeClass('justify-content-between')
                $('.container_icon').addClass('justify-content-end')
                $('.delete-edit').hide()
            }
        })
            
    })
    
       


     $('.deleteposts').click(function(e){
            e.preventDefault()
            data = { array:array, _method: 'delete',_token: "{{ csrf_token() }}" };
            url='{{route('Panel.DeleteBlog')}}';
            request = $.post(url, data);
            request.done(function(res){
            location.reload()
        });
    })
</script>

@endsection
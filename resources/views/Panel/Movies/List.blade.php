@extends('Layout.Panel')

@section('content')

@include('Includes.Panel.modals')

@include('Includes.Panel.moviesmenu')




<div class="card">
    <div class="card-body">
        <div class="card-title">
            <h5 class="text-center">مدیریت فایل ها</h5>
            <hr>
        </div>

        <table id="example1" class="table table-striped table-bordered w-100">
            <thead>
                <tr>
                    
                    <th>ردیف</th>
                    <th> نام </th>
                    <th>بازدید ها</th>
                    <th>لایک ها</th>
                    <th>دسته بندی ها</th>
                    <th>زبان</th>
                    <th></th>


                </tr>
            </thead>

            <tbody>
                @foreach($movies as $key=>$post)
                <tr>
                   
                    <td>{{$key+1}}</td>
                    <td>
                        <a href="#" class="text-primary">{{$post->name}}</a>
                    </td>
                    <td>{{$post->views}}</td>
                    <td class="text-success">{{$post->votes()->count()}}</td>
                    <td>
                        @foreach ($post->categories as $category)
                        {{$category->name}} ,
                        @endforeach
                    </td>
                    <td>
                        @foreach ($post->languages as $language)
                        {{$language->name}} -
                        @endforeach
                    </td>
                    <td>
                        <a href="{{route('Panel.EditMovie',$post)}}" class="btn btn-sm btn-info">ویرایش</a>
                        <a href="#" data-id="{{$post->id}}" title="حذف " data-toggle="modal" data-target="#deletePost"
                            class="btn btn-sm btn-danger   m-2">

                            <i class="fa fa-trash"></i>

                        </a>

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
    
         $('#deletePost').on('shown.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var recipient = button.data('id')
            $('#post_id').val(recipient)

    })


    //  $('.deleteposts').click(function(e){
    //         e.preventDefault()

    //         data = { array:array, _method: 'delete',_token: "{{ csrf_token() }}" };
    //         url='{{route('Panel.DeletePost')}}';
    //         request = $.post(url, data);
    //         request.done(function(res){
    //         location.reload()
    //     });
    // })
</script>

@endsection
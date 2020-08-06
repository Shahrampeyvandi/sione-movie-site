
    <a href="{{$model->path()}}" data-id="1" onclick="showDetails(event,'{{$model->id}}','{{route('GetMovieDetail')}}')">
        <div class="movie-sections-box">
            <div class="img-box-movies">
                <img src="{{asset($model->poster)}}" alt="{{$model->name}}">
                <div class="cover-img-movies-details">
                    <span>
                        {{$model->name}} -
                        @if ($model->type == 'series')
                        {{\Morilog\Jalali\Jalalian::forge($model->first_publish_date)->format('%Y')}}
                        @else 
                        {{\Morilog\Jalali\Jalalian::forge($model->released)->format('%Y')}}
                        @endif
                    </span>
                    <span>
                        <i class="fa fa-heart"></i>
                        89%
                    </span>
                </div>
            </div>
            <h5>
                {{$model->title}}
            </h5>
        </div>
    </a>


<div class="card">
    <div class=" card-body ">
   
<ul class="nav nav-pills ">
            <a href="{{route('Panel.SeriesList')}}" class="nav-link 
            @if(\Request::route()->getName() == "Panel.SeriesList") {{'active'}} 
            @endif">لیست</a>
        </li>
        <li class="nav-item">
            <a href="{{route('Panel.AddSerie')}}" class="nav-link
   @if(\Request::route()->getName() == "Panel.AddSerie") {{'active'}} 
   @endif">جدید <i class="fas fa-plus"></i></a>
        </li>
          
</ul>
 </div>
</div>

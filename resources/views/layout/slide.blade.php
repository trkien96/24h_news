<!-- slider -->
<div class="row carousel-holder">
    <div class="col-md-12">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="height: 386px;overflow: hidden">
            <ol class="carousel-indicators">
                @foreach($slide as $sl)
                    <li data-target="#carousel-example-generic" data-slide-to="{{$loop->index}}"
                        @if($loop->index == 0)
                            class="active"
                        @endif
                    ></li>
                @endforeach
            </ol>
            <div class="carousel-inner">
                @foreach($slide as $sl)
                    <div
                        @if($loop->index == 0)
                            class="item active"
                        @else
                            class="item"
                        @endif
                    >
                        <img class="slide-image" src="upload/slide/{{$sl->Hinh}}" alt="{{$sl->NoiDung}}">
                    </div>
                @endforeach
            </div>
            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div>
    </div>
</div>
<!-- end slide -->

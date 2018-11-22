@extends('web.base')
@section('content')
    <section id="container" class="index-page">
        <div class="wrap-container zerogrid">
            <!------------------------------------->
            <div class="row">
                <div class="header">
                    <h2>{{ $title }}</h2>
                </div>
                <div class="row">
                    <div class="col-1-4">
                        <div class="wrap-col">
                            <div class="zoom-container" style="width: 100%; height: 100%;">
                                <a href="http://8179d.com">
									<span class="zoom-caption">
										<i class="icon-play fa fa-play"></i>
									</span>
                                    <img style="width: 320px;height: 146px;"
                                         src="{{ url('/images/ad.gif') }}"/>
                                </a>
                                <div class="bottom-text">
                                    尊龙娱乐
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach($data as $r)
                        <div class="col-1-4">
                            <div class="wrap-col">
                                <div class="zoom-container" style="width: 100%; height: 100%;">
                                    <a href="{{ url('/video/show/'.$r->id) }}">
									<span class="zoom-caption">
										<i class="icon-play fa fa-play"></i>
									</span>
                                        <img class="lazy" style="width: 100%; height: 100%;"
                                             src="{{Storage::disk('pic')->url($r->static_pic)}}"
                                             data-original="{{Storage::disk('video')->url($r->screensnap)}}"
                                        />
                                    </a>
                                    <div class="bottom-text">
                                        {{$r->title}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>


            </div>

        </div>

        @if(\Illuminate\Support\Facades\Route::current()->parameters['type'] !="tag")
            <div class="navigation" style="margin-bottom: 40px">
                <ul>
                    @if($data->currentPage() != 1)
                        <li><a href="{{ $data->url(1) }}"><<</a></li>
                        <li><a href="{{ $data->url($data->currentPage()-1) }}"><</a></li>
                    @endif
                    <li><a href="#">{{$data->currentPage()}}</a></li>
                    @if($data->currentPage() != $data->lastPage())
                        <li><a href="{{ $data->url($data->currentPage()+1) }}">></a></li>
                        <li><a href="{{ $data->url($data->lastPage()) }}">>></a></li>
                    @endif
                </ul>
            </div>
        @endif
    </section>


@endsection

@section('jscode')
    <script src="{{ url('js/lazyload/jquery.lazyload.js') }}"></script>
    <script>
        $(function () {
            $(".zoom-container").each(function () {
                var img = $(this).find('.lazy');
                var src = img.attr('src');
                $(this).bind('mouseover', function () {
                    img.attr('src', img.data('original'));
                })
                $(this).bind('mouseout', function () {
                    img.attr('src', src);
                })
            })
        })
    </script>
@endsection

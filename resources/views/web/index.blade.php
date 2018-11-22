@extends('web.base')
@section('content')
    <section id="container" class="index-page">
        <div class="wrap-container zerogrid">
            <!------------------------------------->
            <div class="row">
                <div class="header">
                    <h2>最新视频<a href="{{ url('/v/new') }}" style="float: right">更多</a></h2>
                </div>
                <div class="row">
                    <div class="most-viewed">
                        <div class="col-2-4">
                            <div class="wrap-col">
                                <div class="zoom-container" style="width: 100%; height: 100%;">
                                    <a href="{{ url('/video/show/'.$last5[0]['id']) }}">
									<span class="zoom-caption">
										<i class="icon-play fa fa-play"></i>
									</span>
                                        <img class="lazy" style="width: 580px;height: 325px"
                                             src="{{Storage::disk('pic')->url($last5[0]['static_pic'])}}"
                                             data-original="{{Storage::disk('video')->url($last5[0]['screensnap'])}}"
                                        />
                                    </a>
                                    <div class="bottom-text">
                                        {{ $last5[0]['title'] }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="extra">
                        <div class="col-1-4">
                            <div class="wrap-col">
                                <div class="zoom-container" style="width: 100%; height: 100%;">
                                    <a href="{{ url('/video/show/'.$last5[1]['id']) }}">
									<span class="zoom-caption">
										<i class="icon-play fa fa-play"></i>
									</span>
                                        <img class="lazy" style="width: 100%; height: 100%;"
                                             src="{{Storage::disk('pic')->url($last5[1]['static_pic'])}}"
                                             data-original="{{Storage::disk('video')->url($last5[1]['screensnap'])}}"
                                        />
                                    </a>
                                    <div class="bottom-text">
                                        {{ $last5[1]['title'] }}
                                    </div>
                                </div>
                                <div class="zoom-container" style="width: 100%; height: 100%;">
                                    <a href="{{ url('/video/show/'.$last5[2]['id']) }}">
									<span class="zoom-caption">
										<i class="icon-play fa fa-play"></i>
									</span>
                                        <img class="lazy" style="width: 100%; height: 100%;"
                                             src="{{Storage::disk('pic')->url($last5[2]['static_pic'])}}"
                                             data-original="{{Storage::disk('video')->url($last5[2]['screensnap'])}}"
                                        />
                                    </a>
                                    <div class="bottom-text">
                                        {{ $last5[2]['title'] }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-1-4">
                            <div class="wrap-col">
                                <div class="zoom-container" style="width: 100%; height: 100%;">
                                    <a href="{{ url('/video/show/'.$last5[3]['id']) }}">
									<span class="zoom-caption">
										<i class="icon-play fa fa-play"></i>
									</span>
                                        <img class="lazy" style="width: 100%; height: 100%;"
                                             src="{{Storage::disk('pic')->url($last5[3]['static_pic'])}}"
                                             data-original="{{Storage::disk('video')->url($last5[3]['screensnap'])}}"
                                        />
                                    </a>
                                    <div class="bottom-text">
                                        {{ $last5[3]['title'] }}
                                    </div>
                                </div>
                                <div class="zoom-container" style="width: 100%; height: 100%;">
                                    <a href="{{ url('/video/show/'.$last5[4]['id']) }}">
									<span class="zoom-caption">
										<i class="icon-play fa fa-play"></i>
									</span>
                                        <img class="lazy" style="width: 100%; height: 100%;"
                                             src="{{Storage::disk('pic')->url($last5[4]['static_pic'])}}"
                                             data-original="{{Storage::disk('video')->url($last5[4]['screensnap'])}}"
                                        />
                                    </a>
                                    <div class="bottom-text">
                                        {{ $last5[4]['title'] }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div id="main-content" class="col-2-3">
                    <div class="wrap-content">
                        <section class="vid-tv">

                            <div class="row">
                                <div class="col-1-3">
                                    <div class="wrap-col">
                                        <div class="zoom-container" style="width: 100%; height: 100%;">
                                            <a href="http://8179d.com">
									<span class="zoom-caption">
										<i class="icon-play fa fa-play"></i>
									</span>
                                                <img style="width: 320px;height: 127px;"
                                                     src="{{ url('/images/ad.gif') }}"/>
                                            </a>
                                            <div class="bottom-text">
                                                尊龙娱乐
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @for($i=5;$i<22;$i++)
                                    <div class="col-1-3">
                                        <div class="wrap-col">
                                            <div class="zoom-container" style="width: 100%; height: 100%;">
                                                <a href="{{ url('/video/show/'.$last5[$i]['id']) }}">
									<span class="zoom-caption">
										<i class="icon-play fa fa-play"></i>
									</span>
                                                    <img class="lazy" style="width: 100%; height: 100%;"
                                                         src="{{Storage::disk('pic')->url($last5[$i]['static_pic'])}}"
                                                         data-original="{{Storage::disk('video')->url($last5[$i]['screensnap'])}}"
                                                    />
                                                </a>
                                                <div class="bottom-text">
                                                    {{$last5[$i]['title']}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>

                        </section>

                    </div>
                </div>
                <div id="sidebar" class="col-1-3">
                    <!---- Start Widget ---->
                    <div class="widget wid-news">
                        <div class="wid-header">
                            <h5>最热<a href="{{ url('/v/hot') }}" style="float: right">更多</a></h5>
                        </div>

                        <div class="wid-content">
                            @foreach($popular3 as $p)
                                <div class="row">
                                    <div class="wrap-vid">
                                        <div class="zoom-container" style="width: 100%;height: 100%;">
                                            <a href="{{ url('/video/show/'.$p['id']) }}">
											<span class="zoom-caption">
												<i class="icon-play fa fa-play"></i>
											</span>
                                                <img class="lazy" style="width: 100%; height: 100%;"
                                                     src="{{Storage::disk('pic')->url($p['static_pic'])}}"
                                                     data-original="{{Storage::disk('video')->url($p['screensnap'])}}"
                                                />
                                            </a>
                                        </div>
                                        <h3 class="vid-name">{{$p['title']}}</h3>
                                        <div class="info">
                                            <span><i class="fa fa-heart"></i>{{$p['hits']}}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

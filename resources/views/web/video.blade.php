@extends('web.base')
@section('content')
    <section id="container" class="index-page">
        <div class="wrap-container zerogrid">
            <!------------------------------------->
            <div class="row">
                <div class="header">
                    <h2>{{ $video->title }}</h2>
                </div>
                <div id="main-content" class="col-4-4">
                    <div class="wrap-vid">
                        <script type="text/javascript" src="{{ url('ckplayer/ckplayer.js') }}"></script>
                        <div id="video"></div>
                        <script type="text/javascript">
                            var videoObject = {
                                container: '#video',//“#”代表容器的ID，“.”或“”代表容器的class
                                variable: 'player',//该属性必需设置，值等于下面的new chplayer()的对象
                                flashplayer: false,//如果强制使用flashplayer则设置成true
                                video: '{{ Storage::disk('video')->url($video->filepath) }}',//视频地址
                                adfront: "http://jake.fun/images/videoad.jpg",
                                adfrontlink: "http://www.8179d.com/",
                                adfronttime: "8",
                                logo: '8179d.com',
                                preview: {
                                    file: ["{{ Storage::disk('pic')->url($video->static_pic) }}"],
                                    scale: 1
                                }
                            };
                            var player = new ckplayer(videoObject);
                        </script>
                    </div>

                </div>

            </div>
        </div>
    </section>
@endsection

@section('jscode')

@endsection

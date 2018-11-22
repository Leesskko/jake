@extends('web.base')
@section('content')
    <section id="container" class="index-page">
        <div class="wrap-container zerogrid">
            <!------------------------------------->
            <div class="row">
                <div class="header">
                    <h2>所有分类</h2>
                </div>
                <div class="row"
                     style="    background-color: #fff;padding: 15px 20px;margin-bottom: 15px;border: 1px solid #ddd;">
                    @foreach($tags as $tag)
                        <a style="margin-bottom:10px;display: inline-block;padding: 5px;border-radius: 3px; color: #fff; background-color: blueviolet"
                           href="{{ url('/v/tag?tag_id='.$tag['id']) }}">{{$tag['title']}}
                            ({{$tag['videonum']}})</a>
                    @endforeach
                </div>
            </div>

        </div>
    </section>
@endsection

@section('jscode')

@endsection

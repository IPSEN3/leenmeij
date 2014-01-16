@extends('site.layouts.default')

{{-- Content --}}
@section('content')
<div class="row">
    <div class="col-md-12">
        <ul class="cbp_tmtimeline">
@foreach ($posts as $post)

        <li>
            <time class="cbp_tmtime" datetime="{{{ $post->created_at() }}}"><span>{{{ $post->date() }}}</span> <span>@{{{ $post->author->username }}}</span></time>
            <div class="cbp_tmicon cbp_tmicon-phone"></div>
            <div class="cbp_tmlabel">
                <h4><strong><a href="{{{ $post->url() }}}">{{ String::title($post->title) }}</a></strong></h4>
                <p>{{ String::tidy(Str::limit($post->content, 200)) }}</p>
            </div>
        </li>


@endforeach
        </ul>
    </div>
</div>
{{ $posts->links() }}

@stop

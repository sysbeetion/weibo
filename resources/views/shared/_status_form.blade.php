<form action="{{ route('statuses.store') }}" method="POST">
    @include('shared._errors')
    {{ csrf_field() }}
{{--    下面的内容不能有换行，否则不显示注释--}}
    <textarea class="form-control mt-4" rows="3" placeholder="聊聊新鲜事..." name="content">{{ old('content') }}</textarea>

    <div class="text-right">
        <button type="submit" class="btn btn-primary mt-3">发布</button>
    </div>

</form>

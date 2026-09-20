@extends('User.main')
@section('main-section')
<article class="pt-32 pb-20">
    <div class="max-w-4xl mx-auto px-4">
        <a href="{{ route('blog') }}" class="text-primary font-bold mb-8 inline-block">← Back to Insights</a>
        
        <div class="mb-8">
            <span class="px-3 py-1 bg-primary/10 text-primary rounded text-sm font-bold uppercase">{{ $blog->category }}</span>
            <h1 class="text-4xl md:text-5xl font-bold text-dark mt-4 leading-tight">{{ $blog->title }}</h1>
            <div class="flex items-center mt-6 text-gray-500 text-sm">
                <span class="font-bold text-dark">{{ $blog->author }}</span>
                <span class="mx-2">•</span>
                <span>{{ $blog->created_at->format('M d, Y') }}</span>
                <span class="mx-2">•</span>
                <span>{{ $blog->read_time }}</span>
            </div>
        </div>

        <img src="{{ asset('storage/public/'.$blog->image) }}" class="w-full rounded-3xl mb-12 shadow-xl">

        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
            {!! nl2br(e($blog->content)) !!}
        </div>
    </div>
</article>
@endsection
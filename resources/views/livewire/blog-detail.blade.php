<div class="max-w-2xl mx-auto py-10">
    @if($blog)
        <img src="/{{ $blog['image'] }}" alt="{{ $blog['title'] }}" class="w-full h-64 object-cover rounded mb-6">
        <h1 class="text-3xl font-bold mb-2">{{ $blog['title'] }}</h1>
        <p class="text-neutral-500 mb-6">{{ $blog['desc'] }}</p>
        <div class="prose max-w-none">
            {{ $blog['content'] }}
        </div>
        <div class="mt-8">
            <div class="flex justify-end">
                <a href="/blog">
                    <button type="button" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-blue-500 transition-colors duration-100 rounded-md focus:ring-2 focus:ring-offset-2 focus:ring-blue-100 bg-blue-50 hover:text-blue-600 hover:bg-blue-100">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-4 mr-2">
                            <path fill-rule="evenodd" d="M18 10a.75.75 0 0 1-.75.75H4.66l2.1 1.95a.75.75 0 1 1-1.02 1.1l-3.5-3.25a.75.75 0 0 1 0-1.1l3.5-3.25a.75.75 0 1 1 1.02 1.1l-2.1 1.95h12.59A.75.75 0 0 1 18 10Z" clip-rule="evenodd" />
                        </svg>
                        Kembali ke blog
                    </button>
                </a>
            </div>
        </div>
    @else
        <div class="text-center py-20">
            <h2 class="text-2xl font-bold mb-4">Blog tidak ditemukan</h2>
            <a href="/blog" class="text-blue-600 underline">Kembali ke Blog</a>
        </div>
    @endif
</div>

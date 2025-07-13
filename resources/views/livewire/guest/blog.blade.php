<div class="container mx-auto py-10">
    <div class="grid grid-cols-1 md:grid-cols-5 gap-6 justify-start">
        @foreach($blogs as $blog)
            <x-feature-card
                :src="$blog['image']"
                fallback="images/default-no-image.png"
                :alt="$blog['title']"
                :title="$blog['title']"
                :desc="$blog['desc']"
                :button-label="'Baca selengkapnya'"
                :button-link="url('/blog/' . $blog['slug'])"
            />
        @endforeach
    </div>
</div>

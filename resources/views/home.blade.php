<x-app-layout>
    <div class="w-full">
        <x-carousel :images="[
            'https://flowbite.s3.amazonaws.com/docs/gallery/square/image-1.jpg',
            'https://flowbite.s3.amazonaws.com/docs/gallery/square/image-2.jpg',
            'https://flowbite.s3.amazonaws.com/docs/gallery/square/image-3.jpg',
            'https://flowbite.s3.amazonaws.com/docs/gallery/square/image-4.jpg',
            'https://flowbite.s3.amazonaws.com/docs/gallery/square/image-5.jpg',
            'https://flowbite.s3.amazonaws.com/docs/gallery/square/image-6.jpg',
        ]" />
    </div>
    @livewire('features')
    @livewire('about-home')
    @livewire('facilities')
    @livewire('testimonials')
    @livewire('customers')
</x-app-layout>
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-8">
                <div class="py-6">
                    <h1 class="text-4xl font-bold text-blue-600 mb-4">
                        ELEVATING
                        <br>
                        <span class="text-gray-800">YOUR DIGITAL</span>
                        <br>
                        <span class="text-gray-800">BUSINESS WITHIN</span>
                        <br>
                        <span class="text-blue-600">A MINUTE.</span>
                    </h1>
                    <p class="text-gray-600 text-lg mb-6">
                        Deskripsi singkat.
                    </p>
                    <div class="flex items-center">
                        <x-button primary rounded icon="arrow-right" label="Start to learn more about us" />
                    </div>
                </div>
                <div class="hidden md:block">
                    <x-image-with-fallback src="images/meeting.jpg" fallback="images/default-no-image.png"
                        alt="Meeting Illustration" class="rounded-lg shadow-md" />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
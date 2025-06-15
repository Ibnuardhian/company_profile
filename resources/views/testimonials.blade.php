<!-- Section Testimoni Card 2 Horizontal -->
<div x-data="{ visible: false }" x-intersect:enter="visible = true" x-intersect:leave="visible = false" :class="{'opacity-0 translate-y-8': !visible, 'opacity-100 translate-y-0': visible}" class="bg-white min-h-[30vh] py-10 transition-all duration-[1500ms] opacity-0 translate-y-8">
    <div class="text-center text-3xl font-bold mb-8 bg-white">TESTIMONI</div>
    <div class="flex flex-col items-center">
        <div class="relative flex w-full max-w-4xl justify-center mb-4">
            <!-- Left Chevron Button -->
            <button id="prev-btn" class="absolute left-0 -translate-x-full top-1/2 -translate-y-1/2 bg-gray-200 hover:bg-gray-300 rounded-full p-3 shadow flex items-center justify-center mr-12" aria-label="Sebelumnya">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </button>
            <!-- Testimonial Cards (max 2 at a time) -->
            <div id="testimonial-card-1" class="w-1/2 mx-2"></div>
            <div id="testimonial-card-2" class="w-1/2 mx-2"></div>
            <!-- Right Chevron Button -->
            <button id="next-btn" class="absolute right-0 translate-x-full top-1/2 -translate-y-1/2 bg-gray-200 hover:bg-gray-300 rounded-full p-3 shadow flex items-center justify-center ml-12" aria-label="Berikutnya">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </button>
        </div>
    </div>
    <style>
        .popup-transition {
            animation: popupScaleFade 0.5s cubic-bezier(0.4,0,0.2,1);
        }
        @keyframes popupScaleFade {
            0% {
                opacity: 0;
                transform: scale(0.8);
            }
            60% {
                opacity: 1;
                transform: scale(1.05);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }
        /* Jarak proporsional antara button dan card */
        #prev-btn { margin-right: 2rem; }
        #next-btn { margin-left: 2rem; }
        @media (max-width: 900px) {
            #prev-btn, #next-btn { margin: 0 0.5rem; }
        }
        /* Card height and text ellipsis */
        .testimonial-card-custom {
            min-height: 220px;
            max-height: 220px;
            display: flex;
            flex-direction: column;
        }
        .testimonial-isi {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            min-height: 72px;
            max-height: 96px;
        }
    </style>
    <script>
        // Data testimoni (bisa diambil dari backend, di sini hardcode dulu)
        const testimonials = [
            {
                nama: 'Mohamed Fadhlan Sukaji',
                jenis: 'Jenis kendaraan',
                foto: '/images/foto-fadhlan.jpg',
                isi: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.',
                bintang: 5
            },
            {
                nama: 'NAMA PELANGGAN2',
                jenis: 'Jenis kendaraan',
                foto: '/images/foto-fadhlan.jpg',
                isi: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.',
                bintang: 5
            },
            {
                nama: 'NAMA PELANGGAN3',
                jenis: 'Jenis kendaraan',
                foto: '/images/foto-fadhlan.jpg',
                isi: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.',
                bintang: 5
            },
            {
                nama: 'NAMA PELANGGAN4',
                jenis: 'Jenis kendaraan',
                foto: '/images/foto-fadhlan.jpg',
                isi: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.',
                bintang: 5
            },
            {
                nama: 'NAMA PELANGGAN5',
                jenis: 'Jenis kendaraan',
                foto: '/images/foto-fadhlan.jpg',
                isi: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.',
                bintang: 5
            },
            {
                nama: 'NAMA PELANGGAN6',
                jenis: 'Jenis kendaraan',
                foto: '/images/foto-fadhlan.jpg',
                isi: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.',
                bintang: 5
            },
        ];
        let currentIndex = 0;
        function renderCards(withTransition = true) {
            const card1 = testimonials[currentIndex];
            const card2 = testimonials[(currentIndex + 1) % testimonials.length];
            const card1El = document.getElementById('testimonial-card-1');
            const card2El = document.getElementById('testimonial-card-2');
            card1El.innerHTML = card1 ? getCardHtml(card1) : '';
            card2El.innerHTML = card2 ? getCardHtml(card2) : '';
            if (withTransition) {
                card1El.classList.remove('popup-transition');
                card2El.classList.remove('popup-transition');
                // Trigger reflow for restart animation
                void card1El.offsetWidth;
                void card2El.offsetWidth;
                card1El.classList.add('popup-transition');
                card2El.classList.add('popup-transition');
            }
        }
        function getCardHtml(card) {
            return `
                <div class="testimonial-card-custom bg-gray-100 rounded-xl w-full p-6 flex flex-col gap-2 items-start shadow-md">
                    <div class="flex items-center gap-3 w-full">
                        <img src="${card.foto}" alt="Foto Pelanggan" class="w-10 h-10 rounded-full object-cover border-2 border-gray-400 bg-white" onerror="this.onerror=null;this.src='/images/default-no-image.png';" />
                        <div>
                            <div class="font-bold">${card.nama}</div>
                            <div class="italic text-base">${card.jenis}</div>
                        </div>
                    </div>
                    <div class="testimonial-isi mt-2 text-base leading-relaxed max-w-[290px] break-words">
                        ${card.isi}
                    </div>
                    <div class="flex w-full justify-end items-end mt-auto">
                        <div class="text-xl text-gray-800">
                            ${'☆ '.repeat(card.bintang).trim()}
                        </div>
                    </div>
                </div>
            `;
        }
        document.getElementById('next-btn').onclick = function() {
            currentIndex = (currentIndex + 2) % testimonials.length;
            renderCards();
        };
        document.getElementById('prev-btn').onclick = function() {
            currentIndex = (currentIndex - 2 + testimonials.length) % testimonials.length;
            renderCards();
        };
        // Auto next every 5 seconds
        setInterval(() => {
            currentIndex = (currentIndex + 2) % testimonials.length;
            renderCards();
        }, 5000);
        // Inisialisasi pertama
        renderCards(false);
    </script>
</div>
<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $layananUmum = FaqCategory::where('name', 'layanan umum')->first();
        $hargaPembayaran = FaqCategory::where('name', 'harga & pembayaran')->first();
        $pemesanan = FaqCategory::where('name', 'pemesanan & booking')->first();
        $kebijakan = FaqCategory::where('name', 'kebijakan perusahaan')->first();
        $teknis = FaqCategory::where('name', 'teknis & operasional')->first();

        $faqs = [
            // Layanan Umum
            [
                'faq_category_id' => $layananUmum->id,
                'question' => 'Apa saja layanan yang disediakan perusahaan?',
                'answer' => 'Kami menyediakan berbagai layanan transportasi dan logistik yang meliputi: jasa angkutan barang, rental kendaraan, dan layanan logistik terintegrasi. Semua layanan kami dirancang untuk memenuhi kebutuhan bisnis dan personal Anda.',
                'status' => 'active',
                'sort_order' => 1,
            ],
            [
                'faq_category_id' => $layananUmum->id,
                'question' => 'Apakah layanan tersedia 24 jam?',
                'answer' => 'Kami melayani pemesanan dan konsultasi dari Senin hingga Sabtu, pukul 08:00 - 17:00 WIB. Untuk layanan darurat atau khusus, silakan hubungi nomor emergency kami yang tersedia 24 jam.',
                'status' => 'active',
                'sort_order' => 2,
            ],
            [
                'faq_category_id' => $layananUmum->id,
                'question' => 'Bagaimana cara menghubungi customer service?',
                'answer' => 'Anda dapat menghubungi customer service kami melalui:<br>- Telepon: (021) 123-4567<br>- WhatsApp: +62 812-3456-7890<br>- Email: info@perusahaan.com<br>- Live chat di website<br>- Datang langsung ke kantor kami',
                'status' => 'active',
                'sort_order' => 3,
            ],

            // Harga & Pembayaran
            [
                'faq_category_id' => $hargaPembayaran->id,
                'question' => 'Bagaimana sistem perhitungan tarif?',
                'answer' => 'Tarif dihitung berdasarkan beberapa faktor: jarak tempuh, jenis kendaraan, berat dan volume barang, serta waktu penggunaan. Kami memberikan estimasi biaya yang transparan sebelum transaksi dimulai.',
                'status' => 'active',
                'sort_order' => 1,
            ],
            [
                'faq_category_id' => $hargaPembayaran->id,
                'question' => 'Metode pembayaran apa saja yang diterima?',
                'answer' => 'Kami menerima berbagai metode pembayaran:<br>- Transfer bank (BCA, BNI, BRI, Mandiri)<br>- Pembayaran tunai<br>- E-wallet (GoPay, OVO, Dana, ShopeePay)<br>- Kartu kredit/debit<br>- Sistem credit untuk pelanggan korporat',
                'status' => 'active',
                'sort_order' => 2,
            ],
            [
                'faq_category_id' => $hargaPembayaran->id,
                'question' => 'Apakah ada diskon untuk pelanggan tetap?',
                'answer' => 'Ya, kami memberikan program loyalty dan diskon khusus untuk pelanggan tetap. Semakin sering menggunakan layanan kami, semakin besar diskon yang akan Anda dapatkan. Hubungi sales kami untuk informasi lebih detail.',
                'status' => 'active',
                'sort_order' => 3,
            ],

            // Pemesanan & Booking
            [
                'faq_category_id' => $pemesanan->id,
                'question' => 'Berapa lama sebelumnya harus melakukan pemesanan?',
                'answer' => 'Untuk layanan reguler, minimal 2 jam sebelum waktu penggunaan. Untuk layanan khusus atau armada besar, disarankan minimal 1 hari sebelumnya. Pemesanan mendadak juga bisa dilayani tergantung ketersediaan armada.',
                'status' => 'active',
                'sort_order' => 1,
            ],
            [
                'faq_category_id' => $pemesanan->id,
                'question' => 'Bagaimana cara melakukan pemesanan online?',
                'answer' => 'Pemesanan online dapat dilakukan melalui:<br>1. Website resmi kami<br>2. Aplikasi mobile (download di Play Store/App Store)<br>3. WhatsApp Business<br>4. Telepon ke call center<br><br>Cukup isi formulir pemesanan, pilih layanan yang diinginkan, dan konfirmasi pembayaran.',
                'status' => 'active',
                'sort_order' => 2,
            ],
            [
                'faq_category_id' => $pemesanan->id,
                'question' => 'Apakah bisa membatalkan atau mengubah pesanan?',
                'answer' => 'Pembatalan atau perubahan pesanan dapat dilakukan maksimal 1 jam sebelum waktu keberangkatan. Untuk pembatalan, akan dikenakan biaya administrasi sebesar 10% dari total biaya. Perubahan jadwal tidak dikenakan biaya tambahan.',
                'status' => 'active',
                'sort_order' => 3,
            ],

            // Kebijakan Perusahaan
            [
                'faq_category_id' => $kebijakan->id,
                'question' => 'Apakah ada jaminan asuransi untuk barang?',
                'answer' => 'Ya, seluruh barang yang kami angkut dilindungi asuransi. Nilai pertanggungan disesuaikan dengan nilai barang yang dinyatakan saat pemesanan. Klaim asuransi dapat diproses maksimal 3x24 jam setelah laporan kerusakan.',
                'status' => 'active',
                'sort_order' => 1,
            ],
            [
                'faq_category_id' => $kebijakan->id,
                'question' => 'Bagaimana kebijakan terkait barang terlarang?',
                'answer' => 'Kami tidak melayani pengiriman barang-barang terlarang seperti: narkoba, senjata api, bahan peledak, cairan mudah terbakar, dan barang ilegal lainnya. Daftar lengkap barang terlarang dapat dilihat di syarat & ketentuan layanan.',
                'status' => 'active',
                'sort_order' => 2,
            ],

            // Teknis & Operasional
            [
                'faq_category_id' => $teknis->id,
                'question' => 'Bagaimana cara tracking pengiriman?',
                'answer' => 'Setiap pengiriman akan mendapat nomor resi yang dapat digunakan untuk tracking real-time melalui website atau aplikasi kami. Anda juga akan mendapat notifikasi WhatsApp untuk update status pengiriman secara otomatis.',
                'status' => 'active',
                'sort_order' => 1,
            ],
            [
                'faq_category_id' => $teknis->id,
                'question' => 'Apa yang harus dilakukan jika terjadi kendala teknis?',
                'answer' => 'Jika mengalami kendala teknis seperti aplikasi error, website tidak bisa diakses, atau masalah pembayaran, segera hubungi technical support kami di:<br>- WhatsApp: +62 812-9999-8888<br>- Email: support@perusahaan.com<br>- Telepon: (021) 999-8888',
                'status' => 'active',
                'sort_order' => 2,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}

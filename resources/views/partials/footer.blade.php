<!-- Footer Khusus - Lund'or Imagine Digital -->
<style>
    /* CSS Khusus untuk Footer */
    .footer-glitch-text {
        position: relative;
        display: inline-block;
        color: white;
    }
    
    /* Efek hover glitch ringan pada judul footer */
    .footer-glitch-text:hover::before {
        content: attr(data-text);
        position: absolute;
        left: -2px;
        text-shadow: 2px 0 #f9005b;
        top: 0;
        color: white;
        background: #05050a;
        overflow: hidden;
        animation: noise-anim-2 0.2s infinite linear alternate-reverse;
    }

    .footer-glitch-text:hover::after {
        content: attr(data-text);
        position: absolute;
        left: 2px;
        text-shadow: -2px 0 #9d00ff;
        top: 0;
        color: white;
        background: #05050a;
        overflow: hidden;
        animation: noise-anim 0.2s infinite linear alternate-reverse;
    }

    @keyframes noise-anim {
        0% { clip-path: inset(29% 0 25% 0); }
        20% { clip-path: inset(54% 0 10% 0); }
        40% { clip-path: inset(18% 0 46% 0); }
        60% { clip-path: inset(89% 0 8% 0); }
        80% { clip-path: inset(1% 0 93% 0); }
        100% { clip-path: inset(33% 0 45% 0); }
    }

    @keyframes noise-anim-2 {
        0% { clip-path: inset(15% 0 81% 0); }
        20% { clip-path: inset(72% 0 14% 0); }
        40% { clip-path: inset(4% 0 71% 0); }
        60% { clip-path: inset(41% 0 35% 0); }
        80% { clip-path: inset(93% 0 5% 0); }
        100% { clip-path: inset(22% 0 58% 0); }
    }

    /* Garis pemisah bercahaya */
    .glow-divider {
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(249, 0, 91, 0.5), rgba(157, 0, 255, 0.5), transparent);
        border: none;
        margin: 2rem 0;
    }

    /* Efek hover pada tautan footer */
    .footer-link {
        position: relative;
        display: inline-block;
        color: #9ca3af; /* text-gray-400 */
        transition: color 0.3s ease;
    }
    
    .footer-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 1px;
        bottom: -2px;
        left: 0;
        background-color: #f9005b;
        transition: width 0.3s ease;
    }

    .footer-link:hover {
        color: #ffffff;
    }

    .footer-link:hover::after {
        width: 100%;
    }
    
    /* Ikon sosial media bercahaya */
    .social-icon-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: white;
        transition: all 0.3s ease;
    }
    
    .social-icon-btn:hover {
        background-color: #f9005b;
        border-color: #f9005b;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(249, 0, 91, 0.4);
    }
</style>

<footer id="main-footer" class="bg-[#05050a] pt-20 pb-10 border-t border-white/10 relative overflow-hidden z-40">
    <!-- Dekorasi Cahaya Latar -->
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-[#f9005b]/10 rounded-full blur-[150px] pointer-events-none -translate-x-1/2 translate-y-1/2"></div>
    <div class="absolute top-0 right-0 w-[400px] h-[400px] bg-[#9d00ff]/10 rounded-full blur-[120px] pointer-events-none translate-x-1/3 -translate-y-1/4"></div>

    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-16">
            
            <!-- Kolom 1: Branding (Lebar 5 kolom di Desktop) -->
            <div class="md:col-span-5 footer-anim-item">
                <img src="{{ asset('assets/images/logo-lundor-white.png') }}" alt="Lund'or Imagine Digital" class="h-10 md:h-14 w-auto mb-6 object-contain">
                <p class="text-gray-400 font-sans text-sm md:text-base leading-relaxed max-w-sm mb-6">
                    Desain standar sudah mati. Kami hadir untuk meretas batasan, meracik kekacauan digital, dan melahirkan mahakarya visual yang menolak untuk diabaikan.
                </p>
            </div>

            <!-- Kolom 2: Layanan (Lebar 3 kolom di Desktop) -->
            <div class="md:col-span-3 footer-anim-item">
                <h4 class="text-white font-bold uppercase tracking-widest mb-6 text-sm flex items-center gap-2">
                    <svg class="w-4 h-4 text-[#9d00ff]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    Eksperimen
                </h4>
                <ul class="flex flex-col gap-4 font-sans text-sm">
                    <li><a href="#" class="footer-link">3D WebGL Dimensions</a></li>
                    <li><a href="#" class="footer-link">Immersive UI/UX</a></li>
                    <li><a href="#" class="footer-link">Kinetic Typography</a></li>
                    <li><a href="#" class="footer-link">Digital Chaos Strategy</a></li>
                </ul>
            </div>

            <!-- Kolom 3: Kontak & Navigasi (Lebar 4 kolom di Desktop) -->
            <div class="md:col-span-4 footer-anim-item">
                <h4 class="text-white font-bold uppercase tracking-widest mb-6 text-sm flex items-center gap-2">
                    <svg class="w-4 h-4 text-[#f9005b]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
                    Koneksi Jaringan
                </h4>
                <ul class="flex flex-col gap-4 font-sans text-sm mb-8">
                    <li class="flex items-start gap-3 text-gray-400">
                        <svg class="w-5 h-5 text-gray-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span>Jakarta Selatan,<br>DKI Jakarta, Indonesia</span>
                    </li>
                    <li class="flex items-center gap-3 text-gray-400">
                        <svg class="w-5 h-5 text-gray-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <a href="mailto:rizkialiakhbar@gmail.com" class="hover:text-white transition-colors">hello@lundor.id</a>
                    </li>
                </ul>

                <!-- Ikon Sosial Media -->
                <div class="flex gap-4">
                    <a href="#" aria-label="Instagram" class="social-icon-btn">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" /></svg>
                    </a>
                    <a href="#" aria-label="LinkedIn" class="social-icon-btn">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" clip-rule="evenodd" /></svg>
                    </a>
                    <a href="#" aria-label="Twitter" class="social-icon-btn">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" /></svg>
                    </a>
                </div>
            </div>
        </div>

        <hr class="glow-divider">

        <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-xs font-mono text-gray-500 footer-anim-item">
            <p>&copy; <span id="copyright-year">2024</span> Lund'or Imagine Digital. Hak Cipta Dilindungi.</p>
            <div class="flex gap-6">
                <a href="#" class="hover:text-white transition-colors">Kebijakan Privasi</a>
                <a href="#" class="hover:text-white transition-colors">Syarat & Ketentuan</a>
            </div>
        </div>
    </div>
</footer>

<!-- Tambahkan script ini ke file JS Anda atau letakkan sebelum tag penutup body -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        // Mengatur tahun secara dinamis
        const currentYear = new Date().getFullYear();
        const copyrightYear = document.getElementById('copyright-year');
        if(copyrightYear) copyrightYear.textContent = currentYear;

        // Jika Anda menggunakan GSAP, Anda dapat mengaktifkan animasi munculnya elemen-elemen footer ini:
        if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
            gsap.fromTo(".footer-anim-item", 
                { 
                    y: 30, 
                    opacity: 0 
                },
                {
                    y: 0,
                    opacity: 1,
                    duration: 0.8,
                    stagger: 0.15,
                    ease: "power3.out",
                    scrollTrigger: {
                        trigger: "#main-footer",
                        start: "top 85%", // Mulai animasi ketika bagian atas footer mencapai 85% dari viewport
                    }
                }
            );
        }
    });
</script>
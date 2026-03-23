document.addEventListener("DOMContentLoaded", () => {
    // Daftarkan ScrollTrigger ke GSAP
    gsap.registerPlugin(ScrollTrigger);

    // --- 1. Custom Cursor Logic ---
    const cursorDot = document.getElementById('cursor-dot');
    const cursorOutline = document.getElementById('cursor-outline');
    const isTouchDevice = (('ontouchstart' in window) || (navigator.maxTouchPoints > 0) || (navigator.msMaxTouchPoints > 0));

    if (!isTouchDevice && cursorDot && cursorOutline) {
        // Matikan interaksi pointer pada cursor agar tidak menyebabkan lag
        cursorDot.style.pointerEvents = "none";
        cursorOutline.style.pointerEvents = "none";
        
        // Setup posisi offset tengah
        gsap.set(cursorDot, { xPercent: -50, yPercent: -50 });
        gsap.set(cursorOutline, { xPercent: -50, yPercent: -50 });

        // Gunakan gsap.quickTo HANYA untuk outline luar (karena butuh animasi smooth/delay)
        const xToOutline = gsap.quickTo(cursorOutline, "x", { duration: 0.15, ease: "power2.out" });
        const yToOutline = gsap.quickTo(cursorOutline, "y", { duration: 0.15, ease: "power2.out" });

        window.addEventListener('mousemove', (e) => {
            // FIX: Titik tengah langsung di-set tanpa delay agar merespons instan dan tidak nyangkut
            gsap.set(cursorDot, { x: e.clientX, y: e.clientY });
            
            // Outline luar menggunakan quickTo untuk efek smooth trailing
            xToOutline(e.clientX);
            yToOutline(e.clientY);
        });

        // Hover effect pada elemen-elemen yang bisa di-klik
        document.querySelectorAll('a, button, .tech-pill, .group, .load-iframe-btn').forEach(el => {
            el.addEventListener('mouseenter', () => document.body.classList.add('cursor-hover'));
            el.addEventListener('mouseleave', () => document.body.classList.remove('cursor-hover'));
        });
    }

    // --- 2. Animasi Hero Reveal ---
    gsap.fromTo(".gsap-reveal span", 
        { y: "100%", opacity: 0 },
        { y: "0%", opacity: 1, duration: 1, stagger: 0.15, ease: "power4.out", delay: 0.2 }
    );
    
    gsap.fromTo(".gsap-reveal p", 
        { y: 30, opacity: 0 },
        { y: 0, opacity: 1, duration: 1, ease: "power3.out", delay: 0.8 }
    );

    // --- 3. Scroll Animations (Philosophy Section) ---
    gsap.utils.toArray(".gsap-fade-up").forEach(elem => {
        gsap.fromTo(elem,
            { y: 50, opacity: 0 },
            { 
                y: 0, 
                opacity: 1, 
                duration: 0.8, 
                ease: "power3.out",
                scrollTrigger: {
                    trigger: elem,
                    start: "top 85%",
                    toggleActions: "play none none reverse"
                }
            }
        );
    });

    // --- 4. Stagger Animation (Work Process Section) ---
    gsap.fromTo(".gsap-process",
        { y: 40, opacity: 0 },
        {
            y: 0,
            opacity: 1,
            duration: 0.6,
            stagger: 0.2,
            ease: "back.out(1.7)",
            scrollTrigger: {
                trigger: ".gsap-process",
                start: "top 80%"
            }
        }
    );

    // --- 5. Script CSS 3D Room Hover Effect ---
    const hRoom = document.querySelector("#h");
    if (hRoom) {
        let baseRoom = (e) => {
            var x = e.pageX / window.innerWidth - 0.5;
            var y = e.pageY / window.innerHeight - 0.5;
            hRoom.style.transform = `
                perspective(90vw)
                rotateX(${ y * 10  + 75}deg)
                rotateZ(${ -x * 25  + 45}deg)
                translateZ(-9vw)
            `;
        }
        document.body.addEventListener("pointermove", baseRoom);
    }

    // --- 6. Live Portfolio Iframe Logic (GLOBAL MODAL FIX) ---
    
    // 1. Buat elemen Fullscreen Modal satu kali di dalam Body (Mencegah Bug Reparenting)
    const previewModal = document.createElement('div');
    previewModal.className = 'fixed inset-0 z-[99999] bg-[#05050a] flex flex-col opacity-0 pointer-events-none transition-opacity duration-500';
    previewModal.innerHTML = `
        <div class="flex items-center justify-between px-6 py-4 bg-[#0a0a14] border-b border-white/10 shadow-lg relative z-20">
            <div class="flex items-center gap-3">
                <span class="w-3 h-3 rounded-full bg-[#f9005b] animate-pulse"></span>
                <span class="text-white font-mono text-sm tracking-widest uppercase" id="modal-title">Live Preview</span>
            </div>
            <button id="close-modal-btn" class="flex items-center gap-2 bg-[#f9005b] text-white px-6 py-2.5 rounded-full font-bold cursor-pointer hover:bg-white hover:text-black transition-all shadow-[0_0_20px_rgba(249,0,91,0.4)]">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                Tutup Preview
            </button>
        </div>
        <div class="relative flex-1 w-full h-full bg-white">
            <!-- Loading Spinner -->
            <div id="modal-loader" class="absolute inset-0 flex flex-col items-center justify-center bg-[#080815] z-10 transition-opacity duration-300">
                <div class="w-12 h-12 border-4 border-white/10 border-t-[#f9005b] rounded-full animate-spin mb-4"></div>
                <p class="text-gray-400 font-mono text-sm tracking-widest animate-pulse">Memuat Website Client...</p>
            </div>
            <!-- Iframe Sebenarnya -->
            <iframe id="modal-iframe" src="about:blank" class="w-full h-full border-none relative z-0"></iframe>
        </div>
    `;
    document.body.appendChild(previewModal);

    // Ambil kontrol elemen di dalam modal
    const modalTitle = previewModal.querySelector('#modal-title');
    const modalLoader = previewModal.querySelector('#modal-loader');
    const modalIframe = previewModal.querySelector('#modal-iframe');
    const closeModalBtn = previewModal.querySelector('#close-modal-btn');

    // Beri efek hover pada kursor custom kita untuk tombol close
    if (!isTouchDevice && cursorOutline) {
        closeModalBtn.addEventListener('mouseenter', () => document.body.classList.add('cursor-hover'));
        closeModalBtn.addEventListener('mouseleave', () => document.body.classList.remove('cursor-hover'));
    }

    // 2. Logika ketika tombol "Live Preview" di Card ditekan
    const loadButtons = document.querySelectorAll('.load-iframe-btn');
    
    loadButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            
            const url = this.getAttribute('data-url');
            const originalText = this.innerHTML;
            
            // Ubah teks dan style tombol menjadi "Memuat..." untuk feedback visual
            this.innerHTML = "Menghubungkan...";
            this.classList.add('loading-pulse');
            this.style.pointerEvents = 'none';

            // Setup Modal
            modalTitle.innerText = url;
            modalLoader.style.opacity = '1';
            modalLoader.style.pointerEvents = 'auto';
            previewModal.classList.remove('opacity-0', 'pointer-events-none');
            document.body.style.overflow = 'hidden'; // Kunci scroll background utama
            
            // Suntikkan URL ke Iframe (Ini yang akan memuat web client Anda)
            modalIframe.src = url;

            // Tunggu sampai iframe selesai dirender oleh browser
            modalIframe.onload = () => {
                // Pastikan ini bukan onload dari about:blank
                if (modalIframe.src !== 'about:blank' && modalIframe.src !== window.location.href) {
                    // Hilangkan spinner loading dengan efek pudar
                    modalLoader.style.opacity = '0';
                    setTimeout(() => modalLoader.style.pointerEvents = 'none', 300);
                    
                    // Kembalikan tombol di background ke keadaan semula
                    this.innerHTML = originalText;
                    this.classList.remove('loading-pulse');
                    this.style.pointerEvents = 'auto';
                }
            };
        });
    });

    // 3. Logika ketika tombol "Tutup Preview" ditekan
    closeModalBtn.addEventListener('click', () => {
        // Sembunyikan Modal
        previewModal.classList.add('opacity-0', 'pointer-events-none');
        document.body.style.overflow = ''; // Buka kembali scroll web utama
        
        // Bersihkan memori Iframe agar browser tidak ngelag
        modalIframe.src = 'about:blank';
        modalTitle.innerText = 'Live Preview';
    });

    // (Opsi Ekstra) Sembunyikan custom cursor milik kita saat masuk ke iframe client
    // Hal ini mencegah cursor merah kita tabrakan dengan cursor di dalam web client
    modalIframe.addEventListener('mouseenter', () => {
        if (cursorOutline) cursorOutline.style.opacity = "0";
        if (cursorDot) cursorDot.style.opacity = "0";
    });
    modalIframe.addEventListener('mouseleave', () => {
        if (cursorOutline) cursorOutline.style.opacity = "1";
        if (cursorDot) cursorDot.style.opacity = "1";
    });
});
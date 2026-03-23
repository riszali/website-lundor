<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Nusantara Creative - Digital Agency')</title>
    
    <!-- Menggunakan Tailwind CSS via CDN untuk kemudahan styling. 
         Untuk production Laravel 12, disarankan menggunakan Vite (npm run dev/build) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* --- GLOBAL CUSTOM SCROLLBAR --- */
        ::-webkit-scrollbar {
            width: 10px;
        }
        ::-webkit-scrollbar-track {
            background: #080815;
        }
        ::-webkit-scrollbar-thumb {
            background: #f9005b;
            border-radius: 5px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #9d00ff;
        }

        /* --- SEMBUNYIKAN KURSOR BAWAAN (HANYA DESKTOP) --- */
        @media (min-width: 769px) {
            * {
                cursor: none !important;
            }
        }

        /* --- SEMBUNYIKAN CUSTOM CURSOR DI HP --- */
        @media (max-width: 768px) {
            #magic-cursor,
            #magic-orb-cursor {
                display: none !important;
            }
        }

        /* --- STYLING KURSOR BOLA PERAMAL / BULAN (MAGIC ORB) --- */
        #magic-orb-cursor {
            position: fixed;
            top: 0;
            left: 0;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            pointer-events: none;
            z-index: 10000;
            
            /* Menjadikan bola sebagai wadah Flexbox untuk mengatur posisi strip putih */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 2px; /* Jarak antar strip */

            background: radial-gradient(circle at 30% 30%, #ffffff 0%, #f9005b 35%, #5a0099 75%, #080815 100%);
            box-shadow: 
                inset -3px -3px 6px rgba(0,0,0,0.7),    
                inset 2px 2px 4px rgba(255,255,255,0.8), 
                0 0 10px rgba(249, 0, 91, 0.6),          
                0 0 20px rgba(157, 0, 255, 0.4);         
            
            transition: width 0.3s ease, height 0.3s ease, background 0.3s ease, box-shadow 0.3s ease, gap 0.3s ease;
            will-change: transform;
            
            animation: orbPulse 4s infinite alternate ease-in-out;
        }

        /* --- STYLING 2 STRIP PUTIH DI TENGAH BOLA --- */
        #magic-orb-cursor::before,
        #magic-orb-cursor::after {
            content: '';
            display: block;
            width: 8px;
            height: 2px;
            background-color: #ffffff;
            border-radius: 10px; /* Membuat ujungnya membulat seperti pil */
            box-shadow: 0 0 3px rgba(255, 255, 255, 0.8); /* Sedikit efek glow putih */
            transition: width 0.3s ease, height 0.3s ease, transform 0.3s ease;
        }

        /* Strip Atas: Geser sedikit ke kiri */
        #magic-orb-cursor::before {
            transform: translateX(-2.5px);
        }

        /* Strip Bawah: Geser sedikit ke kanan */
        #magic-orb-cursor::after {
            transform: translateX(2.5px);
        }

        @keyframes orbPulse {
            0% { filter: hue-rotate(0deg) brightness(1); }
            100% { filter: hue-rotate(25deg) brightness(1.2); }
        }

        /* --- STYLING KURSOR PARTICLES (THREE.JS TOYS) --- */
        #magic-cursor {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: 9998;
            pointer-events: none;
            mix-blend-mode: screen;
        }

        /* --- HOVER STATE (SAAT MENYENTUH TOMBOL/LINK) --- */
        .cursor-hover-state #magic-orb-cursor {
            width: 32px; 
            height: 32px;
            gap: 3px; /* Jarak antar strip merenggang sedikit */
            background: radial-gradient(circle at 30% 30%, #ffffff 0%, #9d00ff 40%, #f9005b 80%, #000000 100%);
            box-shadow: 
                inset -4px -4px 8px rgba(0,0,0,0.7),
                inset 3px 3px 8px rgba(255,255,255,0.9),
                0 0 18px rgba(157, 0, 255, 0.9),
                0 0 35px rgba(249, 0, 91, 0.6);
            animation-duration: 2s;
        }

        /* Ukuran strip putih ikut membesar proporsional saat di-hover */
        .cursor-hover-state #magic-orb-cursor::before,
        .cursor-hover-state #magic-orb-cursor::after {
            width: 13px;
            height: 2.5px;
        }
        .cursor-hover-state #magic-orb-cursor::before {
            transform: translateX(-3.5px);
        }
        .cursor-hover-state #magic-orb-cursor::after {
            transform: translateX(3.5px);
        }
    </style>
</head>
<body class="bg-[#080815] text-gray-100 font-sans antialiased flex flex-col min-h-screen">
    
    <!-- Wadah Kursor Partikel -->
    <div id="magic-cursor"></div>

    <!-- Kursor Bola Peramal / Bulan dengan Ikon Strip -->
    <div id="magic-orb-cursor"></div>

    <!-- Wrapper konten -->
    <div id="app" class="flex flex-col min-h-screen w-full relative z-10">
        
        <!-- Memanggil komponen Navbar yang dipisah -->
        @include('partials.navbar')

        <!-- Konten Utama Halaman -->
        <main class="flex-grow">
            @yield('content')
        </main>

        <!-- Memanggil komponen Footer yang dipisah -->
        @include('partials.footer')

    </div>

    <!-- Script Kursor Animasi -->
    <script type="module">
        import { particlesCursor } from 'https://unpkg.com/threejs-toys@0.0.8/build/threejs-toys.module.cdn.min.js'

        document.addEventListener('DOMContentLoaded', () => {
            // Hentikan inisialisasi kursor di layar HP (lebar <= 768px) untuk menghemat performa
            if (window.innerWidth <= 768) return;

            const magicCursor = document.getElementById('magic-cursor');
            const orbCursor = document.getElementById('magic-orb-cursor');
            
            // 1. SETUP PARTICLES THREE.JS
            const origAddEventListener = magicCursor.addEventListener.bind(magicCursor);
            magicCursor.addEventListener = (type, listener, options) => {
                if (type.includes('pointer') || type.includes('mouse') || type.includes('touch')) {
                    window.addEventListener(type, listener, options);
                } else {
                    origAddEventListener(type, listener, options);
                }
            };
            
            const pc = particlesCursor({
                el: magicCursor, 
                gpgpuSize: 128, 
                colors: [0x00ff00, 0x0000ff], 
                color: 0xff0000,
                
                // --- PERBAIKAN: PARTIKEL DEBU, BUKAN LISTRIK ---
                coordScale: 0.5, // Dikembalikan ke 0.5 agar bentuknya bulat/berkurva halus (tidak tajam seperti listrik)
                noiseIntensity: 0.003, // Cukup untuk menyebarkan partikel ke segala arah dengan lembut
                noiseTimeCoef: 0.0001, 
                
                pointSize: 4, // Ukuran titik sedikit diperhalus
                
                // pointDecay mengontrol seberapa cepat mereka menghilang. 
                // 0.008 adalah batas aman agar langsung pecah jadi debu dan cepat hilang, tanpa membuat buntut panjang (cacing)
                pointDecay: 0.008, 
                
                sleepRadiusX: 120,
                sleepRadiusY: 120,
                sleepTimeCoefX: 0.001,
                sleepTimeCoefY: 0.002
            });

            // 2. SETUP PERGERAKAN BOLA (MAGIC ORB)
            let mouseX = window.innerWidth / 2;
            let mouseY = window.innerHeight / 2;
            let orbX = mouseX;
            let orbY = mouseY;
            let orbScale = 1;

            window.addEventListener('pointermove', (e) => {
                mouseX = e.clientX;
                mouseY = e.clientY;
            });

            function animateCursor() {
                // Menurunkan nilai dari 0.15 menjadi 0.06 agar pergerakan bola 
                // lebih lambat, halus, dan memberikan efek mengambang (floaty)
                orbX += (mouseX - orbX) * 0.06;
                orbY += (mouseY - orbY) * 0.06;
                
                orbCursor.style.transform = `translate3d(${orbX}px, ${orbY}px, 0) translate(-50%, -50%) scale(${orbScale})`;
                
                requestAnimationFrame(animateCursor);
            }
            animateCursor();

            // 3. EFEK INTERAKTIF (HOVER & KLIK)
            const interactiveElements = document.querySelectorAll('a, button, input, textarea, select, .cursor-pointer');
            interactiveElements.forEach(el => {
                el.addEventListener('mouseenter', () => document.body.classList.add('cursor-hover-state'));
                el.addEventListener('mouseleave', () => document.body.classList.remove('cursor-hover-state'));
            });

            document.body.addEventListener('click', () => {
                if(pc && pc.uniforms) {
                    pc.uniforms.uColor.value.set(Math.random() * 0xffffff);
                    pc.uniforms.uCoordScale.value = 0.001 + Math.random() * 2;
                    pc.uniforms.uNoiseIntensity.value = 0.0001 + Math.random() * 0.001;
                    pc.uniforms.uPointSize.value = 1 + Math.random() * 10;
                }
                
                orbScale = 0.6;
                setTimeout(() => { orbScale = 1; }, 150);
            });
        });
    </script>

</body>
</html>
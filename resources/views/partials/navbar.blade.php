<!-- Navbar Top Bar -->
<nav class="fixed top-0 left-0 w-full z-50 transition-all duration-500 bg-[#080815]/60 backdrop-blur-2xl backdrop-saturate-[1.5] border-b border-white/10 shadow-[0_8px_32px_rgba(0,0,0,0.3)]">
    <div class="absolute inset-0 bg-gradient-to-b from-white/5 to-transparent pointer-events-none"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-50">
        <div class="flex justify-end lg:justify-between items-center h-20 relative">
            
            <!-- Logo Agency -->
            <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 lg:static lg:translate-x-0 lg:translate-y-0 flex-shrink-0 z-50">
                <a href="{{ url('/') }}" class="group block relative">
                    <div class="absolute -inset-2 bg-[#f9005b]/20 rounded-full blur-md opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <img class="h-10 md:h-12 w-auto relative z-10 transition-transform duration-500 group-hover:scale-105" 
                         src="{{ asset('assets/images/logo-lundor-white.png') }}" 
                         alt="Lund'or Imagine Digital">
                </a>
            </div>

            <!-- Menu Desktop -->
            <div class="hidden lg:flex space-x-10 items-stretch h-20">
                <!-- Home Link -->
                <a href="{{ url('/') }}" class="h-full flex items-center font-sans text-[11px] font-bold tracking-[0.2em] {{ Request::is('/') ? 'text-[#f9005b]' : 'text-white' }} hover:text-[#f9005b] transition-colors uppercase relative group">
                    <span class="relative h-full flex items-center mr-[-0.2em]">
                        Home
                        <span class="absolute bottom-0 left-1/2 -translate-x-1/2 {{ Request::is('/') ? 'w-full' : 'w-0' }} h-[2px] bg-[#f9005b] group-hover:w-full transition-all duration-300"></span>
                    </span>
                </a>
                
                <!-- Dropdown Services -->
                @php 
                    $isServiceActive = Request::is('web-development') || Request::is('social-media') || Request::is('uiux-design') || Request::is('animation');
                @endphp
                <div class="relative group cursor-pointer flex items-stretch">
                    <a href="{{ url('/#layanan') }}" class="h-full flex items-center font-sans text-[11px] font-bold tracking-[0.2em] {{ $isServiceActive ? 'text-[#f9005b]' : 'text-white' }} group-hover:text-[#f9005b] transition-colors uppercase relative">
                        <span class="relative h-full flex items-center mr-[-0.2em]">
                            Services
                            <span class="absolute bottom-0 left-1/2 -translate-x-1/2 {{ $isServiceActive ? 'w-full' : 'w-0' }} h-[2px] bg-[#f9005b] group-hover:w-full transition-all duration-300"></span>
                        </span>
                        <svg class="ml-1 w-4 h-4 transform group-hover:-rotate-180 transition-transform duration-500 text-gray-400 group-hover:text-[#f9005b]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </a>
                    
                    <div class="absolute left-1/2 -translate-x-1/2 top-full mt-0 w-56 bg-[#080815]/90 backdrop-blur-3xl shadow-[0_20px_50px_rgba(0,0,0,0.5)] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-500 border border-white/10 rounded-2xl overflow-hidden transform translate-y-4 group-hover:translate-y-0">
                        <div class="relative z-10 py-3">
                            <a href="{{ url('/web-development') }}" class="block px-6 py-3 text-[10px] font-bold {{ Request::is('web-development') ? 'text-[#f9005b] bg-[#1a1a2e]' : 'text-gray-300' }} hover:bg-[#1a1a2e] hover:text-[#f9005b] uppercase tracking-[0.2em] transition-all duration-300 hover:pl-8">Web Development</a>
                            <a href="{{ url('/social-media') }}" class="block px-6 py-3 text-[10px] font-bold {{ Request::is('social-media') ? 'text-[#f9005b] bg-[#1a1a2e]' : 'text-gray-300' }} hover:bg-[#1a1a2e] hover:text-[#f9005b] uppercase tracking-[0.2em] transition-all duration-300 hover:pl-8">Social Media</a>
                            <a href="{{ url('/uiux-design') }}" class="block px-6 py-3 text-[10px] font-bold {{ Request::is('uiux-design') ? 'text-[#f9005b] bg-[#1a1a2e]' : 'text-gray-300' }} hover:bg-[#1a1a2e] hover:text-[#f9005b] uppercase tracking-[0.2em] transition-all duration-300 hover:pl-8">UI/UX Design</a>
                            <a href="{{ url('/animation') }}" class="block px-6 py-3 text-[10px] font-bold {{ Request::is('animation') ? 'text-[#f9005b] bg-[#1a1a2e]' : 'text-gray-300' }} hover:bg-[#1a1a2e] hover:text-[#f9005b] uppercase tracking-[0.2em] transition-all duration-300 hover:pl-8">2D & 3D Animation</a>
                        </div>
                    </div>
                </div>

                <!-- Link Portfolio Desktop -->
                <a href="{{ url('/portfolio') }}" class="h-full flex items-center font-sans text-[11px] font-bold tracking-[0.2em] {{ Request::is('portfolio') ? 'text-[#f9005b]' : 'text-white' }} hover:text-[#f9005b] transition-colors uppercase relative group">
                    <span class="relative h-full flex items-center mr-[-0.2em]">
                        Portfolio
                        <span class="absolute bottom-0 left-1/2 -translate-x-1/2 {{ Request::is('portfolio') ? 'w-full' : 'w-0' }} h-[2px] bg-[#f9005b] group-hover:w-full transition-all duration-300"></span>
                    </span>
                </a>

                <!-- Link About Desktop -->
                <a href="{{ url('/about') }}" class="h-full flex items-center font-sans text-[11px] font-bold tracking-[0.2em] {{ Request::is('about') ? 'text-[#f9005b]' : 'text-white' }} hover:text-[#f9005b] transition-colors uppercase relative group">
                    <span class="relative h-full flex items-center mr-[-0.2em]">
                        About Us
                        <span class="absolute bottom-0 left-1/2 -translate-x-1/2 {{ Request::is('about') ? 'w-full' : 'w-0' }} h-[2px] bg-[#f9005b] group-hover:w-full transition-all duration-300"></span>
                    </span>
                </a>

                <!-- Link Contact Desktop -->
                <a href="{{ url('/contact') }}" class="h-full flex items-center font-sans text-[11px] font-bold tracking-[0.2em] {{ Request::is('contact') ? 'text-[#f9005b]' : 'text-white' }} hover:text-[#f9005b] transition-colors uppercase relative group">
                    <span class="relative h-full flex items-center mr-[-0.2em]">
                        Contact
                        <span class="absolute bottom-0 left-1/2 -translate-x-1/2 {{ Request::is('contact') ? 'w-full' : 'w-0' }} h-[2px] bg-[#f9005b] group-hover:w-full transition-all duration-300"></span>
                    </span>
                </a>
            </div>

            <!-- Call to Actions Desktop -->
            <div class="hidden lg:flex items-stretch space-x-8 h-20">
                <div class="flex items-center">
                    <!-- DIUBAH: Mengarah ke /login dengan teks Login System -->
                    <a href="{{ url('/login') }}" class="relative overflow-hidden group font-sans bg-[#f9005b] text-white px-8 py-3.5 rounded-full text-[10px] font-bold tracking-[0.2em] transition-all duration-500 shadow-[0_10px_20px_rgba(249,0,91,0.3)] hover:shadow-[0_15px_30px_rgba(249,0,91,0.5)] hover:-translate-y-1 uppercase">
                        <span class="relative z-10 flex items-center gap-2">
                            Login System
                            <svg class="w-3.5 h-3.5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </span>
                    </a>
                </div>
            </div>

            <!-- Mobile Menu Button (Animated X) -->
            <div class="flex items-center lg:hidden relative z-[60]">
                <button id="mobile-menu-btn" class="relative w-11 h-11 flex flex-col items-center justify-center gap-[4px] focus:outline-none z-[60] bg-white/10 backdrop-blur-xl border border-white/20 rounded-full shadow-[0_8px_32px_rgba(0,0,0,0.3)] hover:bg-white/20 transition-all duration-300">
                    <span id="line-1" class="w-5 h-[2px] bg-white rounded-full transition-all duration-400 ease-in-out transform origin-center"></span>
                    <span id="line-2" class="w-5 h-[2px] bg-white rounded-full transition-all duration-300 ease-in-out transform origin-center"></span>
                    <span id="line-3" class="w-5 h-[2px] bg-white rounded-full transition-all duration-400 ease-in-out transform origin-center"></span>
                </button>
            </div>
        </div>
    </div>
</nav>

<!-- Background Blur Overlay -->
<div id="mobile-overlay" class="fixed inset-0 w-full h-full bg-[#080815]/60 backdrop-blur-xl z-[45] opacity-0 pointer-events-none transition-all duration-500 ease-in-out lg:hidden"></div>

<!-- Mobile Menu Content -->
<div id="mobile-menu" class="fixed top-24 right-4 left-4 sm:left-auto sm:w-[380px] bg-[#080815]/95 backdrop-blur-[40px] backdrop-saturate-[1.5] z-[55] opacity-0 pointer-events-none transition-all duration-400 ease-[cubic-bezier(0.3,0,0,1)] flex flex-col justify-start p-5 pb-12 lg:hidden overflow-hidden border border-white/10 rounded-[2rem] shadow-[0_30px_60px_rgba(0,0,0,0.8)] scale-95 origin-top sm:origin-top-right">
    
    <!-- Decorative Orbs for Glass Effect (Agency Colors) -->
    <div class="absolute -top-10 -right-10 w-40 h-40 bg-[#9d00ff]/30 rounded-full blur-[50px] pointer-events-none"></div>
    <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-[#f9005b]/20 rounded-full blur-[50px] pointer-events-none"></div>

    <div id="mobile-menu-content" class="relative z-10 flex flex-col space-y-4 transform translate-y-6 transition-transform duration-500 ease-out delay-75">
        
        <!-- Home Link -->
        <a href="{{ url('/') }}" class="font-sans text-lg font-bold tracking-widest {{ Request::is('/') ? 'text-[#f9005b]' : 'text-white' }} uppercase flex items-center justify-between group px-1">
            <span>Home</span>
            <span class="w-7 h-7 rounded-full {{ Request::is('/') ? 'bg-[#f9005b] border-[#f9005b]' : 'bg-white/10 border-white/10' }} backdrop-blur-md flex items-center justify-center text-white group-hover:bg-[#f9005b] group-hover:border-[#f9005b] transition-all duration-300 shadow-[0_4px_15px_rgba(0,0,0,0.2)]">
                <svg class="w-3.5 h-3.5 transform group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </span>
        </a>
        
        <!-- Separator Line -->
        <div class="h-[1px] w-full bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>
        
        <!-- Services Section Mobile -->
        <div class="space-y-3">
            <p class="text-[11px] font-bold tracking-[0.3em] text-gray-400 uppercase mb-2 px-1">Our Services</p>
            
            <div class="bg-white/5 hover:bg-white/10 backdrop-blur-lg border {{ $isServiceActive ? 'border-[#9d00ff]/50 bg-white/10' : 'border-white/10' }} rounded-[1.5rem] p-3.5 transition-all duration-300 group shadow-[0_4px_20px_rgba(0,0,0,0.2)]">
                <a href="{{ url('/#layanan') }}" class="flex justify-between items-center mb-3 px-1">
                    <span class="font-sans text-base font-bold tracking-widest {{ $isServiceActive ? 'text-[#9d00ff]' : 'text-white' }} uppercase group-hover:text-[#9d00ff] transition-colors">Digital Agency</span>
                    <div class="w-7 h-7 rounded-full {{ $isServiceActive ? 'bg-[#9d00ff] border-[#9d00ff] shadow-[0_0_10px_rgba(157,0,255,0.5)]' : 'bg-black/40 border-white/10' }} backdrop-blur-sm flex items-center justify-center text-white group-hover:bg-[#9d00ff] group-hover:border-[#9d00ff] group-hover:shadow-[0_0_10px_rgba(157,0,255,0.5)] transition-all duration-300">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </div>
                </a>
                
                <div class="grid grid-cols-2 gap-2">
                    <a href="{{ url('/web-development') }}" class="py-2 px-2 rounded-xl {{ Request::is('web-development') ? 'bg-[#9d00ff] text-white border-[#9d00ff]' : 'bg-black/40 border-white/10 text-gray-300' }} text-[9px] font-bold hover:text-white hover:bg-[#9d00ff] hover:border-[#9d00ff] uppercase tracking-widest text-center transition-all duration-300">Web Dev</a>
                    <a href="{{ url('/social-media') }}" class="py-2 px-2 rounded-xl {{ Request::is('social-media') ? 'bg-[#9d00ff] text-white border-[#9d00ff]' : 'bg-black/40 border-white/10 text-gray-300' }} text-[9px] font-bold hover:text-white hover:bg-[#9d00ff] hover:border-[#9d00ff] uppercase tracking-widest text-center transition-all duration-300">Sosmed</a>
                    <a href="{{ url('/uiux-design') }}" class="py-2 px-2 rounded-xl {{ Request::is('uiux-design') ? 'bg-[#9d00ff] text-white border-[#9d00ff]' : 'bg-black/40 border-white/10 text-gray-300' }} text-[9px] font-bold hover:text-white hover:bg-[#9d00ff] hover:border-[#9d00ff] uppercase tracking-widest text-center transition-all duration-300">UI/UX</a>
                    <a href="{{ url('/animation') }}" class="py-2 px-2 rounded-xl {{ Request::is('animation') ? 'bg-[#9d00ff] text-white border-[#9d00ff]' : 'bg-black/40 border-white/10 text-gray-300' }} text-[9px] font-bold hover:text-white hover:bg-[#9d00ff] hover:border-[#9d00ff] uppercase tracking-widest text-center transition-all duration-300">Animasi</a>
                </div>
            </div>
        </div>
        
        <!-- Separator Line -->
        <div class="h-[1px] w-full bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>

        <!-- Portfolio Link Mobile -->
        <a href="{{ url('/portfolio') }}" class="font-sans text-lg font-bold tracking-widest {{ Request::is('portfolio') ? 'text-[#f9005b]' : 'text-white' }} uppercase flex items-center justify-between group px-1">
            <span>Portfolio</span>
            <span class="w-7 h-7 rounded-full {{ Request::is('portfolio') ? 'bg-[#f9005b] border-[#f9005b]' : 'bg-white/10 border-white/10' }} backdrop-blur-md flex items-center justify-center text-white group-hover:bg-[#f9005b] group-hover:border-[#f9005b] transition-all duration-300 shadow-[0_4px_15px_rgba(0,0,0,0.2)]">
                <svg class="w-3.5 h-3.5 transform group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </span>
        </a>

        <!-- Separator Line -->
        <div class="h-[1px] w-full bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>
        
        <!-- About Us Link -->
        <a href="{{ url('/about') }}" class="font-sans text-lg font-bold tracking-widest {{ Request::is('about') ? 'text-[#f9005b]' : 'text-white' }} uppercase flex items-center justify-between group px-1">
            <span>About Us</span>
            <span class="w-7 h-7 rounded-full {{ Request::is('about') ? 'bg-[#f9005b] border-[#f9005b]' : 'bg-white/10 border-white/10' }} backdrop-blur-md flex items-center justify-center text-white group-hover:bg-[#f9005b] group-hover:border-[#f9005b] transition-all duration-300 shadow-[0_4px_15px_rgba(0,0,0,0.2)]">
                <svg class="w-3.5 h-3.5 transform group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </span>
        </a>

        <!-- Contact Link Mobile -->
        <a href="{{ url('/contact') }}" class="font-sans text-lg font-bold tracking-widest {{ Request::is('contact') ? 'text-[#f9005b]' : 'text-white' }} uppercase flex items-center justify-between group px-1">
            <span>Contact</span>
            <span class="w-7 h-7 rounded-full {{ Request::is('contact') ? 'bg-[#f9005b] border-[#f9005b]' : 'bg-white/10 border-white/10' }} backdrop-blur-md flex items-center justify-center text-white group-hover:bg-[#f9005b] group-hover:border-[#f9005b] transition-all duration-300 shadow-[0_4px_15px_rgba(0,0,0,0.2)]">
                <svg class="w-3.5 h-3.5 transform group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </span>
        </a>
    </div>

    <!-- Mobile CTA Bottom -->
    <div id="mobile-menu-footer" class="relative z-10 mt-8 transform translate-y-6 transition-transform duration-500 ease-out delay-150">
        <!-- DIUBAH: Mengarah ke /login dengan teks System Access -->
        <a href="{{ url('/login') }}" class="w-full flex items-center justify-center gap-2 bg-[#f9005b]/90 backdrop-blur-xl border border-[#f9005b]/50 text-white py-3.5 rounded-2xl font-sans text-xs font-bold tracking-[0.2em] uppercase transition-all duration-300 shadow-[0_4px_15px_rgba(249,0,91,0.3)] hover:shadow-[0_8px_20px_rgba(249,0,91,0.5)] hover:bg-[#f9005b] hover:-translate-y-0.5">
            System Access 
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
        </a>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        const overlay = document.getElementById('mobile-overlay');
        
        const line1 = document.getElementById('line-1');
        const line2 = document.getElementById('line-2');
        const line3 = document.getElementById('line-3');

        const menuContent = document.getElementById('mobile-menu-content');
        const menuFooter = document.getElementById('mobile-menu-footer');

        function toggleMenu() {
            const isOpen = menu.classList.contains('opacity-100');
            
            if (isOpen) {
                menu.classList.replace('opacity-100', 'opacity-0');
                menu.classList.replace('scale-100', 'scale-95');
                menu.classList.add('pointer-events-none');
                overlay.classList.replace('opacity-100', 'opacity-0');
                overlay.classList.add('pointer-events-none');
                line1.classList.remove('translate-y-[6px]', 'rotate-45');
                line2.classList.remove('opacity-0', 'scale-x-0');
                line3.classList.remove('-translate-y-[6px]', '-rotate-45');
                btn.classList.remove('bg-white/20');
                document.body.style.overflow = '';
                if (menuContent) menuContent.classList.replace('translate-y-0', 'translate-y-8');
                if (menuFooter) menuFooter.classList.replace('translate-y-0', 'translate-y-8');
            } else {
                menu.classList.replace('opacity-0', 'opacity-100');
                menu.classList.replace('scale-95', 'scale-100');
                menu.classList.remove('pointer-events-none');
                overlay.classList.replace('opacity-0', 'opacity-100');
                overlay.classList.remove('pointer-events-none');
                line1.classList.add('translate-y-[6px]', 'rotate-45');
                line2.classList.add('opacity-0', 'scale-x-0');
                line3.classList.add('-translate-y-[6px]', '-rotate-45');
                btn.classList.add('bg-white/20');
                document.body.style.overflow = 'hidden';
                if (menuContent) menuContent.classList.replace('translate-y-8', 'translate-y-0');
                if (menuFooter) menuFooter.classList.replace('translate-y-8', 'translate-y-0');
            }
        }

        btn.addEventListener('click', toggleMenu);
        overlay.addEventListener('click', toggleMenu);
        
        const mobileLinks = menu.querySelectorAll('a');
        mobileLinks.forEach(link => {
            link.addEventListener('click', toggleMenu);
        });
    });
</script>
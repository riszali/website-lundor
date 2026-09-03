// Menggunakan standar Three.js (Mengandalkan importmap di home.blade.php)
import * as THREE from 'three';
import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';
import { OrbitControls } from 'three/addons/controls/OrbitControls.js';

document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('astronaut-canvas');
    if (!container) return;

    const width = container.clientWidth || window.innerWidth;
    const height = container.clientHeight || window.innerHeight;

    // --- 1. SETUP SCENE, CAMERA, RENDERER ---
    const scene = new THREE.Scene();
    scene.fog = new THREE.FogExp2(0x05050a, 0.05);

    const camera = new THREE.PerspectiveCamera(45, width / height, 0.1, 1000);
    camera.position.set(0, 1.5, 6);

    const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
    renderer.setSize(width, height);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    renderer.toneMapping = THREE.ACESFilmicToneMapping;
    renderer.toneMappingExposure = 1.2;
    container.appendChild(renderer.domElement);

    // --- 2. SETUP CONTROLS ---
    const controls = new OrbitControls(camera, renderer.domElement);
    controls.enableDamping = true;
    controls.dampingFactor = 0.05;
    controls.enableZoom = true; 
    controls.enablePan = true;
    controls.target.set(0, 1, 0);

    // --- 3. SETUP LIGHTING (Neon Vibe) ---
    const ambientLight = new THREE.AmbientLight(0xffffff, 0.6);
    scene.add(ambientLight);

    const mainLight = new THREE.DirectionalLight(0xf9005b, 4);
    mainLight.position.set(5, 5, 5);
    scene.add(mainLight);

    const fillLight = new THREE.DirectionalLight(0x9d00ff, 3);
    fillLight.position.set(-5, 3, -5);
    scene.add(fillLight);

    const bottomLight = new THREE.DirectionalLight(0x00ffff, 1.5);
    bottomLight.position.set(0, -5, 0);
    scene.add(bottomLight);

    // --- 4. LOAD MODEL AMAN ---
    let mixer; 
    const loader = new GLTFLoader();
    
    // Link mengarah ke GitHub Anda
    const modelUrl = 'https://cdn.jsdelivr.net/gh/riszali/animated_astronaut_character_in_space_suit_loop@main/scene.gltf'; 
    
    const loaderUI = document.getElementById('astro-loader');

    const loadAstronaut = () => {
        loader.load(
            modelUrl,
            (gltf) => {
                const model = gltf.scene;
                
                // Set posisi default
                model.position.set(0, -1, 0);

                scene.add(model);

                // Mainkan animasi berjalan
                if (gltf.animations && gltf.animations.length > 0) {
                    mixer = new THREE.AnimationMixer(model);
                    const action = mixer.clipAction(gltf.animations[0]);
                    action.play();
                }

                // Hapus animasi loading UI ketika model selesai dirender
                if(loaderUI) {
                    loaderUI.style.opacity = '0';
                    setTimeout(() => loaderUI.style.display = 'none', 500);
                }
            },
            (xhr) => {
                // Sengaja dikosongkan agar tidak membebani memori CPU saat proses download
            },
            (error) => {
                console.error("Gagal memuat:", error);
                if(loaderUI) {
                    loaderUI.innerHTML = `<span class="font-bold text-red-500">Gagal memuat model. Periksa koneksi/CORS.</span>`;
                }
            }
        );
    };

    // Lazy load observer
    const section = document.getElementById('astronaut-section');
    if (section) {
        const observer = new IntersectionObserver((entries) => {
            if (entries[0].isIntersecting) {
                loadAstronaut(); 
                observer.disconnect(); 
            }
        }, { threshold: 0.1 }); 
        observer.observe(section);
    } else {
        loadAstronaut();
    }

    // --- 5. ANIMATION LOOP ---
    const clock = new THREE.Clock();
    function animate() {
        requestAnimationFrame(animate);
        if (mixer) mixer.update(clock.getDelta());
        
        // Rotasi panggung super pelan
        scene.rotation.y += 0.001;
        
        controls.update();
        renderer.render(scene, camera);
    }
    animate();

    window.addEventListener('resize', () => {
        if(!container) return;
        camera.aspect = container.clientWidth / container.clientHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(container.clientWidth, container.clientHeight);
    });
});
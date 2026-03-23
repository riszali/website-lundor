import * as THREE from "three";
import { GLTFLoader } from "three/addons/loaders/GLTFLoader.js";
import { EffectComposer } from "three/addons/postprocessing/EffectComposer.js";
import { RenderPass } from "three/addons/postprocessing/RenderPass.js";
import { GlitchPass } from "three/addons/postprocessing/GlitchPass.js";
import { UnrealBloomPass } from "three/addons/postprocessing/UnrealBloomPass.js";

let scene, camera, renderer, composer, headModel, glitchPass;
let mouse = new THREE.Vector2();
let isScaryInitialized = false;
let animationId;

const screamSound = new Audio('https://www.myinstants.com/media/sounds/screaming-man.mp3');
screamSound.preload = 'auto';

const scarySection = document.getElementById('scary-section');
const container = document.getElementById('scene-container');
const svgOverlay = document.getElementById('jumpscare');

const scaryObserver = new IntersectionObserver((entries) => {
    if(entries[0].isIntersecting && !isScaryInitialized) {
        isScaryInitialized = true;
        initScaryScene();
    }
}, { threshold: 0.2 });

if (scarySection) {
    scaryObserver.observe(scarySection);
}

// --- SETUP EFEK STICKY / OVERLAY (GSAP) ---
function setupStickyOverlay() {
    // Memastikan GSAP dan ScrollTrigger sudah dimuat dari window
    if (window.gsap && window.ScrollTrigger) {
        window.gsap.registerPlugin(window.ScrollTrigger);
        
        window.ScrollTrigger.create({
            trigger: "#scary-section",
            start: "top top",           // Mulai mengunci saat sisi atas section menyentuh sisi atas viewport
            endTrigger: "#city-section",// Kuncian dilepas saat sisi atas city-section...
            end: "top top",             // ...menyentuh sisi atas viewport (sudah menutupi layar penuh)
            pin: true,                  // Mengunci (sticky) scary-section
            pinSpacing: false           // KUNCI UTAMA: menonaktifkan jarak kosong agar city-section bisa menimpa!
        });
    }
}

// Menjalankan setup GSAP setelah semua elemen DOM dan Script global selesai dimuat
if (document.readyState === 'complete') {
    setupStickyOverlay();
} else {
    window.addEventListener('load', setupStickyOverlay);
}
// ------------------------------------------

function initScaryScene() {
    scene = new THREE.Scene();
    const width = container.clientWidth;
    const height = container.clientHeight;

    camera = new THREE.PerspectiveCamera(75, width / height, 0.1, 1000);
    camera.position.z = 3;

    renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
    renderer.setSize(width, height);
    renderer.setPixelRatio(window.devicePixelRatio);
    renderer.toneMapping = THREE.ReinhardToneMapping;
    renderer.shadowMap.enabled = true;
    renderer.shadowMap.type = THREE.PCFSoftShadowMap;
    container.appendChild(renderer.domElement);

    const ambientLight = new THREE.AmbientLight(0x202040, 0.3);
    scene.add(ambientLight);
    
    const redLight = new THREE.PointLight(0xff0000, 2, 100);
    redLight.position.set(1, 1, 2);
    scene.add(redLight);

    const directionalLight = new THREE.DirectionalLight(0x9999ff, 0.4);
    directionalLight.position.set(-10, 10, -10);
    directionalLight.castShadow = true;
    directionalLight.shadow.mapSize.width = 2048;
    directionalLight.shadow.mapSize.height = 2048;
    scene.add(directionalLight);

    createGraveyard();

    const loader = new GLTFLoader();
    loader.load('https://cdn.jsdelivr.net/gh/mrdoob/three.js@r164/examples/models/gltf/LeePerrySmith/LeePerrySmith.glb', (gltf) => {
        headModel = gltf.scene;
        headModel.scale.set(0.7, 0.7, 0.7);
        headModel.position.y = -1;
        
        headModel.traverse((node) => {
            if (node.isMesh) {
                node.material = new THREE.MeshStandardMaterial({
                    color: 0x888888,
                    roughness: 0.6,
                    metalness: 0.2
                });
                node.castShadow = true;
                node.receiveShadow = true;
            }
        });
        scene.add(headModel);
    }, undefined, (error) => {
        console.error('An error happened while loading the model:', error);
    });

    composer = new EffectComposer(renderer);
    const renderPass = new RenderPass(scene, camera);
    composer.addPass(renderPass);

    const bloomPass = new UnrealBloomPass(new THREE.Vector2(width, height), 1.5, 0.4, 0.85);
    bloomPass.threshold = 0;
    bloomPass.strength = 0.5; 
    bloomPass.radius = 0;
    composer.addPass(bloomPass);
    
    glitchPass = new GlitchPass();
    glitchPass.enabled = false; 
    glitchPass.goWild = true; 
    composer.addPass(glitchPass);

    window.addEventListener('resize', onWindowResize);
    scarySection.addEventListener('mousemove', onMouseMove);

    // setTimeout(triggerJumpScare, 7000); // <-- BARIS INI DINONAKTIFKAN agar layar tidak berkedip/bergetar penuh
    animate();
}

function createGraveyard() {
    const groundGeometry = new THREE.PlaneGeometry(50, 50);
    const groundMaterial = new THREE.MeshStandardMaterial({ 
        color: 0x1a1a1a,
        roughness: 0.9,
        metalness: 0.1
    });
    const ground = new THREE.Mesh(groundGeometry, groundMaterial);
    ground.rotation.x = -Math.PI / 2;
    ground.position.y = -2;
    ground.receiveShadow = true;
    scene.add(ground);

    const moonGeometry = new THREE.SphereGeometry(3, 32, 32);
    const moonMaterial = new THREE.MeshStandardMaterial({
        color: 0xffffcc,
        emissive: 0xffffaa,
        emissiveIntensity: 0.8
    });
    const moon = new THREE.Mesh(moonGeometry, moonMaterial);
    moon.position.set(-10, 15, -30);
    scene.add(moon);

    const moonLight = new THREE.PointLight(0xffffcc, 0.5, 100);
    moonLight.position.copy(moon.position);
    scene.add(moonLight);

    createIronFence();
    createTombstones();
    createTwistedTrees();

    scene.fog = new THREE.Fog(0x000000, 5, 30);
}

function createIronFence() {
    const fenceMaterial = new THREE.MeshStandardMaterial({
        color: 0x2a2a2a,
        roughness: 0.8,
        metalness: 0.9
    });

    for (let i = 0; i < 20; i++) {
        const angle = (i / 20) * Math.PI - Math.PI / 2;
        const radius = 12;
        const x = Math.cos(angle) * radius;
        const z = Math.sin(angle) * radius;

        const postGeometry = new THREE.CylinderGeometry(0.08, 0.08, 3, 8);
        const post = new THREE.Mesh(postGeometry, fenceMaterial);
        post.position.set(x, -0.5, z);
        post.castShadow = true;
        scene.add(post);

        const spikeGeometry = new THREE.ConeGeometry(0.15, 0.5, 8);
        const spike = new THREE.Mesh(spikeGeometry, fenceMaterial);
        spike.position.set(x, 1.25, z);
        spike.castShadow = true;
        scene.add(spike);

        if (i < 19) {
            const nextAngle = ((i + 1) / 20) * Math.PI - Math.PI / 2;
            const nextX = Math.cos(nextAngle) * radius;
            const nextZ = Math.sin(nextAngle) * radius;
            
            const distance = Math.sqrt(Math.pow(nextX - x, 2) + Math.pow(nextZ - z, 2));
            const barGeometry = new THREE.CylinderGeometry(0.04, 0.04, distance, 8);
            const bar = new THREE.Mesh(barGeometry, fenceMaterial);
            
            bar.position.set((x + nextX) / 2, 0, (z + nextZ) / 2);
            bar.rotation.z = Math.PI / 2;
            bar.rotation.y = -angle - Math.PI / 2;
            scene.add(bar);
        }
    }
}

function createTombstones() {
    const tombstoneMaterial = new THREE.MeshStandardMaterial({
        color: 0x4a4a4a,
        roughness: 0.9,
        metalness: 0.1
    });

    const positions = [
        [-5, -1, -5], [-3, -1, -7], [4, -1, -6],
        [-6, -1, -3], [5, -1, -4], [0, -1, -8],
        [-2, -1, -4], [3, -1, -8], [-7, -1, -6]
    ];

    positions.forEach(pos => {
        const baseGeometry = new THREE.BoxGeometry(1.2, 1.5, 0.3);
        const tombstone = new THREE.Mesh(baseGeometry, tombstoneMaterial);
        tombstone.position.set(pos[0], pos[1], pos[2]);
        tombstone.rotation.y = Math.random() * 0.3 - 0.15;
        tombstone.castShadow = true;
        tombstone.receiveShadow = true;
        scene.add(tombstone);

        const topGeometry = new THREE.SphereGeometry(0.6, 16, 8, 0, Math.PI * 2, 0, Math.PI / 2);
        const top = new THREE.Mesh(topGeometry, tombstoneMaterial);
        top.position.set(pos[0], pos[1] + 0.75, pos[2]);
        top.rotation.x = Math.PI;
        top.rotation.y = tombstone.rotation.y;
        top.castShadow = true;
        scene.add(top);
    });
}

function createTwistedTrees() {
    const trunkMaterial = new THREE.MeshStandardMaterial({
        color: 0x2d1f1f,
        roughness: 1.0,
        metalness: 0
    });

    const treePositions = [
        [-8, 0, -10], [9, 0, -12], [-10, 0, -8], [8, 0, -9]
    ];

    treePositions.forEach(pos => {
        const trunkGeometry = new THREE.CylinderGeometry(0.3, 0.5, 4, 8);
        const trunk = new THREE.Mesh(trunkGeometry, trunkMaterial);
        trunk.position.set(pos[0], pos[1], pos[2]);
        
        trunk.rotation.z = Math.random() * 0.3 - 0.15;
        trunk.scale.y = 1 + Math.random() * 0.5;
        trunk.castShadow = true;
        scene.add(trunk);

        for (let i = 0; i < 5; i++) {
            const branchGeometry = new THREE.CylinderGeometry(0.08, 0.15, 2, 6);
            const branch = new THREE.Mesh(branchGeometry, trunkMaterial);
            
            branch.position.set(
                pos[0] + (Math.random() - 0.5) * 0.5,
                pos[1] + 1.5 + Math.random() * 2,
                pos[2] + (Math.random() - 0.5) * 0.5
            );
            
            branch.rotation.x = Math.random() * Math.PI / 3;
            branch.rotation.z = Math.random() * Math.PI * 2;
            branch.castShadow = true;
            scene.add(branch);
        }
    });
}

function triggerJumpScare() {
    glitchPass.enabled = true;
    screamSound.currentTime = 0;
    screamSound.play().catch(e => console.log('Audio autoplay diblokir oleh browser:', e));
    
    document.body.classList.add('shake');
    svgOverlay.classList.add('scare-active');

    setTimeout(() => {
        glitchPass.enabled = false;
        document.body.classList.remove('shake');
        svgOverlay.classList.remove('scare-active');
    }, 1000);
}

function onWindowResize() {
    if (!camera || !renderer || !composer) return;
    const width = container.clientWidth;
    const height = container.clientHeight;
    camera.aspect = width / height;
    camera.updateProjectionMatrix();
    renderer.setSize(width, height);
    composer.setSize(width, height);
}

function onMouseMove(event) {
    const rect = container.getBoundingClientRect();
    mouse.x = ((event.clientX - rect.left) / rect.width) * 2 - 1;
    mouse.y = -((event.clientY - rect.top) / rect.height) * 2 + 1;
}

function animate() {
    animationId = requestAnimationFrame(animate);

    const rect = container.getBoundingClientRect();
    const isVisible = (rect.top < window.innerHeight && rect.bottom > 0);
    
    if (isVisible) {
        if (headModel) {
            headModel.rotation.y += (mouse.x * 0.5 - headModel.rotation.y) * 0.1;
            headModel.rotation.x += (-mouse.y * 0.5 - headModel.rotation.x) * 0.1;
        }
        composer.render();
    }
}
document.addEventListener("DOMContentLoaded", () => {
    gsap.registerPlugin(ScrollTrigger);

    // --- 1. Animasi GSAP Hero Section ---
    let tl = gsap.timeline({
        scrollTrigger: {
            trigger: "#hero-section",     
            start: "top top",             
            end: "+=200%",                
            scrub: 1,                     
            pin: true,                    
            anticipatePin: 1              
        }
    });

    tl.to("#door-image", {
        scale: 30,           
        opacity: 0,          
        transformOrigin: "center center", 
        ease: "power2.inOut"
    }, 0);

    tl.to("#hero-text", {
        opacity: 1,          
        scale: 1,            
        ease: "power2.out",
        duration: 0.5
    }, 0.2); 

    // --- 2. Animasi Glitch Section (Dipindah Ke Atas) ---
    let glitchTl = gsap.timeline({
        scrollTrigger: {
            trigger: "#glitch-section",
            start: "center center",
            end: "+=100%",
            scrub: 1, 
            pin: true
        }
    });
    glitchTl.to("#boring-state", { opacity: 0, duration: 1, ease: "power2.inOut" });
    glitchTl.to("#chaos-state", { opacity: 1, scale: 1, duration: 1, ease: "power2.out" }, "-=0.5");

    // --- 3. Script Drag-to-Scroll Slider & Hover Spotlight ---
    const slider = document.getElementById('roles-slider');
    let isDown = false;
    let startX;
    let scrollLeft;

    slider.addEventListener('mousedown', (e) => {
        isDown = true;
        slider.classList.add('cursor-grabbing');
        slider.classList.remove('snap-x', 'snap-mandatory'); 
        startX = e.pageX - slider.offsetLeft;
        scrollLeft = slider.scrollLeft;
    });
    slider.addEventListener('mouseleave', () => { isDown = false; slider.classList.remove('cursor-grabbing'); slider.classList.add('snap-x', 'snap-mandatory'); });
    slider.addEventListener('mouseup', () => { isDown = false; slider.classList.remove('cursor-grabbing'); slider.classList.add('snap-x', 'snap-mandatory'); });
    slider.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - slider.offsetLeft;
        const walk = (x - startX) * 2; 
        slider.scrollLeft = scrollLeft - walk;
    });

    const techCards = document.querySelectorAll('.tech-card');
    techCards.forEach(card => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            card.style.setProperty('--mouse-x', `${x}px`);
            card.style.setProperty('--mouse-y', `${y}px`);
        });
    });
    
    // --- 4. Script Portaplane 3D (Optimasi Observer) ---
    let isPortaplaneVisible = false;
    const portaplaneSection = document.getElementById('section-portaplane');
    const portaplaneObserver = new IntersectionObserver((entries) => {
        isPortaplaneVisible = entries[0].isIntersecting;
    }, { threshold: 0 });
    if (portaplaneSection) portaplaneObserver.observe(portaplaneSection);

    const initPortaplane = () => {
        const settings = { sizes: { width: 0, height: 0 }, boxDimensions: { h: 1.4, w: 1 } };
        const canvasContainer = document.getElementById('portaplane-canvas-wrapper');
        if (!canvasContainer) return;

        settings.sizes.width = canvasContainer.clientWidth;
        settings.sizes.height = canvasContainer.clientHeight;
        if (settings.sizes.width === 0 || settings.sizes.height === 0) {
            settings.sizes.width = window.innerWidth;
            settings.sizes.height = window.innerHeight;
        }

        const textureLoader = new THREE.TextureLoader();
        const textures = {};
        const loadTexture = (url, name) => {
            return new Promise((resolve) => {
            textureLoader.load(url, (texture) => { textures[name] = texture; resolve(texture); }, undefined, 
                (error) => { textures[name] = new THREE.Color(0x888888); resolve(textures[name]); }
            );
            });
        };

        Promise.all([
            loadTexture('https://images.unsplash.com/photo-1647998681311-390a8474174c?q=80&w=1528&auto=format&fit=crop', 'photoTexture02'),
            loadTexture('https://images.unsplash.com/photo-1671963868167-ba3f620c9dac?q=80&w=654&auto=format&fit=crop', 'photoTexture03'),
            loadTexture('https://images.unsplash.com/photo-1662548293729-0da75f4178d0?q=80&w=1740&auto=format&fit=crop', 'photoTexture')
        ]).then(() => {
            textures.photoTexture.wrapS = THREE.RepeatWrapping;
            textures.photoTexture.wrapT = THREE.RepeatWrapping;
            textures.photoTexture.repeat.set( .1, .1 );

            const scene = new THREE.Scene();
            const camera = new THREE.PerspectiveCamera(75, settings.sizes.width / settings.sizes.height, 0.1, 1000);

            const updateCameraSettings = () => {
                if (window.innerWidth <= 768) { camera.fov = 100; camera.position.set(0, 0, 2.4); } 
                else { camera.fov = 75; camera.position.set(0, 0, 3); }
                camera.aspect = settings.sizes.width / settings.sizes.height;
                camera.updateProjectionMatrix();
            };
            updateCameraSettings();
            camera.lookAt(0, 0, 0);
            scene.add(camera);
            scene.add(new THREE.AmbientLight(0xffffff, .5));
            
            const planeGeometry = new THREE.PlaneGeometry(settings.boxDimensions.w, settings.boxDimensions.h);
            const renderer = new THREE.WebGLRenderer( { antialias: true, alpha: true } );
            renderer.setSize( settings.sizes.width, settings.sizes.height );
            renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
            canvasContainer.appendChild( renderer.domElement );

            function RoundedPortalPhotoPlane(geometry, photoTexture) {
                const material = photoTexture instanceof THREE.Texture 
                    ? new THREE.MeshMatcapMaterial({ matcap: photoTexture, transparent: true })
                    : new THREE.MeshBasicMaterial({ color: photoTexture, transparent: true });
            
                if (photoTexture instanceof THREE.Texture) {
                    material.onBeforeCompile = (shader) => {
                        shader.vertexShader = shader.vertexShader.replace('#include <common>', `#include <common>\nvarying vec4 vPosition;\nvarying vec2 vUv;`);
                        shader.vertexShader = shader.vertexShader.replace('#include <fog_vertex>', `#include <fog_vertex>\nvPosition = mvPosition;\nvUv = uv;`);
                        shader.fragmentShader = shader.fragmentShader.replace(`#include <common>`, `#include <common>\nvarying vec4 vPosition;\nvarying vec2 vUv;\nfloat roundedBoxSDF(vec2 CenterPosition, vec2 Size, float Radius) { return length(max(abs(CenterPosition)-Size+Radius,0.0))-Radius; }`);
                        shader.fragmentShader = shader.fragmentShader.replace(`#include <dithering_fragment>`, `#include <dithering_fragment>\nvec2 size = vec2(1.0, 1.0);\nfloat edgeSoftness  = 0.001;\nfloat radius = 0.08;\nfloat distance  = roundedBoxSDF(vUv.xy - (size/2.0), size/2.0, radius);\nfloat smoothedAlpha =  1.0-smoothstep(0.0, edgeSoftness * 2.0,distance);\ngl_FragColor = vec4(outgoingLight, smoothedAlpha);`);
                    };
                }
                return new THREE.Mesh( geometry, material );
            }
            
            const planeGroup = new THREE.Group();
            const photoPlane01 = new RoundedPortalPhotoPlane(planeGeometry, textures.photoTexture02);
            photoPlane01.position.set(-1, 0, 1); photoPlane01.rotation.y = Math.PI * 0.1; planeGroup.add(photoPlane01);
            const photoPlane02 = new RoundedPortalPhotoPlane(planeGeometry, textures.photoTexture);
            photoPlane02.position.set(0, 0, 0.5); planeGroup.add(photoPlane02);
            const photoPlane03 = new RoundedPortalPhotoPlane(planeGeometry, textures.photoTexture03);
            photoPlane03.position.set(1, 0, 1); photoPlane03.rotation.y = Math.PI * -0.1; planeGroup.add(photoPlane03);
            scene.add(planeGroup);
            
            let currentControlMode = 'mouse';
            const controlInput = new THREE.Vector2();
            let gyroOffset = { alpha: 0, beta: 0, gamma: 0 }, isCalibrated = false;

            const mouseBtn = document.getElementById('mouse-control-btn'), gyroBtn = document.getElementById('gyro-control-btn');
            const calBtn = document.getElementById('calibrate-btn'), permMsg = document.getElementById('permission-message'), reqPermBtn = document.getElementById('request-permission-btn');

            const handleMouseMove = (event) => {
                const rect = canvasContainer.getBoundingClientRect();
                controlInput.x = ((event.clientX - rect.left) / rect.width) * 2 - 1;
                controlInput.y = - ((event.clientY - rect.top) / rect.height) * 2 + 1;
            };

            const handleDeviceOrientation = (event) => {
                if (event.alpha === null || event.beta === null || event.gamma === null) return;
                if (!isCalibrated) { gyroOffset.alpha = event.alpha; gyroOffset.beta = event.beta; gyroOffset.gamma = event.gamma; isCalibrated = true; }
                const beta = event.beta - gyroOffset.beta, gamma = event.gamma - gyroOffset.gamma;
                controlInput.x = THREE.MathUtils.clamp(THREE.MathUtils.degToRad(gamma) * -0.8, -Math.PI / 5, Math.PI / 5);
                controlInput.y = THREE.MathUtils.clamp(THREE.MathUtils.degToRad(beta) * 0.8, -Math.PI / 5, Math.PI / 5);
            };

            const setControlMode = (mode) => {
                mouseBtn.classList.remove('active', 'bg-[#f9005b]'); mouseBtn.classList.add('bg-[#080815]');
                gyroBtn.classList.remove('active', 'bg-[#f9005b]'); gyroBtn.classList.add('bg-[#080815]');
                window.removeEventListener('mousemove', handleMouseMove); window.removeEventListener('deviceorientation', handleDeviceOrientation);
                permMsg.style.display = 'none'; currentControlMode = mode;

                if (mode === 'mouse') {
                    window.addEventListener('mousemove', handleMouseMove);
                    mouseBtn.classList.add('active', 'bg-[#f9005b]'); mouseBtn.classList.remove('bg-[#080815]');
                    calBtn.style.display = 'none';
                } else if (mode === 'gyro') {
                    if (typeof DeviceOrientationEvent !== 'undefined' && typeof DeviceOrientationEvent.requestPermission === 'function') {
                        permMsg.style.display = 'flex';
                        
                        // Define button action
                        reqPermBtn.onclick = () => {
                            DeviceOrientationEvent.requestPermission().then(state => {
                                if (state === 'granted') { 
                                    permMsg.style.display = 'none';
                                    window.addEventListener('deviceorientation', handleDeviceOrientation); 
                                    isCalibrated = false; 
                                } else { 
                                    const pTag = permMsg.querySelector('p');
                                    const originalText = pTag.innerText;
                                    const originalBtnText = reqPermBtn.innerText;
                                    
                                    pTag.innerHTML = "<span class='text-[#f9005b] font-bold text-xl'>Izin Ditolak</span><br><br><span class='text-sm text-gray-300'>Anda menolak akses sensor. Kembali ke mode Mouse.</span>";
                                    reqPermBtn.innerText = "Mengerti";
                                    
                                    reqPermBtn.onclick = () => {
                                        pTag.innerText = originalText;
                                        reqPermBtn.innerText = originalBtnText;
                                        permMsg.style.display = 'none';
                                        setControlMode('mouse');
                                    };
                                }
                            }).catch(err => {
                                console.error("Gyroscope error:", err);
                                const pTag = permMsg.querySelector('p');
                                const originalText = pTag.innerText;
                                const originalBtnText = reqPermBtn.innerText;
                                
                                pTag.innerHTML = "<span class='text-[#f9005b] font-bold text-xl'>Sensor Diblokir</span><br><br><span class='text-sm text-gray-300'>Fitur Gyroscope diblokir karena membutuhkan koneksi aman (HTTPS). Karena Anda menggunakan HTTP lokal, akses ditolak otomatis. Gunakan Ngrok untuk URL HTTPS.</span>";
                                reqPermBtn.innerText = "Tutup & Gunakan Mouse";
                                
                                reqPermBtn.onclick = () => {
                                    pTag.innerText = originalText;
                                    reqPermBtn.innerText = originalBtnText;
                                    permMsg.style.display = 'none';
                                    setControlMode('mouse');
                                };
                            });
                        };
                    } else { 
                        window.addEventListener('deviceorientation', handleDeviceOrientation); 
                    }
                    gyroBtn.classList.add('active', 'bg-[#f9005b]'); gyroBtn.classList.remove('bg-[#080815]');
                    calBtn.style.display = 'inline-block'; isCalibrated = false;
                }
                gsap.to(planeGroup.rotation, { duration: 0.5, x: 0, y: 0, z: 0 }); controlInput.set(0, 0);
            };

            mouseBtn.addEventListener('click', () => setControlMode('mouse'));
            gyroBtn.addEventListener('click', () => setControlMode('gyro'));
            calBtn.addEventListener('click', () => { if (currentControlMode === 'gyro') { isCalibrated = false; controlInput.set(0, 0); gsap.to(planeGroup.rotation, { duration: 0.5, x: 0, y: 0, z: 0 }); } });
            setControlMode('mouse');
            
            const clock = new THREE.Clock();
            renderer.setAnimationLoop(() => {
                if (!isPortaplaneVisible) return;
                const dt = clock.getDelta(), smooth = 7;
                planeGroup.rotation.y += (controlInput.x - planeGroup.rotation.y) * smooth * dt;
                planeGroup.rotation.x += (controlInput.y - planeGroup.rotation.x) * smooth * dt;
                renderer.render(scene, camera);
            });

            window.addEventListener('resize', () => {
                settings.sizes.width = canvasContainer.clientWidth; settings.sizes.height = canvasContainer.clientHeight;
                renderer.setSize(settings.sizes.width, settings.sizes.height);
                renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2)); updateCameraSettings();
            });
        });
    };
    initPortaplane();

    // --- 5. Animasi Kinetic Typography ---
    gsap.to(".marquee-left", { xPercent: -15, ease: "none", scrollTrigger: { trigger: "#kinetic-section", start: "top bottom", end: "bottom top", scrub: 1 }});
    gsap.to(".marquee-right", { xPercent: 15, ease: "none", scrollTrigger: { trigger: "#kinetic-section", start: "top bottom", end: "bottom top", scrub: 1 }});
    gsap.to("#kinetic-section .kinetic-word", {
        color: "#f9005b", webkitTextStrokeColor: "transparent", textShadow: "0 0 40px rgba(249,0,91,0.5)", stagger: 0.05,
        scrollTrigger: { trigger: "#kinetic-section", start: "top 60%", end: "center center", scrub: 1 }
    });


    // --- 6. Script Integrasi Lab City 3D ---
    const initCity3D = () => {
        const container = document.getElementById('city-canvas-wrapper');
        const section = document.getElementById('city-section');
        if (!container || !section) return;

        let width = container.clientWidth;
        let height = container.clientHeight;

        const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
        renderer.setSize(width, height);

        if (window.innerWidth > 800) {
            renderer.shadowMap.enabled = true;
            renderer.shadowMap.type = THREE.PCFSoftShadowMap;
        }
        container.appendChild(renderer.domElement);

        const camera = new THREE.PerspectiveCamera(20, width / height, 1, 500);
        camera.position.set(0, 2, 14);

        const scene = new THREE.Scene();
        const city = new THREE.Object3D();
        const smoke = new THREE.Object3D();
        const town = new THREE.Object3D();

        let createCarPos = true;
        const uSpeed = 0.001;
        const setcolor = 0xF02050;

        scene.background = new THREE.Color(setcolor);
        scene.fog = new THREE.Fog(setcolor, 10, 16);

        function mathRandom(num = 8) {
            return -Math.random() * num + Math.random() * num;
        }

        let setTintNum = true;
        function setTintColor() {
            setTintNum = !setTintNum;
            return 0x000000;
        }

        function initTown() {
            const segments = 2;
            for (let i = 1; i < 100; i++) {
                const geometry = new THREE.BoxGeometry(1, 1, 1, segments, segments, segments);
                const material = new THREE.MeshStandardMaterial({
                    color: setTintColor(),
                    wireframe: false,
                    side: THREE.DoubleSide
                });
                const wmaterial = new THREE.MeshLambertMaterial({
                    color: 0xFFFFFF,
                    wireframe: true,
                    transparent: true,
                    opacity: 0.03,
                    side: THREE.DoubleSide
                });

                const cube = new THREE.Mesh(geometry, material);
                const floor = new THREE.Mesh(geometry, material);
                const wfloor = new THREE.Mesh(geometry, wmaterial);
                
                cube.add(wfloor);
                cube.castShadow = true;
                cube.receiveShadow = true;
                cube.rotationValue = 0.1 + Math.abs(mathRandom(8));
                
                floor.scale.y = 0.05;
                cube.scale.y = 0.1 + Math.abs(mathRandom(8));
                
                const cubeWidth = 0.9;
                cube.scale.x = cube.scale.z = cubeWidth + mathRandom(1 - cubeWidth);
                cube.position.x = Math.round(mathRandom());
                cube.position.z = Math.round(mathRandom());
                
                floor.position.set(cube.position.x, 0, cube.position.z);
                
                town.add(floor);
                town.add(cube);
            }

            const gmaterial = new THREE.MeshToonMaterial({color: 0xFFFF00, side: THREE.DoubleSide});
            const gparticular = new THREE.CircleGeometry(0.01, 3);
            const aparticular = 5;
            
            for (let h = 1; h < 300; h++) {
                const particular = new THREE.Mesh(gparticular, gmaterial);
                particular.position.set(mathRandom(aparticular), mathRandom(aparticular), mathRandom(aparticular));
                particular.rotation.set(mathRandom(), mathRandom(), mathRandom());
                smoke.add(particular);
            }
            
            const pmaterial = new THREE.MeshPhongMaterial({
                color: 0x000000,
                side: THREE.DoubleSide,
                roughness: 10,
                metalness: 0.6,
                transparent: true,
                opacity: 0.9
            });
            const pgeometry = new THREE.PlaneGeometry(60, 60);
            const pelement = new THREE.Mesh(pgeometry, pmaterial);
            pelement.rotation.x = -90 * Math.PI / 180;
            pelement.position.y = -0.001;
            pelement.receiveShadow = true;

            city.add(pelement);
        }

        const mouse = new THREE.Vector2();
        function onMouseMove(event) {
            const rect = container.getBoundingClientRect();
            mouse.x = ((event.clientX - rect.left) / rect.width) * 2 - 1;
            mouse.y = -((event.clientY - rect.top) / rect.height) * 2 + 1;
        }
        function onDocumentTouchStart(event) {
            if (event.touches.length === 1) {
                const rect = container.getBoundingClientRect();
                mouse.x = ((event.touches[0].clientX - rect.left) / rect.width) * 2 - 1;
                mouse.y = -((event.touches[0].clientY - rect.top) / rect.height) * 2 + 1;
            }
        }
        function onDocumentTouchMove(event) {
            if (event.touches.length === 1) {
                const rect = container.getBoundingClientRect();
                mouse.x = ((event.touches[0].clientX - rect.left) / rect.width) * 2 - 1;
                mouse.y = -((event.touches[0].clientY - rect.top) / rect.height) * 2 + 1;
            }
        }
        
        section.addEventListener('mousemove', onMouseMove, false);
        section.addEventListener('touchstart', onDocumentTouchStart, {passive: true});
        section.addEventListener('touchmove', onDocumentTouchMove, {passive: true});

        const ambientLight = new THREE.AmbientLight(0xFFFFFF, 4);
        const lightFront = new THREE.SpotLight(0xFFFFFF, 20, 10);
        const lightBack = new THREE.PointLight(0xFFFFFF, 0.5);

        lightFront.rotation.x = 45 * Math.PI / 180;
        lightFront.rotation.z = -45 * Math.PI / 180;
        lightFront.position.set(5, 5, 5);
        lightFront.castShadow = true;
        lightFront.shadow.mapSize.width = 6000;
        lightFront.shadow.mapSize.height = lightFront.shadow.mapSize.width;
        lightFront.penumbra = 0.1;
        lightBack.position.set(0, 6, 0);

        smoke.position.y = 2;

        scene.add(ambientLight);
        city.add(lightFront);
        scene.add(lightBack);
        scene.add(city);
        city.add(smoke);
        city.add(town);

        const gridHelper = new THREE.GridHelper(60, 120, 0xFF0000, 0x000000);
        city.add(gridHelper);

        const createCars = function(cScale = 2, cPos = 20, cColor = 0xFFFF00) {
            const cMat = new THREE.MeshToonMaterial({color: cColor, side: THREE.DoubleSide});
            const cGeo = new THREE.BoxGeometry(1, cScale / 40, cScale / 40);
            const cElem = new THREE.Mesh(cGeo, cMat);
            const cAmp = 3;
            
            if (createCarPos) {
                createCarPos = false;
                cElem.position.x = -cPos;
                cElem.position.z = (mathRandom(cAmp));
                gsap.to(cElem.position, {duration: 3, x: cPos, repeat: -1, yoyo: true, delay: mathRandom(3)});
            } else {
                createCarPos = true;
                cElem.position.x = (mathRandom(cAmp));
                cElem.position.z = -cPos;
                cElem.rotation.y = 90 * Math.PI / 180;
                gsap.to(cElem.position, {duration: 5, z: cPos, repeat: -1, yoyo: true, delay: mathRandom(3), ease: "power1.inOut"});
            }
            cElem.receiveShadow = true;
            cElem.castShadow = true;
            cElem.position.y = Math.abs(mathRandom(5));
            city.add(cElem);
        };

        const generateLines = function() {
            for (let i = 0; i < 60; i++) {
                createCars(0.1, 20);
            }
        };

        generateLines();
        initTown();

        let isCityVisible = false;
        const cityObserver = new IntersectionObserver((entries) => {
            isCityVisible = entries[0].isIntersecting;
        }, { threshold: 0 });
        cityObserver.observe(section);

        window.addEventListener('resize', () => {
            if (!container) return;
            width = container.clientWidth;
            height = container.clientHeight;
            camera.aspect = width / height;
            camera.updateProjectionMatrix();
            renderer.setSize(width, height);
        });

        const animate = function() {
            requestAnimationFrame(animate);
            if (!isCityVisible) return;
            
            city.rotation.y -= ((mouse.x * 8) - camera.rotation.y) * uSpeed;
            city.rotation.x -= (-(mouse.y * 2) - camera.rotation.x) * uSpeed;
            if (city.rotation.x < -0.05) city.rotation.x = -0.05;
            else if (city.rotation.x > 1) city.rotation.x = 1;
            
            smoke.rotation.y += 0.01;
            smoke.rotation.x += 0.01;
            
            camera.lookAt(city.position);
            renderer.render(scene, camera);  
        };
        animate();
    };

    initCity3D();

    // --- 7. Script The Vibe Configurator ---
    const vibeSlider = document.getElementById('vibe-slider');
    const vibeSection = document.getElementById('vibe-section');
    const vibeTitle = document.getElementById('vibe-title');
    const kontakSection = document.getElementById('kontak');
    const ctaCard = document.getElementById('cta-card');
    const ctaHeading = document.getElementById('cta-heading');
    const ctaDesc = document.getElementById('cta-desc');
    const vibeBtn = document.getElementById('vibe-btn');

    vibeSlider.addEventListener('input', (e) => {
        const val = parseInt(e.target.value);
        
        // Reset properti ke default sebelum menerapkan state khusus
        vibeTitle.style.textShadow = 'none';
        vibeTitle.style.letterSpacing = 'normal';
        vibeTitle.style.transform = 'scale(1)';
        ctaHeading.removeAttribute('data-text');

        if(val < 33) {
            // State 1: SAFE / CORPORATE
            vibeSection.style.backgroundColor = '#f8f9fa';
            vibeSection.style.color = '#333333';
            vibeTitle.innerText = "The Safe Zone.";
            vibeTitle.style.fontFamily = 'sans-serif';
            
            kontakSection.style.backgroundColor = '#e9ecef';
            ctaCard.className = "bg-white rounded-xl p-10 md:p-16 text-center shadow-md relative overflow-hidden border border-gray-200 transition-all duration-500 max-w-4xl mx-auto";
            ctaHeading.className = "text-3xl font-bold text-gray-800 mb-4";
            ctaHeading.style.fontFamily = 'sans-serif';
            ctaHeading.innerText = "Ready to Start?";
            ctaDesc.className = "text-gray-600 mb-8 font-sans text-base tracking-normal border-none bg-transparent p-0";
            ctaDesc.innerText = "Pendekatan standar yang teruji. Aman, fungsional, dan langsung pada tujuannya. Hubungi kami untuk berkonsultasi.";
            
            vibeBtn.className = "inline-block bg-blue-600 text-white font-semibold px-8 py-3 rounded hover:bg-blue-700 transition-colors shadow-none border-none relative z-10";
            vibeBtn.innerText = "Contact Us";

        } else if (val < 66) {
            // State 2: MODERN / ELEVATED
            vibeSection.style.backgroundColor = '#1a1a2e';
            vibeSection.style.color = '#ffffff';
            vibeTitle.innerText = "Modern & Elevated.";
            vibeTitle.style.fontFamily = "'Lobster', cursive";
            vibeTitle.style.transform = 'scale(1.1)';
            
            kontakSection.style.backgroundColor = '#1a1a2e';
            ctaCard.className = "bg-[#080815] rounded-3xl p-10 md:p-16 text-center shadow-[0_20px_50px_rgba(0,0,0,0.5)] relative overflow-hidden border border-white/10 transition-all duration-500 max-w-5xl mx-auto";
            ctaHeading.className = "text-4xl md:text-5xl font-normal text-[#9d00ff] mb-6";
            ctaHeading.style.fontFamily = "'Lobster', cursive";
            ctaHeading.innerText = "Elevate Your Presence";
            ctaDesc.className = "text-gray-300 mb-10 text-lg font-sans tracking-normal border-none bg-transparent p-0";
            ctaDesc.innerText = "Estetika premium dengan interaksi dinamis. Langkah pertama yang elegan untuk menonjol dari kompetitor Anda.";
            
            vibeBtn.className = "inline-block bg-white text-black font-bold px-10 py-4 rounded-full shadow-lg hover:bg-gray-200 transition-all hover:-translate-y-1 border-none relative z-10";
            vibeBtn.innerText = "Start Your Journey";

        } else {
            // State 3: DISRUPT / CHAOS 
            vibeSection.style.backgroundColor = '#000000';
            vibeSection.style.color = '#f9005b';
            vibeTitle.innerText = "PURE DISRUPTION.";
            vibeTitle.style.fontFamily = 'Impact, sans-serif';
            vibeTitle.style.transform = 'scale(1.2) rotate(-2deg)';
            
            kontakSection.style.backgroundColor = '#000000';
            
            ctaCard.className = "bg-gradient-to-br from-[#f9005b] via-[#9d00ff] to-[#ff0055] animate-gradient-xy tech-pattern-overlay rounded-3xl p-10 md:p-16 text-center shadow-[0_0_80px_rgba(249,0,91,0.6)] relative overflow-hidden transition-all duration-500 max-w-6xl mx-auto border border-white/20";
            
            ctaHeading.className = "text-5xl md:text-7xl font-black text-white uppercase tracking-tighter mb-6 transform -skew-x-6 relative z-10 drop-shadow-2xl";
            ctaHeading.style.fontFamily = 'Impact, sans-serif';
            ctaHeading.innerText = "LET'S CREATE CHAOS";
            
            ctaDesc.className = "text-white font-bold mb-10 text-xl tracking-widest uppercase border-none bg-transparent p-0 shadow-none relative z-10 drop-shadow-md";
            ctaDesc.innerText = "Lupakan aturan main. Kami bangun pengalaman digital radikal yang tak akan bisa diabaikan.";
            
            vibeBtn.className = "group relative inline-flex items-center justify-center bg-[#080815] text-[#f9005b] font-black text-2xl md:text-3xl px-12 py-6 overflow-hidden rounded-2xl transition-all hover:scale-110 shadow-[0_15px_30px_rgba(0,0,0,0.5)] border border-[#f9005b]/30 relative z-10";
            vibeBtn.innerHTML = "<span class='absolute inset-0 w-[120%] h-full bg-[#f9005b] transform -translate-x-full skew-x-12 group-hover:translate-x-[-10%] transition-transform duration-500 ease-out'></span><span class='relative z-10 group-hover:text-black transition-colors duration-300'>I WANT THIS CHAOS</span>";
        }
    });
});
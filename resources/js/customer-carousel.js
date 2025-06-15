document.addEventListener('DOMContentLoaded', function () {
    const groups = document.querySelectorAll('.carousel-group');
    let idx = 0;
    function showGroup(i) {
        groups.forEach((g, j) => {
            if (j === i) {
                g.style.display = 'flex';
                g.classList.remove('pop-up-animate');
                void g.offsetWidth;
                g.classList.add('pop-up-animate');
            } else {
                g.style.display = 'none';
                g.classList.remove('pop-up-animate');
            }
        });
        if(groups[i]) {
            groups[i].querySelectorAll('.customer-hover-scale').forEach((el) => {
                el.classList.remove('scale-0', 'opacity-0');
                el.classList.add('scale-100', 'opacity-100');
            });
        }
    }
    function nextGroup() {
        idx = (idx + 1) % groups.length;
        showGroup(idx);
    }
    if(groups.length) {
        showGroup(idx);
        let interval = setInterval(nextGroup, 2500);
        const carousel = document.getElementById('customer-carousel');
        if (carousel) {
            carousel.addEventListener('mouseenter', () => clearInterval(interval));
            carousel.addEventListener('mouseleave', () => interval = setInterval(nextGroup, 2500));
        }
    }
    if (!document.getElementById('customer-carousel-style')) {
        const style = document.createElement('style');
        style.id = 'customer-carousel-style';
        style.innerHTML = `
            .scale-0{transform:scale(0);opacity:0;}
            .scale-100{transform:scale(1);opacity:1;}
            .customer-hover-scale{transition:transform 0.3s, box-shadow 0.3s;}
            .customer-hover-scale:hover{transform:scale(1.08) !important; z-index:2; box-shadow:0 8px 24px 0 rgba(0,0,0,0.10);}
            .customer-img-greyscale{filter: grayscale(1); transition: filter 0.3s;}
            .customer-hover-scale:hover .customer-img-greyscale{filter: grayscale(0);}
            @keyframes popUpChunk {
                0% { transform: scale(0.7); opacity: 0; }
                60% { transform: scale(1.08); opacity: 1; }
                100% { transform: scale(1); opacity: 1; }
            }
            .pop-up-animate {
                animation: popUpChunk 0.5s cubic-bezier(0.4,0,0.2,1);
            }
        `;
        document.head.appendChild(style);
    }
});

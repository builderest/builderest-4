document.addEventListener('DOMContentLoaded', () => {
    const navToggle = document.querySelector('.nav-toggle');
    const nav = document.querySelector('.main-nav');
    if (navToggle && nav) {
        navToggle.addEventListener('click', () => {
            const expanded = navToggle.getAttribute('aria-expanded') === 'true';
            navToggle.setAttribute('aria-expanded', (!expanded).toString());
            nav.classList.toggle('open');
        });
    }

    const filterButtons = document.querySelectorAll('.filter-btn');
    const pricingCards = document.querySelectorAll('.pricing-card');
    filterButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            filterButtons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const category = btn.dataset.filter;
            pricingCards.forEach(card => {
                if (category === 'all' || card.dataset.category === category) {
                    card.classList.remove('hidden');
                } else {
                    card.classList.add('hidden');
                }
            });
            revealInitial(pricingCards);
        });
    });

    function revealInitial(cards) {
        cards.forEach((card, index) => {
            card.style.display = card.classList.contains('hidden') ? 'none' : (index < 3 ? 'block' : 'none');
        });
        updateSeeMore();
    }

    const seeMoreBtn = document.getElementById('pricing-see-more');
    if (seeMoreBtn) {
        revealInitial(pricingCards);
        seeMoreBtn.addEventListener('click', () => {
            const hidden = Array.from(pricingCards).filter(card => card.style.display === 'none' && !card.classList.contains('hidden'));
            hidden.slice(0, 3).forEach(card => {
                card.style.display = 'block';
            });
            updateSeeMore();
        });
    }

    function updateSeeMore() {
        if (!seeMoreBtn) return;
        const remaining = Array.from(pricingCards).filter(card => card.style.display === 'none' && !card.classList.contains('hidden'));
        if (remaining.length === 0) {
            seeMoreBtn.style.display = 'none';
        } else {
            seeMoreBtn.style.display = 'inline-flex';
        }
    }

    const accordion = document.querySelectorAll('[data-accordion] .accordion-item');
    accordion.forEach(item => {
        const trigger = item.querySelector('.accordion-trigger');
        const content = item.querySelector('.accordion-content');
        trigger?.addEventListener('click', () => {
            const expanded = trigger.getAttribute('aria-expanded') === 'true';
            trigger.setAttribute('aria-expanded', (!expanded).toString());
            if (!expanded) {
                content.style.maxHeight = content.scrollHeight + 'px';
            } else {
                content.style.maxHeight = '0px';
            }
        });
    });
});

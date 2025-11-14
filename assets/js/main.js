document.addEventListener('DOMContentLoaded', () => {
    const header = document.querySelector('[data-header]');
    const navToggle = document.querySelector('[data-nav-toggle]');
    const drawerOverlay = document.querySelector('[data-drawer-overlay]');
    const drawerClose = document.querySelector('[data-drawer-close]');
    const dropdownTriggers = document.querySelectorAll('[data-dropdown-trigger]');
    const drawerAccordionTriggers = document.querySelectorAll('[data-drawer-accordion]');

    const updateHeaderState = () => {
        if (!header) return;
        const shouldBeSolid = window.scrollY > 32;
        header.classList.toggle('is-solid', shouldBeSolid);
    };

    updateHeaderState();
    window.addEventListener('scroll', updateHeaderState, { passive: true });

    const openDrawer = () => {
        document.body.classList.add('drawer-open');
        navToggle?.setAttribute('aria-expanded', 'true');
    };

    const closeDrawer = () => {
        document.body.classList.remove('drawer-open');
        navToggle?.setAttribute('aria-expanded', 'false');
        drawerAccordionTriggers.forEach(trigger => {
            trigger.setAttribute('aria-expanded', 'false');
            const parent = trigger.closest('.drawer-item');
            parent?.classList.remove('open');
            const panel = trigger.nextElementSibling;
            if (panel instanceof HTMLElement) {
                panel.style.maxHeight = '0px';
            }
        });
    };

    navToggle?.addEventListener('click', () => {
        const expanded = navToggle.getAttribute('aria-expanded') === 'true';
        expanded ? closeDrawer() : openDrawer();
    });

    drawerClose?.addEventListener('click', closeDrawer);
    drawerOverlay?.addEventListener('click', closeDrawer);

    const closeDropdown = (item) => {
        if (!item) return;
        item.classList.remove('open');
        const button = item.querySelector('[data-dropdown-trigger]');
        button?.setAttribute('aria-expanded', 'false');
    };

    const closeAllDropdowns = (except) => {
        dropdownTriggers.forEach(trigger => {
            const parent = trigger.closest('.has-dropdown');
            if (parent && parent !== except) {
                closeDropdown(parent);
            }
        });
    };

    document.addEventListener('keydown', (event) => {
        if (event.key !== 'Escape') return;
        if (document.body.classList.contains('drawer-open')) {
            closeDrawer();
        }
        closeAllDropdowns();
    });

    drawerAccordionTriggers.forEach(trigger => {
        const parent = trigger.closest('.drawer-item');
        const panel = trigger.nextElementSibling;
        trigger.addEventListener('click', () => {
            const expanded = trigger.getAttribute('aria-expanded') === 'true';
            trigger.setAttribute('aria-expanded', (!expanded).toString());
            parent?.classList.toggle('open', !expanded);
            if (panel instanceof HTMLElement) {
                panel.style.maxHeight = expanded ? '0px' : `${panel.scrollHeight}px`;
            }
        });
    });

    dropdownTriggers.forEach(trigger => {
        const parent = trigger.closest('.has-dropdown');
        if (!parent) return;
        trigger.addEventListener('click', (event) => {
            event.preventDefault();
            const isOpen = parent.classList.contains('open');
            closeAllDropdowns(isOpen ? parent : null);
            parent.classList.toggle('open', !isOpen);
            trigger.setAttribute('aria-expanded', (!isOpen).toString());
        });

        parent.addEventListener('mouseenter', () => {
            if (window.matchMedia('(min-width: 980px)').matches) {
                closeAllDropdowns(parent);
                parent.classList.add('open');
                trigger.setAttribute('aria-expanded', 'true');
            }
        });

        parent.addEventListener('mouseleave', () => {
            if (window.matchMedia('(min-width: 980px)').matches) {
                closeDropdown(parent);
            }
        });
    });

    document.addEventListener('click', (event) => {
        const target = event.target;
        if (!(target instanceof Node)) return;
        dropdownTriggers.forEach(trigger => {
            const parent = trigger.closest('.has-dropdown');
            if (parent && !parent.contains(target)) {
                closeDropdown(parent);
            }
        });
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth >= 980) {
            closeDrawer();
        }
    });

    const filterButtons = document.querySelectorAll('.filter-btn');
    const pricingCards = document.querySelectorAll('.pricing-card');
    const seeMoreBtn = document.getElementById('pricing-see-more');

    const updateSeeMore = () => {
        if (!seeMoreBtn) return;
        const remaining = Array.from(pricingCards).filter(card => {
            return card.style.display === 'none' && !card.classList.contains('hidden');
        });
        seeMoreBtn.style.display = remaining.length === 0 ? 'none' : 'inline-flex';
    };

    const revealInitial = () => {
        let visibleCount = 0;
        pricingCards.forEach(card => {
            if (card.classList.contains('hidden')) {
                card.style.display = 'none';
                return;
            }
            if (visibleCount < 3) {
                card.style.display = '';
                visibleCount += 1;
            } else {
                card.style.display = 'none';
            }
        });
        updateSeeMore();
    };

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
            revealInitial();
        });
    });

    if (seeMoreBtn) {
        revealInitial();
        seeMoreBtn.addEventListener('click', () => {
            const hidden = Array.from(pricingCards).filter(card => {
                return card.style.display === 'none' && !card.classList.contains('hidden');
            });
            hidden.slice(0, 3).forEach(card => {
                card.style.display = '';
            });
            updateSeeMore();
        });
    }

    const accordionItems = document.querySelectorAll('[data-accordion] .accordion-item');
    accordionItems.forEach(item => {
        const trigger = item.querySelector('.accordion-trigger');
        const content = item.querySelector('.accordion-content');
        trigger?.addEventListener('click', () => {
            const expanded = trigger.getAttribute('aria-expanded') === 'true';
            trigger.setAttribute('aria-expanded', (!expanded).toString());
            if (content instanceof HTMLElement) {
                content.style.maxHeight = expanded ? '0px' : `${content.scrollHeight}px`;
            }
        });
    });
});

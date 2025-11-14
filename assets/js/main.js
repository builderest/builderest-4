document.addEventListener('DOMContentLoaded', () => {
    const header = document.querySelector('[data-header]');
    const navToggle = document.querySelector('[data-nav-toggle]');
    const drawerOverlay = document.querySelector('[data-drawer-overlay]');
    const drawerClose = document.querySelector('[data-drawer-close]');
    const dropdownTriggers = document.querySelectorAll('[data-dropdown-trigger]');
    const drawerAccordionTriggers = document.querySelectorAll('[data-drawer-accordion]');
    const dropdownTimers = new WeakMap();

    const isDesktop = () => window.matchMedia('(min-width: 980px)').matches;

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

    const clearDropdownTimer = (item) => {
        if (!item) return;
        const timer = dropdownTimers.get(item);
        if (timer) {
            clearTimeout(timer);
            dropdownTimers.delete(item);
        }
    };

    const closeDropdown = (item) => {
        if (!item) return;
        clearDropdownTimer(item);
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
        const dropdownPanel = parent.querySelector('.dropdown');

        const scheduleClose = () => {
            if (!isDesktop()) return;
            clearDropdownTimer(parent);
            const timer = window.setTimeout(() => {
                closeDropdown(parent);
            }, 220);
            dropdownTimers.set(parent, timer);
        };

        trigger.addEventListener('click', (event) => {
            event.preventDefault();
            const isOpen = parent.classList.contains('open');
            closeAllDropdowns(isOpen ? parent : null);
            parent.classList.toggle('open', !isOpen);
            trigger.setAttribute('aria-expanded', (!isOpen).toString());
        });

        parent.addEventListener('mouseenter', () => {
            if (!isDesktop()) return;
            clearDropdownTimer(parent);
            closeAllDropdowns(parent);
            parent.classList.add('open');
            trigger.setAttribute('aria-expanded', 'true');
        });

        parent.addEventListener('mouseleave', () => {
            scheduleClose();
        });

        dropdownPanel?.addEventListener('mouseenter', () => {
            clearDropdownTimer(parent);
        });

        dropdownPanel?.addEventListener('mouseleave', () => {
            scheduleClose();
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
    const pricingCards = Array.from(document.querySelectorAll('.pricing-card'));
    const seeMoreBtn = document.getElementById('pricing-see-more');
    const PRICING_BATCH = 4;
    let visiblePricingCount = PRICING_BATCH;

    const showPricingCard = (card) => {
        card.style.display = '';
        card.classList.remove('is-visible');
        requestAnimationFrame(() => {
            requestAnimationFrame(() => {
                card.classList.add('is-visible');
            });
        });
    };

    const hidePricingCard = (card) => {
        card.classList.remove('is-visible');
        card.style.display = 'none';
    };

    const applyPricingVisibility = () => {
        const activeCards = pricingCards.filter(card => !card.classList.contains('is-filtered'));
        pricingCards.forEach(card => {
            if (card.classList.contains('is-filtered')) {
                hidePricingCard(card);
            }
        });
        activeCards.forEach((card, index) => {
            if (index < visiblePricingCount) {
                showPricingCard(card);
            } else {
                hidePricingCard(card);
            }
        });
        if (seeMoreBtn) {
            seeMoreBtn.style.display = activeCards.length > visiblePricingCount ? 'inline-flex' : 'none';
        }
    };

    filterButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            filterButtons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const category = btn.dataset.filter;
            pricingCards.forEach(card => {
                const matches = category === 'all' || card.dataset.category === category;
                card.classList.toggle('is-filtered', !matches);
            });
            visiblePricingCount = PRICING_BATCH;
            applyPricingVisibility();
        });
    });

    if (seeMoreBtn) {
        applyPricingVisibility();
        seeMoreBtn.addEventListener('click', () => {
            const activeCards = pricingCards.filter(card => !card.classList.contains('is-filtered'));
            visiblePricingCount = Math.min(activeCards.length, visiblePricingCount + PRICING_BATCH);
            applyPricingVisibility();
        });
    } else if (pricingCards.length) {
        applyPricingVisibility();
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

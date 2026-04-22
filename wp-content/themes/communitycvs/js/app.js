document.addEventListener('click', (event) => {
    const toggle = event.target.closest('.accordion .accordion-toggle');
    if (!toggle) return;

    event.preventDefault();

    const section = toggle.closest('.accordion-section');
    if (!section) return;

    const contentId = toggle.getAttribute('aria-controls');
    const content = contentId ? document.getElementById(contentId) : section.querySelector('.text');

    const isOpen = section.classList.toggle('is-open');
    toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    if (content) content.hidden = !isOpen;
});

function toggleTeamMember(member) {
    const bio = member.querySelector('.bio');
    if (!bio) return;

    const isOpen = member.classList.toggle('is-open');
    member.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    bio.hidden = !isOpen;
}

document.addEventListener('click', (event) => {
    const member = event.target.closest('.team .team-member');
    if (!member) return;
    if (event.target.closest('a')) return;

    toggleTeamMember(member);
});

document.addEventListener('keydown', (event) => {
    if (event.key !== 'Enter' && event.key !== ' ') return;

    const member = event.target.closest('.team .team-member');
    if (!member) return;

    event.preventDefault();
    toggleTeamMember(member);
});

function positionMegamenu(menuItem) {
    const submenu = menuItem.querySelector(':scope > .sub-menu.megamenu');
    if (!submenu) return;

    const navBottom = menuItem.closest('.nav-bottom');
    if (!navBottom) return;

    const parentLink = menuItem.querySelector(':scope > a');
    if (!parentLink) return;

    const container = navBottom.closest('.inner') || navBottom;
    const navRect = navBottom.getBoundingClientRect();
    const linkRect = parentLink.getBoundingClientRect();
    const containerRect = container.getBoundingClientRect();

    const columnsRaw = submenu.style.getPropertyValue('--megamenu-columns');
    const columns = Math.max(1, parseInt(columnsRaw, 10) || 1);

    const maxWidth = 923;
    const minWidth = 273;
    const paddingX = 24 * 2;
    const columnMax = 185;
    const gap = 36;

    const contentWidth = paddingX + (columns * columnMax) + ((columns - 1) * gap);
    const desiredWidth = columns >= 4 ? maxWidth : Math.min(Math.max(minWidth, contentWidth), maxWidth);
    const offsetLeft = linkRect.left - navRect.left;

    let width = Math.min(desiredWidth, maxWidth, containerRect.width);
    if (width < minWidth) {
        width = Math.min(minWidth, containerRect.width);
    }

    let left = offsetLeft;
    const minLeft = containerRect.left - navRect.left;
    const maxLeft = (containerRect.right - navRect.left) - width;
    left = Math.max(minLeft, Math.min(left, maxLeft));

    submenu.style.left = `${Math.round(left)}px`;
    submenu.style.width = `${Math.round(width)}px`;
}

function bindMegamenus() {
    const megamenuItems = document.querySelectorAll('.nav-bottom .main-menu > li.has-megamenu');
    if (!megamenuItems.length) return;

    megamenuItems.forEach((item) => {
        let closeTimer = null;

        const submenu = item.querySelector(':scope > .sub-menu.megamenu');

        const open = () => {
            if (closeTimer) {
                window.clearTimeout(closeTimer);
                closeTimer = null;
            }
            positionMegamenu(item);
            item.classList.add('is-open');
        };

        const close = () => {
            if (closeTimer) window.clearTimeout(closeTimer);
            closeTimer = window.setTimeout(() => {
                item.classList.remove('is-open');
            }, 180);
        };

        item.addEventListener('mouseenter', open);
        item.addEventListener('focusin', open);
        item.addEventListener('mouseleave', close);
        item.addEventListener('focusout', close);

        if (submenu) {
            submenu.addEventListener('mouseenter', open);
            submenu.addEventListener('mouseleave', close);
        }
    });

    window.addEventListener('resize', () => {
        megamenuItems.forEach((item) => {
            if (item.classList.contains('is-open')) positionMegamenu(item);
        });
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', bindMegamenus);
} else {
    bindMegamenus();
}

function initHomeCarousel() {
    const carousel = document.querySelector('[data-home-carousel]');
    if (!carousel) return;

    const track = carousel.querySelector('.home-carousel-track');
    const slides = carousel.querySelectorAll('.home-carousel-slide');
    const dotsWrap = carousel.querySelector('.home-carousel-dots');
    if (!track || !slides.length || !dotsWrap) return;

    let index = 0;
    let timer = null;

    const setIndex = (nextIndex) => {
        index = (nextIndex + slides.length) % slides.length;
        track.style.transform = `translateX(-${index * 100}%)`;
        dotsWrap.querySelectorAll('button').forEach((btn, i) => {
            btn.setAttribute('aria-selected', i === index ? 'true' : 'false');
            btn.tabIndex = i === index ? 0 : -1;
        });
    };

    const stop = () => {
        if (!timer) return;
        window.clearInterval(timer);
        timer = null;
    };

    const start = () => {
        stop();
        timer = window.setInterval(() => setIndex(index + 1), 7000);
    };

    dotsWrap.innerHTML = '';
    slides.forEach((_, i) => {
        const button = document.createElement('button');
        button.type = 'button';
        button.className = 'home-carousel-dot';
        button.setAttribute('role', 'tab');
        button.setAttribute('aria-label', `Go to slide ${i + 1}`);
        button.addEventListener('click', () => {
            setIndex(i);
            start();
        });
        dotsWrap.appendChild(button);
    });

    carousel.addEventListener('mouseenter', stop);
    carousel.addEventListener('mouseleave', start);
    carousel.addEventListener('focusin', stop);
    carousel.addEventListener('focusout', start);

    track.style.display = 'flex';
    track.style.transition = 'transform 500ms ease';
    slides.forEach((slide) => {
        slide.style.flex = '0 0 100%';
    });

    setIndex(0);
    if (slides.length > 1) start();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initHomeCarousel);
} else {
    initHomeCarousel();
}

function initNewsArchiveLoadMore() {
    const archive = document.querySelector('[data-news-archive]');
    const button = archive ? archive.querySelector('.js-news-load-more') : null;
    const grid = document.querySelector('[data-news-grid]');
    const config = window.communitycvsNewsArchive;

    if (!archive || !button || !grid || !config || !config.ajaxUrl || !config.nonce) return;

    let isLoading = false;

    const setLoadingState = (loading) => {
        isLoading = loading;
        button.setAttribute('aria-disabled', loading ? 'true' : 'false');
        button.style.pointerEvents = loading ? 'none' : '';
        button.textContent = loading ? 'Loading...' : 'Load More';
    };

    button.addEventListener('click', async (event) => {
        event.preventDefault();
        if (isLoading) return;

        const nextPage = parseInt(archive.dataset.nextPage || '2', 10);
        if (!nextPage || Number.isNaN(nextPage)) return;

        setLoadingState(true);

        try {
            const body = new URLSearchParams();
            body.set('action', 'communitycvs_load_more_news');
            body.set('nonce', config.nonce);
            body.set('page', String(nextPage));

            const response = await fetch(config.ajaxUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
                },
                body: body.toString(),
            });

            const data = await response.json();
            if (!data || !data.success || !data.data) {
                setLoadingState(false);
                return;
            }

            if (data.data.html) {
                grid.insertAdjacentHTML('beforeend', data.data.html);
                document.dispatchEvent(new CustomEvent('communitycvs:news-tiles-updated'));
            }
            archive.dataset.nextPage = String(data.data.nextPage || (nextPage + 1));

            if (!data.data.hasMore) {
                archive.remove();
            } else {
                setLoadingState(false);
            }
        } catch (error) {
            setLoadingState(false);
        }
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initNewsArchiveLoadMore);
} else {
    initNewsArchiveLoadMore();
}

function initNewsArchiveFilter() {
    const filter = document.getElementById('news-category-filter');
    const grid = document.querySelector('[data-news-grid]');
    if (!filter || !grid) return;

    const applyFilter = () => {
        const selectedCategory = filter.value.trim();
        const tiles = grid.querySelectorAll('.news-tile');

        tiles.forEach((tile) => {
            const categoryList = (tile.dataset.newsCategories || '')
                .split(',')
                .map((item) => item.trim())
                .filter(Boolean);
            const shouldShow = !selectedCategory || categoryList.includes(selectedCategory);
            tile.style.display = shouldShow ? '' : 'none';
            tile.setAttribute('aria-hidden', shouldShow ? 'false' : 'true');
        });
    };

    filter.addEventListener('change', applyFilter);
    document.addEventListener('communitycvs:news-tiles-updated', applyFilter);
    applyFilter();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initNewsArchiveFilter);
} else {
    initNewsArchiveFilter();
}

document.addEventListener('click', (event) => {
    const tile = event.target.closest('.news-tile');
    if (!tile) return;

    // Keep default behaviour when the click is already on a link/button/control.
    if (event.target.closest('a, button, input, select, textarea, label')) return;

    const readMoreLink = tile.querySelector('.link-button a');
    if (!readMoreLink) return;

    readMoreLink.click();
});

document.addEventListener('click', (event) => {
    const tile = event.target.closest('.illustrated-link-tiles .tile');
    if (!tile) return;

    // Keep default behaviour when the click is already on a link/button/control.
    if (event.target.closest('a, button, input, select, textarea, label')) return;

    const tileLink = tile.querySelector('.link-button a');
    if (!tileLink) return;

    tileLink.click();
});

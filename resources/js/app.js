import './bootstrap';
import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import collapse from '@alpinejs/collapse';

Alpine.plugin(focus);
Alpine.plugin(collapse);
window.Alpine = Alpine;

const revealState = {
    revealObserver: null,
    cardRevealObserver: null,
};

document.addEventListener('alpine:init', () => {
    const programPreviewTranslations = {
        en: {
            objectiveLabel: 'Objective',
            programLabel: 'Program',
            projectsButton: 'Know more about the projects',
            donateButton: 'Donate now',
        },
        fr: {
            objectiveLabel: 'Objectif',
            programLabel: 'Programme',
            projectsButton: 'En savoir plus sur les projets',
            donateButton: 'Faire un don',
        },
    };

    const getPageLangKey = () => window.location.pathname;
    const getStoredPageLang = (pageKey, fallback = 'en') => {
        return Alpine.store('bilingualForms').currentPageLang[pageKey] ?? fallback;
    };
    const persistPageLang = (pageKey, value) => {
        Alpine.store('bilingualForms').currentPageLang[pageKey] = value;
    };
    const bindPageLang = (component) => {
        const pageKey = getPageLangKey();

        component.lang = getStoredPageLang(pageKey, component.lang ?? 'en');

        component.$watch('lang', (value) => {
            persistPageLang(pageKey, value);
        });

        document.addEventListener('gt-lang:change', (event) => {
            if (event.detail?.pageKey === pageKey) {
                component.lang = event.detail.lang;
            }
        });
    };

    Alpine.store('bilingualForms', {
        currentPageLang: {},
    });

    Alpine.data('bilingualForm', (initialState = {}) => ({
        ...initialState,
        lang: initialState.lang ?? 'en',

        init() {
            bindPageLang(this);
        },
    }));

    Alpine.data('programForm', (initialState = {}) => ({
        lang: initialState.lang ?? 'en',
        title: initialState.title ?? '',
        titleFr: initialState.titleFr ?? '',
        description: initialState.description ?? '',
        descriptionFr: initialState.descriptionFr ?? '',
        fullDescription: initialState.fullDescription ?? '',
        fullDescriptionFr: initialState.fullDescriptionFr ?? '',
        imageUrl: initialState.imageUrl ?? '',
        previewImage: initialState.previewImage ?? '',
        defaultPreviewImage: initialState.previewImage ?? '',
        fallbackImage: initialState.fallbackImage ?? '',

        init() {
            bindPageLang(this);
        },

        get previewTitle() {
            const localized = this.lang === 'fr' ? this.titleFr : this.title;
            return localized || this.title || this.titleFr || 'Program Title';
        },

        get previewObjective() {
            const localized = this.lang === 'fr' ? this.descriptionFr : this.description;
            return localized || this.description || this.descriptionFr || 'Objective text will appear here.';
        },

        get previewProgramText() {
            const localized = this.lang === 'fr' ? this.fullDescriptionFr : this.fullDescription;
            return localized || this.fullDescription || this.fullDescriptionFr || 'Program text will appear here.';
        },

        get previewImageSrc() {
            return this.previewImage || this.defaultPreviewImage || this.fallbackImage;
        },

        get previewLabels() {
            return programPreviewTranslations[this.lang] || programPreviewTranslations.en;
        },

        updatePreviewImageFromUrl(value) {
            this.imageUrl = value;
            this.previewImage = value?.trim() ? value.trim() : this.defaultPreviewImage;
        },

        handlePreviewImage(event) {
            const [file] = event.target.files || [];

            if (!file) {
                this.previewImage = this.imageUrl?.trim() ? this.imageUrl.trim() : this.defaultPreviewImage;
                return;
            }

            const reader = new FileReader();
            reader.onload = ({ target }) => {
                this.previewImage = target?.result || this.defaultPreviewImage;
            };
            reader.readAsDataURL(file);
        },
    }));
});

const programPreviewTranslations = {
    en: {
        objectiveLabel: 'Objective',
        programLabel: 'Program',
        projectsButton: 'Know more about the projects',
        donateButton: 'Donate now',
        titleFallback: 'Program Title',
        objectiveFallback: 'Objective text will appear here.',
        programFallback: 'Program text will appear here.',
    },
    fr: {
        objectiveLabel: 'Objectif',
        programLabel: 'Programme',
        projectsButton: 'En savoir plus sur les projets',
        donateButton: 'Faire un don',
        titleFallback: 'Titre du programme',
        objectiveFallback: "Le texte de l'objectif apparaitra ici.",
        programFallback: 'Le texte du programme apparaîtra ici.',
    },
};

function getLanguageTabValue(tab) {
    return tab.dataset.lang || tab.textContent.trim().toLowerCase();
}

function getLanguageScope(tab) {
    return tab.closest('#admin-main-content') || document;
}

function isLanguageExpression(expression) {
    return /(?:\$root\.)?(?:lang|gLang|addLang)\s*===/.test(expression);
}

function expressionMatchesLanguage(expression, lang) {
    const normalized = expression.replace(/\s+/g, ' ');

    return new RegExp(`(?:\\$root\\.)?(?:lang|gLang|addLang)\\s*===\\s*['"]${lang}['"]`).test(normalized);
}

function updateProgramPreviewFallback(scope, lang) {
    const labels = programPreviewTranslations[lang] || programPreviewTranslations.en;

    scope.querySelectorAll('form[data-program-form-state]').forEach((form) => {
        const getValue = (name) => form.querySelector(`[name="${name}"]`)?.value?.trim() || '';
        const title = lang === 'fr' ? getValue('title_fr') : getValue('title');
        const objective = lang === 'fr' ? getValue('description_fr') : getValue('description');
        const programText = lang === 'fr' ? getValue('full_description_fr') : getValue('full_description');

        form.querySelectorAll('[data-program-preview="title"]').forEach((element) => {
            element.textContent = title || getValue('title') || getValue('title_fr') || labels.titleFallback;
        });

        form.querySelectorAll('[data-program-preview="objective"]').forEach((element) => {
            element.textContent = objective || getValue('description') || getValue('description_fr') || labels.objectiveFallback;
        });

        form.querySelectorAll('[data-program-preview="program"]').forEach((element) => {
            element.textContent = programText || getValue('full_description') || getValue('full_description_fr') || labels.programFallback;
        });

        form.querySelectorAll('[data-program-preview-label]').forEach((element) => {
            const labelKey = element.dataset.programPreviewLabel;
            element.textContent = labels[labelKey] || element.textContent;
        });
    });
}

function applyLanguageTabs(scope = document, lang = null) {
    const activeLang = lang || window.Alpine?.store('bilingualForms')?.currentPageLang?.[window.location.pathname] || 'en';

    scope.querySelectorAll('.lang-tabs').forEach((tabs) => {
        tabs.querySelectorAll('.lang-tab').forEach((tab) => {
            tab.classList.toggle('active', getLanguageTabValue(tab) === activeLang);
        });
    });

    scope.querySelectorAll('[x-show]').forEach((element) => {
        const expression = element.getAttribute('x-show') || '';

        if (!isLanguageExpression(expression)) {
            return;
        }

        const shouldShow = expressionMatchesLanguage(expression, activeLang);
        element.removeAttribute('x-cloak');
        element.hidden = !shouldShow;
        element.style.display = shouldShow ? '' : 'none';
    });

    updateProgramPreviewFallback(scope, activeLang);
}

window.switchGTLang = (lang) => {
    const pageKey = window.location.pathname;

    if (window.Alpine?.store('bilingualForms')) {
        window.Alpine.store('bilingualForms').currentPageLang[pageKey] = lang;
    }

    document.dispatchEvent(new CustomEvent('gt-lang:change', {
        detail: { pageKey, lang },
    }));

    applyLanguageTabs(document.querySelector('#admin-main-content') || document, lang);
};

function initializeRevealAnimations(root = document) {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches || !('IntersectionObserver' in window)) {
        return;
    }

    if (!revealState.revealObserver) {
        revealState.revealObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-revealed');
                } else {
                    entry.target.classList.remove('is-revealed');
                }
            });
        }, { threshold: 0.15, rootMargin: '0px 0px -60px 0px' });
    }

    if (!revealState.cardRevealObserver) {
        revealState.cardRevealObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-card-revealed');
                    revealState.cardRevealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });
    }

    root.querySelectorAll('[data-reveal]').forEach((el) => revealState.revealObserver.observe(el));
    root.querySelectorAll('[data-reveal-card]').forEach((el) => revealState.cardRevealObserver.observe(el));
}

function createScriptNode(sourceScript) {
    const script = document.createElement('script');

    for (const { name, value } of sourceScript.attributes) {
        script.setAttribute(name, value);
    }

    if (!sourceScript.src) {
        script.textContent = sourceScript.textContent;
    }

    return script;
}

function extractScripts(container) {
    return Array.from(container.querySelectorAll('script')).map((script) => {
        const clone = script.cloneNode(true);
        script.remove();
        return clone;
    });
}

async function runScripts(scripts) {
    for (const sourceScript of scripts) {
        const script = createScriptNode(sourceScript);

        await new Promise((resolve) => {
            if (script.src) {
                script.onload = () => resolve();
                script.onerror = () => resolve();
            } else {
                resolve();
            }

            document.body.appendChild(script);

            if (!script.src) {
                script.remove();
            }
        });
    }
}

function initializeAdminShell() {
    const shell = document.querySelector('[data-admin-shell]');

    if (!shell || shell.dataset.adminShellInitialized === 'true') {
        return;
    }

    shell.dataset.adminShellInitialized = 'true';

    // Many admin pages register `document.addEventListener('DOMContentLoaded', ...)`
    // to run their own setup (Chart.js init, search filters, etc). The shell fires a
    // synthetic DOMContentLoaded after every SPA navigation so that pattern still
    // works — but without tracking, those listeners pile up on `document`/`window`
    // forever, so every later navigation re-runs every previous page's setup against
    // whatever DOM happens to exist (duplicate Chart.js instances, "reading
    // addEventListener of null" for elements that only exist on the old page, etc).
    // We track listeners added *while a fragment's own scripts are running* and
    // release the previous navigation's batch before the next one starts.
    let pageOwnedListeners = [];

    const releasePageOwnedListeners = () => {
        pageOwnedListeners.forEach(({ target, type, listener, options }) => {
            target.removeEventListener(type, listener, options);
        });
        pageOwnedListeners = [];
    };

    const runScriptsTrackingGlobalListeners = async (scripts) => {
        const origDocAdd = document.addEventListener.bind(document);
        const origWinAdd = window.addEventListener.bind(window);

        document.addEventListener = (type, listener, options) => {
            pageOwnedListeners.push({ target: document, type, listener, options });
            return origDocAdd(type, listener, options);
        };
        window.addEventListener = (type, listener, options) => {
            pageOwnedListeners.push({ target: window, type, listener, options });
            return origWinAdd(type, listener, options);
        };

        try {
            await runScripts(scripts);
        } finally {
            document.addEventListener = origDocAdd;
            window.addEventListener = origWinAdd;
        }
    };

    const selectors = {
        nav: '#admin-sidebar-nav',
        header: '#admin-page-header',
        flash: '#admin-flash-messages',
        main: '#admin-main-content',
        styles: '#admin-dynamic-styles',
        scripts: '#admin-page-scripts',
    };

    const state = {
        currentUrl: window.location.href,
        pendingRequest: null,
    };

    const getShellNode = (key) => document.querySelector(selectors[key]);

    const setLoading = (isLoading) => {
        shell.classList.toggle('admin-shell-loading', isLoading);
        getShellNode('main')?.classList.toggle('admin-main-loading', isLoading);
    };

    const isEligibleLink = (link) => {
        if (!link || !link.matches('[data-admin-nav]')) return false;
        if (link.target && link.target !== '_self') return false;
        if (link.hasAttribute('download')) return false;
        if (link.getAttribute('href') === '#') return false;

        const url = new URL(link.href, window.location.origin);
        return url.origin === window.location.origin;
    };

    const initializeFragment = (element) => {
        if (!element) return;
        window.Alpine?.initTree?.(element);
        applyLanguageTabs(element);
        initializeRevealAnimations(element);
    };

    const swapFragment = async (currentNode, nextNode) => {
        if (!currentNode || !nextNode) return;

        const clonedNode = nextNode.cloneNode(true);
        const scripts = extractScripts(clonedNode);
        currentNode.innerHTML = clonedNode.innerHTML;

        // Run this fragment's own inline scripts (e.g. a page defining an Alpine
        // component function) before Alpine scans it — otherwise x-data="foo()"
        // fails with "foo is not defined" because the swap happens via fetch,
        // not a normal top-to-bottom document parse.
        await runScriptsTrackingGlobalListeners(scripts);

        initializeFragment(currentNode);
    };

    const applyDocument = async (nextDocument, url, pushState = true) => {
        const nextMain = nextDocument.querySelector(selectors.main);

        if (!nextMain) {
            window.location.href = url;
            return;
        }

        // Tear down whatever the page we're leaving registered on document/window
        // before the next page's scripts get a chance to register their own.
        releasePageOwnedListeners();

        await swapFragment(getShellNode('nav'), nextDocument.querySelector(selectors.nav));
        await swapFragment(getShellNode('header'), nextDocument.querySelector(selectors.header));
        await swapFragment(getShellNode('flash'), nextDocument.querySelector(selectors.flash));
        await swapFragment(getShellNode('styles'), nextDocument.querySelector(selectors.styles));
        await swapFragment(getShellNode('main'), nextMain);
        await swapFragment(getShellNode('scripts'), nextDocument.querySelector(selectors.scripts));

        document.title = nextDocument.title;

        if (pushState) {
            window.history.pushState({ adminShell: true, url }, '', url);
        } else {
            window.history.replaceState({ adminShell: true, url }, '', url);
        }

        state.currentUrl = url;

        document.dispatchEvent(new Event('DOMContentLoaded'));
        document.dispatchEvent(new CustomEvent('admin:navigation:end', {
            detail: { url },
        }));
    };

    const navigate = async (url, { pushState = true } = {}) => {
        if (state.pendingRequest || url === state.currentUrl) {
            return;
        }

        state.pendingRequest = url;
        setLoading(true);

        try {
            const response = await fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-Admin-Shell': '1',
                },
                credentials: 'same-origin',
            });

            if (!response.ok) {
                throw new Error(`Navigation failed with status ${response.status}`);
            }

            const html = await response.text();
            const nextDocument = new DOMParser().parseFromString(html, 'text/html');

            await applyDocument(nextDocument, url, pushState);
        } catch (error) {
            window.location.href = url;
        } finally {
            state.pendingRequest = null;
            setLoading(false);
        }
    };

    document.addEventListener('click', (event) => {
        const link = event.target.closest('a');

        if (
            event.defaultPrevented ||
            event.button !== 0 ||
            event.metaKey ||
            event.ctrlKey ||
            event.shiftKey ||
            event.altKey ||
            !isEligibleLink(link)
        ) {
            return;
        }

        const url = new URL(link.href, window.location.origin);

        if (url.href === state.currentUrl) {
            return;
        }

        event.preventDefault();
        navigate(url.href);
    });

    window.addEventListener('popstate', () => {
        if (window.location.href === state.currentUrl) {
            return;
        }

        navigate(window.location.href, { pushState: false });
    });
}

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    initializeRevealAnimations(document);
    applyLanguageTabs(document);
    initializeAdminShell();
});

document.addEventListener('click', (event) => {
    const tab = event.target.closest('.lang-tab');

    if (!tab) {
        return;
    }

    const lang = getLanguageTabValue(tab);

    if (!['en', 'fr'].includes(lang)) {
        return;
    }

    applyLanguageTabs(getLanguageScope(tab), lang);
});

document.addEventListener('input', (event) => {
    const form = event.target.closest('form[data-program-form-state]');

    if (!form) {
        return;
    }

    applyLanguageTabs(form.closest('#admin-main-content') || form);
});

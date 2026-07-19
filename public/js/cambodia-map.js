document.addEventListener('DOMContentLoaded', () => {
    const mapRoot = document.querySelector('.js-cambodia-map-card') || document.querySelector('.cambodia-map-card');
    if (!mapRoot) return;

    const mapStage = mapRoot.querySelector('.js-map-stage');
    const markersRoot = mapRoot.querySelector('.js-map-markers');
    const locationListRoot = mapRoot.querySelector('.js-map-location-list');
    const tooltipRoot = mapRoot.querySelector('.js-map-tooltip');
    const legendButtons = Array.from(mapRoot.querySelectorAll('.js-map-legend-button'));

    const categories = {
        child_welfare: {
            label: 'Child Welfare structures',
            badge: 'Child Welfare',
        },
        outside_cases: {
            label: 'Outside cases',
            badge: 'Outside cases',
        },
        deaf_blind_school: {
            label: 'School for deaf or blind children',
            badge: 'Deaf/Blind School',
        },
        arts_culture_school: {
            label: 'School of Khmer Arts and Culture',
            badge: 'Arts & Culture',
        },
    };

    const locations = [
        {
            id: 'poipet',
            name: 'Poipet',
            category: 'outside_cases',
            program: 'Street Outreach Support',
            description: 'Field teams support children living in border towns with food, case work, and access to school.',
            children: '120 children',
            left: 12,
            top: 23,
        },
        {
            id: 'serei-sophorn',
            name: 'Serei Sophorn',
            category: 'outside_cases',
            program: 'Cross-border outreach',
            description: 'Helping children in transit areas with emergency care and family tracing services.',
            children: '88 children',
            left: 18,
            top: 25,
        },
        {
            id: 'siem-reap',
            name: 'Siem Reap',
            category: 'arts_culture_school',
            program: 'School of Khmer Arts and Culture',
            description: 'Supporting children through education and cultural programs in the heart of Angkor.',
            children: '210 children',
            left: 28,
            top: 30,
        },
        {
            id: 'battambang',
            name: 'Battambang',
            category: 'child_welfare',
            program: 'Child Protection Center',
            description: 'A safe home and rehabilitation services for vulnerable children and families.',
            children: '150 children',
            left: 23,
            top: 41,
        },
        {
            id: 'pursat',
            name: 'Pursat',
            category: 'child_welfare',
            program: 'Community Care Program',
            description: 'Protecting children through community networks, shelters, and caseworkers.',
            children: '94 children',
            left: 27,
            top: 49,
        },
        {
            id: 'kampong-thom',
            name: 'Kampong Thom',
            category: 'deaf_blind_school',
            program: 'Specialized Education Campus',
            description: 'A center for deaf and blind learners with adaptive classrooms and support services.',
            children: '76 children',
            left: 40,
            top: 47,
        },
        {
            id: 'phnom-penh',
            name: 'Phnom Penh',
            category: 'arts_culture_school',
            program: 'Urban Arts & Culture Hub',
            description: 'A creative program that blends cultural heritage with modern education for children.',
            children: '340 children',
            left: 52,
            top: 63,
        },
        {
            id: 'takhmao',
            name: 'Takhmao',
            category: 'outside_cases',
            program: 'Family Outreach Services',
            description: 'Early intervention work reaches children at risk and connects them to local services.',
            children: '72 children',
            left: 54,
            top: 69,
        },
        {
            id: 'kampong-speu',
            name: 'Kampong Speu',
            category: 'child_welfare',
            program: 'Child Welfare Support',
            description: 'Child and family support in rural districts, with shelter and reintegration services.',
            children: '104 children',
            left: 46,
            top: 72,
        },
        {
            id: 'kandal',
            name: 'Kandal',
            category: 'child_welfare',
            program: 'Support Center Network',
            description: 'A program network serving children and families in peri-urban communities.',
            children: '128 children',
            left: 56,
            top: 67,
        },
        {
            id: 'kampong-cham',
            name: 'Kampong Cham',
            category: 'deaf_blind_school',
            program: 'Inclusive Schooling Program',
            description: 'Quality education for deaf and blind children with resources for full participation.',
            children: '96 children',
            left: 66,
            top: 59,
        },
        {
            id: 'tbong-khmum',
            name: 'Tbong Khmum',
            category: 'outside_cases',
            program: 'Regional Outreach Unit',
            description: 'Stabilizing the lives of children through counseling and short-term support services.',
            children: '65 children',
            left: 75,
            top: 61,
        },
        {
            id: 'prey-veng',
            name: 'Prey Veng',
            category: 'outside_cases',
            program: 'Field Care Mission',
            description: 'Mobile teams deliver protection and education access to remote villages.',
            children: '82 children',
            left: 72,
            top: 74,
        },
        {
            id: 'svay-rieng',
            name: 'Svay Rieng',
            category: 'outside_cases',
            program: 'Community Response Team',
            description: 'Reaching children in the southeast with food, health, and child protection services.',
            children: '58 children',
            left: 81,
            top: 86,
        },
        {
            id: 'takeo',
            name: 'Takeo',
            category: 'arts_culture_school',
            program: 'Rural Cultural Campus',
            description: 'A regional arts learning center focused on Khmer heritage and creative expression.',
            children: '92 children',
            left: 58,
            top: 78,
        },
    ];

    let activeCategories = new Set(Object.keys(categories));
    let activeLocationId = null;

    function createMarker(location) {
        const marker = document.createElement('button');
        marker.type = 'button';
        marker.className = `map-marker map-marker--${location.category}`;
        marker.dataset.locationId = location.id;
        marker.dataset.category = location.category;
        marker.style.left = `${location.left}%`;
        marker.style.top = `${location.top}%`;
        marker.setAttribute('aria-label', `${location.name} — ${categories[location.category].label}`);

        marker.innerHTML = `
            <span class="map-marker__pulse"></span>
            <span class="map-marker__ring"></span>
            <span class="map-marker__pin"></span>
        `;

        marker.addEventListener('mouseenter', () => showTooltip(marker, location));
        marker.addEventListener('mouseleave', hideTooltip);
        marker.addEventListener('click', () => selectLocation(location.id));

        return marker;
    }

    function createLocationItem(location) {
        const item = document.createElement('button');
        item.type = 'button';
        item.className = 'cambodia-map__location-item';
        item.dataset.locationId = location.id;
        item.dataset.category = location.category;

        item.innerHTML = `
            <span>
                <span class="cambodia-map__location-name">${location.name}</span>
                <span class="cambodia-map__location-category">${location.program}</span>
            </span>
            <span class="cambodia-map__location-pill ${location.category}">${categories[location.category].badge}</span>
        `;

        item.addEventListener('click', () => selectLocation(location.id));
        item.addEventListener('mouseenter', () => {
            const marker = markersRoot.querySelector(`[data-location-id="${location.id}"]`);
            if (marker) showTooltip(marker, location);
        });
        item.addEventListener('mouseleave', hideTooltip);

        return item;
    }

    function renderMap() {
        markersRoot.innerHTML = '';
        locationListRoot.innerHTML = '';

        locations.forEach((location) => {
            const marker = createMarker(location);
            const item = createLocationItem(location);

            markersRoot.appendChild(marker);
            locationListRoot.appendChild(item);
        });

        updateFilters();
    }

    function updateFilters() {
        const markers = markersRoot.querySelectorAll('.map-marker');
        const items = locationListRoot.querySelectorAll('.cambodia-map__location-item');

        markers.forEach((marker) => {
            const category = marker.dataset.category;
            const visible = activeCategories.has(category);
            marker.style.display = visible ? 'grid' : 'none';
        });

        items.forEach((item) => {
            const category = item.dataset.category;
            const visible = activeCategories.has(category);
            item.style.display = visible ? 'grid' : 'none';
        });
    }

    function showTooltip(marker, location) {
        tooltipRoot.innerHTML = `
            <h4>${location.name}</h4>
            <p>${location.description}</p>
            <div class="tooltip-meta">
                <span class="tooltip-badge">${location.program}</span>
                <span class="tooltip-children">${location.children} served</span>
            </div>
        `;

        tooltipRoot.classList.add('is-visible');
        tooltipRoot.setAttribute('aria-hidden', 'false');

        const markerRect = marker.getBoundingClientRect();
        const stageRect = mapStage.getBoundingClientRect();
        const left = markerRect.left - stageRect.left + markerRect.width / 2;
        const top = markerRect.top - stageRect.top;

        tooltipRoot.style.left = `${left}px`;
        tooltipRoot.style.top = `${top - 8}px`;

        const tooltipRect = tooltipRoot.getBoundingClientRect();
        if (tooltipRect.right > stageRect.width - 16) {
            tooltipRoot.style.left = `${Math.max(16, left - (tooltipRect.right - stageRect.width) - 16)}px`;
        }
        if (tooltipRect.left < 16) {
            tooltipRoot.style.left = `${Math.min(stageRect.width - tooltipRect.width - 16, left)}px`;
        }
    }

    function hideTooltip() {
        tooltipRoot.classList.remove('is-visible');
        tooltipRoot.setAttribute('aria-hidden', 'true');
    }

    function selectLocation(locationId) {
        activeLocationId = locationId;
        const location = locations.find((item) => item.id === locationId);
        if (!location) return;

        const allMarkers = markersRoot.querySelectorAll('.map-marker');
        allMarkers.forEach((marker) => marker.classList.toggle('is-active', marker.dataset.locationId === locationId));

        mapStage.style.transformOrigin = `${location.left}% ${location.top}%`;
        mapStage.style.transform = 'scale(1.08)';
        setTimeout(() => showTooltip(markersRoot.querySelector(`[data-location-id="${location.id}"]`), location), 120);
    }

    function resetZoom() {
        activeLocationId = null;
        mapStage.style.transform = 'scale(1)';
        const allMarkers = markersRoot.querySelectorAll('.map-marker');
        allMarkers.forEach((marker) => marker.classList.remove('is-active'));
        hideTooltip();
    }

    function toggleCategory(category) {
        if (activeCategories.has(category)) {
            activeCategories.delete(category);
        } else {
            activeCategories.add(category);
        }

        if (activeCategories.size === 0) {
            activeCategories = new Set(Object.keys(categories));
        }

        legendButtons.forEach((button) => {
            const buttonCategory = button.dataset.category;
            button.dataset.active = activeCategories.has(buttonCategory);
            button.setAttribute('aria-pressed', activeCategories.has(buttonCategory).toString());
        });

        updateFilters();
        resetZoom();
    }

    legendButtons.forEach((button) => {
        button.addEventListener('click', () => toggleCategory(button.dataset.category));
    });

    mapStage.addEventListener('mouseleave', () => {
        if (!activeLocationId) hideTooltip();
    });

    mapRoot.addEventListener('click', (event) => {
        if (!event.target.closest('.map-marker')) {
            resetZoom();
        }
    });

    renderMap();
});

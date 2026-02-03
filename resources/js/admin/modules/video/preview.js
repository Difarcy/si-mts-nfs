let activePreview = null;
const HOVER_DELAY_MS = 250;

function buildEmbedUrl(youtubeId, options) {
    const params = new URLSearchParams({
        autoplay: '1',
        playsinline: '1',
        rel: '0',
        origin: window.location.origin,
        ...options,
    });

    return `https://www.youtube-nocookie.com/embed/${encodeURIComponent(youtubeId)}?${params.toString()}`;
}

function stopPreview(previewEl) {
    if (!previewEl) return;
    
    if (previewEl.__videoPreviewTimer) {
        clearTimeout(previewEl.__videoPreviewTimer);
        previewEl.__videoPreviewTimer = null;
    }
    const media = previewEl.querySelector('[data-video-preview-media]');
    if (!media) return;

    const iframe = media.querySelector('iframe');
    if (iframe) iframe.remove();
    
    // Clean up persistent property if it exists (legacy support)
    if (previewEl.__persistent) delete previewEl.__persistent;

    const img = media.querySelector('img');
    if (img && previewEl.dataset.videoThumb) {
        img.src = previewEl.dataset.videoThumb;
    }

    const playButton = previewEl.querySelector('[data-play-button]');
    if (playButton) {
        playButton.style.opacity = '';
    }
}

function startPreview(previewEl) {
    const youtubeId = previewEl.dataset.videoYoutubeId;
    const thumb = previewEl.dataset.videoThumb;
    const media = previewEl.querySelector('[data-video-preview-media]');
    if (!youtubeId || !media) return;

    if (previewEl.__videoPreviewTimer) {
        clearTimeout(previewEl.__videoPreviewTimer);
        previewEl.__videoPreviewTimer = null;
    }

    previewEl.__videoPreviewTimer = setTimeout(() => {
        previewEl.__videoPreviewTimer = null;

        if (activePreview && activePreview !== previewEl) {
            stopPreview(activePreview);
            activePreview = null;
        }

        const existing = media.querySelector('iframe');
        if (existing) return;

        const img = media.querySelector('img');
        if (img && thumb) img.src = thumb;

        const iframe = document.createElement('iframe');
        iframe.width = '100%';
        iframe.height = '100%';
        iframe.setAttribute('allow', 'autoplay; encrypted-media; picture-in-picture');
        iframe.setAttribute('allowfullscreen', 'true');
        iframe.setAttribute('title', 'YouTube preview');
        iframe.style.position = 'absolute';
        iframe.style.top = '0';
        iframe.style.left = '0';
        iframe.style.width = '100%';
        iframe.style.height = '100%';
        iframe.style.border = '0';
        iframe.style.pointerEvents = 'none';
        // Scale slightly to prevent black lines/gaps at edges due to sub-pixel rendering
        iframe.style.transform = 'scale(1.05)';

        iframe.src = buildEmbedUrl(youtubeId, {
        mute: '1',
        controls: '0',
        modestbranding: '1',
        iv_load_policy: '3',
        fs: '0',
    });
        media.appendChild(iframe);

        const playButton = previewEl.querySelector('[data-play-button]');
        if (playButton) {
            playButton.style.opacity = '0';
        }

        activePreview = previewEl;
    }, HOVER_DELAY_MS);
}

function startPreviewImmediate(previewEl) {
    const youtubeId = previewEl.dataset.videoYoutubeId;
    const media = previewEl.querySelector('[data-video-preview-media]');
    if (!youtubeId || !media) return;

    if (previewEl.__videoPreviewTimer) {
        clearTimeout(previewEl.__videoPreviewTimer);
        previewEl.__videoPreviewTimer = null;
    }

    if (activePreview && activePreview !== previewEl) {
        stopPreview(activePreview);
        activePreview = null;
    }

    const existing = media.querySelector('iframe');
    if (existing) return;

    const iframe = document.createElement('iframe');
    iframe.width = '100%';
    iframe.height = '100%';
    iframe.setAttribute('allow', 'autoplay; encrypted-media; picture-in-picture');
    iframe.setAttribute('allowfullscreen', 'true');
    iframe.setAttribute('title', 'YouTube preview');
    iframe.style.position = 'absolute';
    iframe.style.inset = '0';
    iframe.style.border = '0';

    iframe.src = buildEmbedUrl(youtubeId, {
        mute: '0',
        controls: '1',
    });

    media.appendChild(iframe);
    activePreview = previewEl;
    previewEl.__persistent = true;

    const playButton = previewEl.querySelector('[data-play-button]');
    if (playButton) {
        playButton.style.opacity = '0';
    }
}

export function initVideoPreview() {
    const previewEls = document.querySelectorAll('[data-video-preview]');
    previewEls.forEach((previewEl) => {
        if (previewEl.dataset.videoPreviewInit === '1') return;
        previewEl.dataset.videoPreviewInit = '1';

        previewEl.addEventListener('mouseenter', () => startPreview(previewEl));
        previewEl.addEventListener('click', (e) => {
            e.preventDefault();
            const link = previewEl.dataset.videoLink;
            if (link) {
                window.open(link, '_blank');
            }
        });
        previewEl.addEventListener('mouseleave', () => {
            stopPreview(previewEl);
            if (activePreview === previewEl) activePreview = null;
        });
    });
}

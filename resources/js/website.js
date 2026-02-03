import './bootstrap';
import '../css/website.css';

// Import website specific scripts
import './website/ui/navbar-search';
import './website/ui/sidebar-mobile';
import './website/ui/search-bar';
import './website/ui/highlight-slider';
import initHeaderScroll from './website/ui/header-scroll';
import initBannerSlider from './website/ui/banner-slider';
import initLiveClock from './website/ui/live-clock';
import { initPreviewImageModal } from './admin/modules/media/preview-image';
import initVideoPreview from './website/ui/video-preview';
import initCalendarWidget from './website/ui/calendar-widget';
import { initToast as initWebsiteToast } from './website/ui/notifications';
import { initContactForm } from './website/modules/contact';
import { initCommentForms } from './website/modules/comments';
import { initChatbot } from './website/modules/chatbot';

// Initialize UI components
document.addEventListener('DOMContentLoaded', () => {
    initWebsiteToast();
    initHeaderScroll();
    initBannerSlider();
    initLiveClock();
    initPreviewImageModal();
    initVideoPreview();
    initCalendarWidget();
    initChatbot();
    
    // Initialize Modules based on page data attribute
    if (document.querySelector('[data-page="contact"]')) {
        initContactForm();
    }

    initCommentForms();
});

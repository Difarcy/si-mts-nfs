import './bootstrap';
import '../css/admin.css';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

// Import DOM utilities
import { ready } from './core/event';

// Import UI modules
import { initSidebarHandlers } from './admin/ui/sidebar';
import { initLogoutHandler } from './admin/actions/logout';
import { initNotifications } from './admin/ui/notifications';
import { NewsModule } from './admin/modules/news';
import { ArticleModule } from './admin/modules/article';
import { AnnouncementModule } from './admin/modules/announcement';
import { AgendaModule } from './admin/modules/agenda';
import { AchievementModule } from './admin/modules/achievements';
import { MediaModule } from './admin/modules/media';
import { VideoModule } from './admin/modules/video';
import { InboxModule } from './admin/modules/interaction/inbox';
import { CommentsModule } from './admin/modules/interaction/comments';
import { initLogoSettings } from './admin/modules/settings/logo';
import { initBannerSettings } from './admin/modules/settings/banner';
import { initHeroSettings } from './admin/modules/settings/hero';
import { initPromotionBannerSettings } from './admin/modules/settings/promotion-banner';
import { initKontakSettings } from './admin/modules/settings/kontak';
import { initSocialMediaSettings } from './admin/modules/settings/social-media';
import { initSpmbPpdbSettings } from './admin/modules/settings/spmb';
import { FormsModule } from './admin/modules/forms';
import { initProfileForms } from './admin/modules/profile';

/**
 * Admin Panel Core JavaScript
 */

ready(() => {
    initNotifications();

    // Sidebar Toggle (Mobile)
    initSidebarHandlers();

    // Logout Handler
    initLogoutHandler();

    // Forms Module
    FormsModule.init();

    // Profile Forms (Tentang Sekolah, Visi/Misi/Tujuan, Kepala Madrasah, Struktur Organisasi)
    initProfileForms();

    // Logo Settings
    initLogoSettings();

    // Banner Settings
    initBannerSettings();

    // Hero Settings
    initHeroSettings();

    // Promotion Banner Settings
    initPromotionBannerSettings();

    // Kontak Settings
    initKontakSettings();

    // Social Media Settings
    initSocialMediaSettings();

    // SPMB / PPDB Settings
    initSpmbPpdbSettings();

    // News Module
    NewsModule.init();

    // Article Module
    ArticleModule.init();

    // Announcement Module
    AnnouncementModule.init();

    // Agenda Module
    AgendaModule.init();

    // Achievement Module
    AchievementModule.init();

    // Media Module
    MediaModule.init();

    // Video Module
    VideoModule.init();

    // Inbox Module
    InboxModule.init();

    // Comments Module
    CommentsModule.init();
});

import { ready } from './core/event';
import { initNotifications } from './admin/ui/notifications';

ready(() => {
    initNotifications();
});

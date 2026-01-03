import './bootstrap';
import L from 'leaflet';
import 'leaflet/dist/leaflet.css';


document.addEventListener('DOMContentLoaded', () => {
    const employeeId = document
        .querySelector('meta[name="employee-id"]')
        ?.getAttribute('content');

    if (!employeeId) return;

    console.log('Echo ready:', window.Echo);

    window.Echo.channel(`employee.${employeeId}`)
        .listen('.notification.created', (e) => {
            console.log('NOTIF:', e);
        });
});

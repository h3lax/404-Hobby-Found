import './styles/app.css';
import $ from 'jquery';
import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import '@fullcalendar/common/main.css';

document.addEventListener('DOMContentLoaded', function() {
    const eventsDataElement = document.getElementById('events-data');

    if (eventsDataElement) {
        try {
            console
            let events = JSON.parse(eventsDataElement.textContent);
            let eventsparsed = JSON.parse(events);
            let calendarEl = document.getElementById('calendar');
            let calendar = new Calendar(calendarEl, {
                plugins: [dayGridPlugin],
                initialView: 'dayGridMonth',
                events : eventsparsed,
                eventClick : function(info) {

                    // Format the date in a user-friendly way
                    let options = { 
                        weekday: 'long', 
                        year: 'numeric', 
                        month: 'long', 
                        day: 'numeric', 
                        hour: '2-digit', 
                        minute: '2-digit', 
                        hour12: true 
                    };
                    let formattedDate = new Intl.DateTimeFormat('fr-FR', options).format(info.event.start);
                    console.log(formattedDate);

                    // Populate modal with event details
                    document.getElementById('modalTitle').innerText = info.event.title;
                    document.getElementById('modalDescription').innerText = info.event.extendedProps.description;
                    document.getElementById('modalDate').innerText = formattedDate;
                    document.getElementById('modalClub').innerText = info.event.extendedProps.club;
                    
                    let modal = new bootstrap.Modal(document.getElementById('eventModal'));
                    modal.show();
                }

            });
        
           /* eventsparsed.forEach(event => {
                console.log(event);
                calendar.addEvent(event);
            });*/

            calendar.render();
        } catch (error) {
            console.error("Error parsing events data:", error);
        }
    } else {
        console.error("Element with ID 'events-data' not found.");
    }
    
    
});


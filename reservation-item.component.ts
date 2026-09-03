import { Component, input } from '@angular/core';
import { IonItem, IonLabel, IonNote } from '@ionic/angular';
import { Reservation } from '../../services/reservation.service';
import { StatusBadgeComponent } from '../status-badge/status-badge.component';

/**
 * ReservationItemComponent
 * Reusable row used for every reservation on the My Reservations page.
 * Composes StatusBadgeComponent internally, showing that a reusable
 * component can itself reuse another reusable component.
 */
@Component({
  selector: 'app-reservation-item',
  templateUrl: './reservation-item.component.html',
  styleUrl: './reservation-item.component.scss',
  imports: [IonItem, IonLabel, IonNote, StatusBadgeComponent]
})
export class ReservationItemComponent {
  readonly reservation = input.required<Reservation>();

  // Converts a 24-hour "HH:mm" string (what the time inputs store) into
  // a friendlier 12-hour "h:mm AM/PM" display, e.g. "14:00" -> "2:00 PM".
  formatTime(time: string): string {
    if (!time) return '';
    const [hourStr, minute] = time.split(':');
    let hour = parseInt(hourStr, 10);
    const period = hour >= 12 ? 'PM' : 'AM';
    hour = hour % 12;
    if (hour === 0) hour = 12;
    return `${hour}:${minute} ${period}`;
  }
}
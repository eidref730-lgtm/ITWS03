import { Component, input } from '@angular/core';
import { IonBadge } from '@ionic/angular';

/**
 * StatusBadgeComponent
 * Small reusable component that turns a raw status string into a
 * color-coded pill. Reused inside ReservationItemComponent, and could
 * just as easily be reused on an admin or staff page in the future.
 */
@Component({
  selector: 'app-status-badge',
  templateUrl: './status-badge.component.html',
  styleUrl: './status-badge.component.scss',
  imports: [IonBadge]
})
export class StatusBadgeComponent {
  readonly status = input.required<string>();
}

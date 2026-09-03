import { Component, computed, input, output } from '@angular/core';
import { IonCard, IonCardContent, IonButton } from '@ionic/angular';
import { Facility } from '../../services/facility.service';

/**
 * FacilityCardComponent
 * Reusable card used for every facility on the Facilities page. Receives
 * the facility through input() and notifies its parent through output()
 * when the renter taps "Reserve This Facility" - the parent then stores
 * the pick in FacilityService and navigates to the Reserve page.
 */
@Component({
  selector: 'app-facility-card',
  templateUrl: './facility-card.component.html',
  styleUrl: './facility-card.component.scss',
  imports: [IonCard, IonCardContent, IonButton]
})
export class FacilityCardComponent {
  readonly facility = input.required<Facility>();
  readonly reserveClicked = output<Facility>();

  // A different banner color per facility, purely so each card is easy
  // to tell apart at a glance - demonstrates property binding to a style.
  readonly bannerColor = computed(() => {
    const colors: Record<number, string> = {
      1: '#8a4b2f',
      2: '#2f6d4f',
      3: '#234669'
    };
    return colors[this.facility().id] ?? '#555555';
  });

  onReserve(): void {
    this.reserveClicked.emit(this.facility());
  }
}

import { Injectable, signal } from '@angular/core';

export interface Facility {
  id: number;
  name: string;
  description: string;
  downPayment: number;
  fullPayment: number;
}

/**
 * FacilityService
 * Centralizes the list of rentable facilities. For this prototype the
 * data is static, matching the lesson's approach of starting a service
 * with local data before later connecting it to a real API.
 */
@Injectable({ providedIn: 'root' })
export class FacilityService {
  private facilities: Facility[] = [
    {
      id: 1,
      name: 'Clubhouse',
      description:
        'Air-conditioned function hall good for parties and small gatherings, up to 80 guests.',
      downPayment: 1000,
      fullPayment: 6500
    },
    {
      id: 2,
      name: 'Swimming Pool',
      description:
        'Open-air pool area with cabana seating, ideal for summer outings and pool parties.',
      downPayment: 2000,
      fullPayment: 8500
    },
    {
      id: 3,
      name: 'Basketball Court',
      description:
        'Full-size covered court, suitable for tournaments, practices, and community events.',
      downPayment: 500,
      fullPayment: 1500
    }
  ];

  // Holds the facility the renter tapped on the Facilities page, so the
  // Reserve page can read it without needing a route parameter.
  readonly selectedFacility = signal<Facility | null>(null);

  getFacilities(): Facility[] {
    return this.facilities;
  }

  selectFacility(facility: Facility): void {
    this.selectedFacility.set(facility);
  }
}

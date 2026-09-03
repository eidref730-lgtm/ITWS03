import { Injectable, signal } from '@angular/core';

export type ReservationStatus =
  | 'pending'
  | 'approved'
  | 'rejected'
  | 'completed'
  | 'cancelled';

export type PaymentMethod = 'gcash' | 'bank';
export type PaymentType = 'downpayment' | 'full';

export interface Reservation {
  id: number;
  facilityName: string;
  eventDate: string;
  startTime: string;
  endTime: string;
  purpose: string;
  status: ReservationStatus;
  paymentMethod: PaymentMethod;
  paymentType: PaymentType;
  amountPaid: number;
  totalDue: number;
  referenceNo: string;
}

/**
 * ReservationService
 * Holds the renter's reservations in a writable signal. Submitting the
 * Reserve form calls addReservation(), so My Reservations updates
 * immediately without a manual refresh - a practical use of a writable
 * signal shared through a service.
 */
@Injectable({ providedIn: 'root' })
export class ReservationService {
  private readonly reservations = signal<Reservation[]>([
    {
      id: 1,
      facilityName: 'Clubhouse',
      eventDate: '2026-09-12',
      startTime: '14:00',
      endTime: '18:00',
      purpose: 'Birthday party',
      status: 'approved',
      paymentMethod: 'gcash',
      paymentType: 'downpayment',
      amountPaid: 1000,
      totalDue: 6500,
      referenceNo: 'REF-2026-0012'
    },
    {
      id: 2,
      facilityName: 'Basketball Court',
      eventDate: '2026-08-30',
      startTime: '17:00',
      endTime: '19:00',
      purpose: 'Barangay practice game',
      status: 'pending',
      paymentMethod: 'bank',
      paymentType: 'full',
      amountPaid: 0,
      totalDue: 1500,
      referenceNo: 'REF-2026-0015'
    },
    {
      id: 3,
      facilityName: 'Swimming Pool',
      eventDate: '2026-07-20',
      startTime: '09:00',
      endTime: '13:00',
      purpose: 'Family reunion',
      status: 'completed',
      paymentMethod: 'gcash',
      paymentType: 'full',
      amountPaid: 8500,
      totalDue: 8500,
      referenceNo: 'REF-2026-0004'
    }
  ]);

  private nextId = 4;

  getReservations() {
    return this.reservations;
  }

  addReservation(data: Omit<Reservation, 'id' | 'status' | 'referenceNo'>): void {
    const newReservation: Reservation = {
      ...data,
      id: this.nextId,
      status: 'pending',
      referenceNo: 'REF-2026-' + String(1000 + this.nextId)
    };
    this.nextId++;
    this.reservations.update(current => [newReservation, ...current]);
  }
}

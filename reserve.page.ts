import { Component, inject, signal } from '@angular/core';
import { FormsModule } from '@angular/forms';
import {
  IonHeader,
  IonToolbar,
  IonTitle,
  IonContent,
  IonButtons,
  IonBackButton,
  IonItem,
  IonLabel,
  IonInput,
  IonTextarea,
  IonSelect,
  IonSelectOption,
  IonRadioGroup,
  IonRadio,
  IonButton,
  IonNote,
  NavController
} from '@ionic/angular';
import { FacilityService } from '../services/facility.service';
import {
  ReservationService,
  PaymentMethod,
  PaymentType
} from '../services/reservation.service';
import { NotificationService } from '../services/notification.service';

@Component({
  selector: 'app-reserve',
  templateUrl: 'reserve.page.html',
  styleUrl: 'reserve.page.scss',
  imports: [
    IonHeader,
    IonToolbar,
    IonTitle,
    IonContent,
    IonButtons,
    IonBackButton,
    IonItem,
    IonLabel,
    IonInput,
    IonTextarea,
    IonSelect,
    IonSelectOption,
    IonRadioGroup,
    IonRadio,
    IonButton,
    IonNote,
    FormsModule
  ]
})
export class ReservePage {
  private facilityService = inject(FacilityService);
  private reservationService = inject(ReservationService);
  private notificationService = inject(NotificationService);
  private navCtrl = inject(NavController);

  // Read from the service instead of a route parameter, since the
  // Facilities page already stored the renter's pick before navigating.
  readonly facility = this.facilityService.selectedFacility;

  // Two-way form-bound fields via [(ngModel)]
  eventDate = '';
  startTime = '';
  endTime = '';
  purpose = '';
  paymentMethod: PaymentMethod = 'gcash';
  paymentType: PaymentType = 'downpayment';
  referenceNo = '';
  proofFileName = '';

  readonly submitted = signal(false);

  // Plain methods, not computed() signals - they read ordinary
  // ngModel-bound properties (eventDate, purpose, etc.), and computed()
  // only re-runs when a *signal* it reads changes. Since these fields
  // are plain strings, computed() would calculate once at page-load
  // (everything empty) and never update again, even as you type.
  amountDue(): number {
    const f = this.facility();
    if (!f) return 0;
    return this.paymentType === 'downpayment' ? f.downPayment : f.fullPayment;
  }

  // Each method below checks one field and returns an error message to
  // show under it, or '' when that field is fine. Kept as separate
  // methods (rather than one big check) so the template can show each
  // problem right next to the field it belongs to.

  eventDateError(): string {
    if (!this.eventDate) return '';
    const today = new Date().toISOString().slice(0, 10);
    return this.eventDate < today
      ? 'Event date cannot be in the past.'
      : '';
  }

  timeError(): string {
    if (!this.startTime || !this.endTime) return '';
    return this.endTime <= this.startTime
      ? 'End time must be later than start time.'
      : '';
  }

  purposeError(): string {
    const trimmed = this.purpose.trim();
    if (!trimmed) return '';
    return trimmed.length < 3
      ? 'Please describe the purpose in a few more words.'
      : '';
  }

  referenceNoError(): string {
    const trimmed = this.referenceNo.trim();
    if (!trimmed) return '';

    if (this.paymentMethod === 'gcash') {
      // Real GCash reference numbers are exactly 13 digits, numbers only.
      return /^\d{13}$/.test(trimmed)
        ? ''
        : 'GCash reference number must be exactly 13 digits (numbers only).';
    }

    // Bank transfer reference formats vary by bank, so keep this looser.
    return /^[A-Za-z0-9]{6,}$/.test(trimmed)
      ? ''
      : 'Reference number should be at least 6 letters/numbers, no spaces or symbols.';
  }

  proofFileError(): string {
    const trimmed = this.proofFileName.trim();
    if (!trimmed) return '';
    return /\.(jpg|jpeg|png|pdf)$/i.test(trimmed)
      ? ''
      : 'File name should end in .jpg, .jpeg, .png, or .pdf.';
  }

  // Drives [disabled] on the submit button - stays disabled until every
  // field has a value AND passes its individual check above.
  isFormValid(): boolean {
    return (
      !!this.eventDate &&
      !!this.startTime &&
      !!this.endTime &&
      this.purpose.trim().length > 0 &&
      this.referenceNo.trim().length > 0 &&
      this.proofFileName.trim().length > 0 &&
      !this.eventDateError() &&
      !this.timeError() &&
      !this.purposeError() &&
      !this.referenceNoError() &&
      !this.proofFileError()
    );
  }

  submitReservation(): void {
    const f = this.facility();
    if (!f || !this.isFormValid()) return;

    this.reservationService.addReservation({
      facilityName: f.name,
      eventDate: this.eventDate,
      startTime: this.startTime,
      endTime: this.endTime,
      purpose: this.purpose,
      paymentMethod: this.paymentMethod,
      paymentType: this.paymentType,
      amountPaid: 0,
      totalDue: f.fullPayment
    });

    this.notificationService.addNotification(
      `Your reservation request for ${f.name} on ${this.eventDate} has been submitted and is awaiting admin approval.`
    );

    this.submitted.set(true);
  }

  goToMyReservations(): void {
    // navigateRoot() resets the whole navigation stack instead of just
    // swapping this one entry - so once the renter lands on My
    // Reservations, there's no Facilities/Reserve history left to pop
    // through. The back button then falls through to its
    // defaultHref="/home" and goes straight home in one tap.
    this.navCtrl.navigateRoot('/my-reservations');
  }
}
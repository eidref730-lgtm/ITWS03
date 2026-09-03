import { Component, inject } from '@angular/core';
import { RouterLink } from '@angular/router';
import {
  IonHeader,
  IonToolbar,
  IonTitle,
  IonContent,
  IonList,
  IonItem,
  IonLabel,
  IonBadge
} from '@ionic/angular';
import { NotificationService } from '../services/notification.service';

@Component({
  selector: 'app-home',
  templateUrl: 'home.page.html',
  styleUrl: 'home.page.scss',
  imports: [
    IonHeader,
    IonToolbar,
    IonTitle,
    IonContent,
    IonList,
    IonItem,
    IonLabel,
    IonBadge,
    RouterLink
  ]
})
export class HomePage {
  private notificationService = inject(NotificationService);

  // Directly injecting the service into the page, since Home is
  // responsible for showing its own unread-count badge.
  readonly unreadCount = this.notificationService.unreadCount;
}

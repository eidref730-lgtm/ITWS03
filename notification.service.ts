import { Injectable, signal, computed } from '@angular/core';

export interface AppNotification {
  id: number;
  message: string;
  date: string;
  isRead: boolean;
}

/**
 * NotificationService
 * Holds the renter's notifications and derives an unread count using
 * computed(), so any page that injects this service (Home badge,
 * Notifications list) always reads the same up-to-date count.
 */
@Injectable({ providedIn: 'root' })
export class NotificationService {
  private readonly notifications = signal<AppNotification[]>([
    {
      id: 1,
      message: 'Your Clubhouse reservation for Sep 12 has been approved.',
      date: '2026-08-20',
      isRead: false
    },
    {
      id: 2,
      message:
        'Reminder: your Basketball Court booking is still awaiting admin review.',
      date: '2026-08-22',
      isRead: false
    },
    {
      id: 3,
      message:
        'Your Swimming Pool reservation has been marked completed. You may now leave feedback.',
      date: '2026-08-24',
      isRead: true
    }
  ]);

  private nextId = 4;

  readonly unreadCount = computed(
    () => this.notifications().filter(n => !n.isRead).length
  );

  getNotifications() {
    return this.notifications;
  }

  markAsRead(id: number): void {
    this.notifications.update(list =>
      list.map(n => (n.id === id ? { ...n, isRead: true } : n))
    );
  }

  markAllAsRead(): void {
    this.notifications.update(list => list.map(n => ({ ...n, isRead: true })));
  }

  addNotification(message: string): void {
    const newNotification: AppNotification = {
      id: this.nextId,
      message,
      date: new Date().toISOString().slice(0, 10),
      isRead: false
    };
    this.nextId++;
    this.notifications.update(list => [newNotification, ...list]);
  }
}
# Quiz Notification System

## Overview
A comprehensive notification system that alerts users when quizzes start, with a notification bell in the header that shows unread notifications in real-time.

## Features Implemented

### 🔔 Notification Bell
- **Location**: Header navigation (next to dark mode toggle)
- **Visual Indicators**: 
  - Red badge with unread count (animated pulse)
  - Bell icon with hover effects
  - Dropdown panel with notifications list

### 📱 Notification Features
- **Real-time Updates**: Livewire component updates automatically
- **Mark as Read**: Click notifications to mark them as read
- **Mark All as Read**: Bulk action to clear all notifications
- **Unread Count**: Badge shows number of unread notifications
- **Responsive Design**: Works on all device sizes
- **Dark Mode Support**: Full dark mode compatibility

### 🎯 Quiz Notifications
- **Quiz Start Notifications**: Sent when quizzes begin
- **Quiz Reminder Notifications**: Sent 5 minutes before quiz starts
- **Quiz End Notifications**: Sent 5 minutes before quiz ends
- **Automatic Scheduling**: Based on quiz time slots
- **User Targeting**: All users with 'user' role receive notifications

## Technical Implementation

### Database Structure
```sql
notifications table:
- id (primary key)
- user_id (foreign key to users)
- type (quiz_start, quiz_reminder, etc.)
- title (notification title)
- message (notification content)
- data (JSON metadata)
- read_at (timestamp when read)
- created_at, updated_at
```

### Models
- **Notification Model**: Handles notification data and relationships
- **User Model**: Extended with notification relationships
- **QuizNotificationService**: Service class for sending notifications

### Livewire Components
- **NotificationBell**: Real-time notification display and management
- **Features**:
  - Load notifications on mount
  - Toggle dropdown visibility
  - Mark individual notifications as read
  - Mark all notifications as read
  - Real-time updates via Echo (ready for WebSocket integration)

### Commands
- **SendQuizNotifications**: Send notifications for specific quiz sets
- **AddTestNotification**: Create test notifications for development

## Usage

### Sending Quiz Notifications

#### Send notification for specific quiz set:
```bash
php artisan quiz:send-notifications --set=1 --type=start
php artisan quiz:send-notifications --set=2 --type=reminder
php artisan quiz:send-notifications --set=3 --type=end --minutes=5
```

#### Schedule notifications based on current time:
```bash
php artisan quiz:send-notifications
```

#### Add test notification:
```bash
php artisan notification:test --user=1
```

### Quiz Time Slots
- **Set 1**: 9:30 AM - 10:30 AM
- **Set 2**: 12:00 PM - 1:00 PM  
- **Set 3**: 3:00 PM - 4:00 PM

### Notification Types
- **quiz_start**: Sent when quiz begins
- **quiz_reminder**: Sent 5 minutes before quiz starts
- **quiz_ending**: Sent 5 minutes before quiz ends

## User Experience

### Notification Bell Behavior
1. **Bell Icon**: Shows in header for authenticated users
2. **Badge Count**: Red badge with unread count (pulses when unread)
3. **Click to Open**: Dropdown shows recent notifications
4. **Click to Read**: Click any notification to mark as read
5. **Mark All Read**: Button to clear all unread notifications

### Notification Display
- **Icons**: Different icons for different notification types
- **Timestamps**: Shows "X minutes ago" format
- **Unread Indicator**: Blue dot for unread notifications
- **Hover Effects**: Smooth transitions and hover states

## Integration Points

### Header Integration
- Added to `resources/views/partials/header.blade.php`
- Only shows for authenticated users
- Positioned next to dark mode toggle

### User Dashboard
- Notifications appear in the daily report section
- Users can see quiz start times and reminders
- Links to quiz page for easy access

## Future Enhancements

### Real-time Features
- **WebSocket Integration**: Real-time notifications without page refresh
- **Push Notifications**: Browser push notifications
- **Email Notifications**: Email alerts for important notifications

### Advanced Features
- **Notification Preferences**: User settings for notification types
- **Notification History**: Full notification history page
- **Custom Notifications**: Admin ability to send custom notifications
- **Notification Categories**: Different categories (quiz, system, etc.)

### Automation
- **Cron Jobs**: Automatic notification scheduling
- **Event Listeners**: Automatic notifications on quiz events
- **Smart Timing**: Intelligent notification timing based on user activity

## Testing

### Manual Testing
1. **Create Test Notification**:
   ```bash
   php artisan notification:test --user=1
   ```

2. **Send Quiz Notifications**:
   ```bash
   php artisan quiz:send-notifications --set=1 --type=start
   ```

3. **Verify in Browser**:
   - Login as user
   - Check notification bell in header
   - Click bell to see notifications
   - Test mark as read functionality

### Automated Testing
- Unit tests for notification service
- Feature tests for notification bell component
- Integration tests for notification flow

## Configuration

### Environment Variables
```env
# For future WebSocket integration
PUSHER_APP_ID=your_app_id
PUSHER_APP_KEY=your_app_key
PUSHER_APP_SECRET=your_app_secret
PUSHER_APP_CLUSTER=your_cluster
```

### Cron Job Setup (Future)
```bash
# Add to crontab for automatic notifications
* * * * * cd /path/to/project && php artisan quiz:send-notifications
```

## Notes
- Notifications are stored in database for persistence
- Real-time updates work with Livewire polling
- System is ready for WebSocket integration
- All notifications are user-specific and secure
- Notification bell only appears for authenticated users
- Mini games are excluded from quiz notifications (only sets 1, 2, 3)

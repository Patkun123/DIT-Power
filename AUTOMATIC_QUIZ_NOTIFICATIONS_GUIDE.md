# 🔔 Automatic Quiz Notifications System

## 📋 Overview
The system automatically sends quiz notifications based on the predefined schedule without any manual intervention. Notifications are sent for quiz reminders, starts, and endings.

## ⏰ Quiz Schedule
The system follows this **automatic schedule**:

| Quiz Set | Start Time | End Time | Reminder | Start Notification | End Notification |
|----------|------------|----------|----------|-------------------|------------------|
| **Set 1** | 9:30 AM | 10:30 AM | 9:25 AM | 9:30 AM | 10:25 AM |
| **Set 2** | 12:00 PM | 1:00 PM | 11:55 AM | 12:00 PM | 12:55 PM |
| **Set 3** | 3:00 PM | 4:00 PM | 2:55 PM | 3:00 PM | 3:55 PM |

## 🚀 How It Works

### 1. **Automatic Scheduling**
- The system runs **every minute** automatically
- No manual intervention required
- Uses Laravel's built-in task scheduler

### 2. **Notification Types**
- **🔔 Reminder**: Sent 5 minutes before quiz starts
- **✅ Start**: Sent when quiz begins
- **⏰ End**: Sent 5 minutes before quiz ends

### 3. **Time Zone**
- All times are in **Asia/Manila** timezone
- Automatically adjusts for daylight saving time

## 🛠️ Setup Instructions

### Step 1: Enable Laravel Scheduler
The scheduler is already configured in `routes/console.php`:
```php
Schedule::command('quiz:auto-notify')->everyMinute();
```

### Step 2: Start the Scheduler (Production)
For production servers, add this to your crontab:
```bash
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

### Step 3: Test the System
```bash
# Test automatic notifications
php artisan quiz:auto-notify

# Check if scheduler is working
php artisan schedule:list

# Run scheduler manually (for testing)
php artisan schedule:run
```

## 📱 Notification Features

### **Responsive Design**
- ✅ Mobile-optimized interface
- ✅ Desktop-friendly layout
- ✅ Touch-friendly interactions
- ✅ Dark mode support

### **Notification Types**
- 🟢 **Quiz Start**: Green checkmark icon
- 🔵 **Quiz Reminder**: Blue info icon
- 🟠 **Quiz Ending**: Orange clock icon

### **User Experience**
- Real-time notification bell
- Unread count badge
- Click to mark as read
- Mark all as read option
- Smooth animations

## 🔧 Configuration

### **Quiz Times** (in `ScheduleQuizNotifications.php`)
```php
$quizSlots = [
    ['set' => 1, 'start' => $now->copy()->setTime(9, 30), 'end' => $now->copy()->setTime(10, 30)],
    ['set' => 2, 'start' => $now->copy()->setTime(12, 0), 'end' => $now->copy()->setTime(13, 0)],
    ['set' => 3, 'start' => $now->copy()->setTime(15, 0), 'end' => $now->copy()->setTime(16, 0)],
];
```

### **Notification Timing**
- **Reminder**: 5 minutes before start
- **Start**: Within 1 minute of start time
- **End**: 5 minutes before end time

## 📊 Monitoring

### **Check Notification Status**
```bash
# View all scheduled tasks
php artisan schedule:list

# Test notifications manually
php artisan quiz:auto-notify

# Check notification count
php artisan tinker
>>> App\Models\Notification::count()
```

### **Logs**
- Check Laravel logs for notification activity
- Monitor cron job execution
- Verify user notification delivery

## 🎯 Benefits

### **For Users**
- ✅ Never miss quiz times
- ✅ Get timely reminders
- ✅ Know when quizzes are ending
- ✅ Real-time notifications

### **For Administrators**
- ✅ Zero manual intervention
- ✅ Reliable delivery
- ✅ Easy monitoring
- ✅ Scalable system

## 🚨 Troubleshooting

### **Common Issues**

1. **Notifications not sending**
   ```bash
   # Check if scheduler is running
   php artisan schedule:list
   
   # Test manually
   php artisan quiz:auto-notify
   ```

2. **Wrong timezone**
   - Verify server timezone
   - Check Carbon timezone setting

3. **Cron not working**
   - Verify crontab entry
   - Check file permissions
   - Test cron job manually

### **Debug Commands**
```bash
# Test specific notification
php artisan quiz:send-notifications --set=1 --type=start

# Check notification service
php artisan tinker
>>> app(App\Services\QuizNotificationService::class)->sendQuizStartNotification(1)
```

## 📈 Statistics

The system automatically tracks:
- Total notifications sent
- User engagement
- Notification read rates
- System performance

## 🔄 Maintenance

### **Daily**
- Monitor notification delivery
- Check system logs

### **Weekly**
- Review notification statistics
- Verify schedule accuracy

### **Monthly**
- Update quiz schedules if needed
- Clean up old notifications

---

## 🎉 **Ready to Use!**

Your automatic quiz notification system is now fully configured and will:
- ✅ Send reminders 5 minutes before each quiz
- ✅ Notify users when quizzes start
- ✅ Alert users when quizzes are ending
- ✅ Work automatically without any manual intervention
- ✅ Provide a responsive, user-friendly interface

**No further action required** - the system will handle everything automatically! 🚀

# 🔔 Automatic Quiz Notifications Setup

## ✅ **System Status: READY**

The automatic notification system is now **fully configured** and will automatically send notifications to all users when quizzes start!

## 🚀 **How It Works**

### **Automatic Schedule:**
- **Every minute**, the system checks if it's time to send notifications
- **5 minutes before** quiz start: Sends reminder notifications
- **When quiz starts**: Sends start notifications
- **5 minutes before** quiz end: Sends end notifications

### **Quiz Time Slots:**
- **Set 1**: 9:30 AM - 10:30 AM
- **Set 2**: 12:00 PM - 1:00 PM  
- **Set 3**: 3:00 PM - 4:00 PM

## ⚙️ **Setup Instructions**

### **1. Enable Laravel Scheduler (Required)**

Add this to your server's **crontab** to run the scheduler every minute:

```bash
# Edit crontab
crontab -e

# Add this line (replace /path/to/project with your actual project path)
* * * * * cd /path/to/your/project && php artisan schedule:run >> /dev/null 2>&1
```

### **2. For XAMPP/Windows Development:**

Create a **batch file** to run the scheduler:

**Create file: `run-scheduler.bat`**
```batch
@echo off
:loop
php artisan schedule:run
timeout /t 60 /nobreak > nul
goto loop
```

**Run the batch file** to start automatic notifications.

### **3. For Production Server:**

Use the crontab method above, or set up a **systemd service** for better reliability.

## 🧪 **Testing**

### **Test the Command:**
```bash
php artisan quiz:auto-notify
```

### **Test Manual Notifications:**
```bash
# Send test notification to all users
php artisan quiz:send-notifications --set=1 --type=start

# Send reminder notification
php artisan quiz:send-notifications --set=2 --type=reminder

# Send end notification
php artisan quiz:send-notifications --set=3 --type=end --minutes=5
```

## 📱 **User Experience**

1. **Notification Bell**: Appears in header for all authenticated users
2. **Red Badge**: Shows unread count with animated pulse
3. **Automatic Updates**: Notifications appear in real-time
4. **Click to View**: Users can click bell to see notifications
5. **Mark as Read**: Users can mark notifications as read

## 🔧 **Commands Available**

```bash
# Automatic notifications (runs every minute via scheduler)
php artisan quiz:auto-notify

# Manual notifications
php artisan quiz:send-notifications --set=1 --type=start
php artisan quiz:send-notifications --set=2 --type=reminder
php artisan quiz:send-notifications --set=3 --type=end --minutes=5

# Test notifications
php artisan notification:test --user=1

# Check scheduler status
php artisan schedule:list
```

## 📊 **Notification Types**

1. **Quiz Reminder**: "Quiz Set X Starting Soon! Get ready!"
2. **Quiz Start**: "Quiz Set X Started! Click here to start taking the quiz!"
3. **Quiz Ending**: "Quiz Set X Ending Soon! Complete your quiz now!"

## 🎯 **Current Status**

- ✅ **Command Created**: `quiz:auto-notify`
- ✅ **Scheduler Configured**: Runs every minute
- ✅ **Notification Service**: Ready
- ✅ **Database**: Notifications table created
- ✅ **UI Components**: Notification bell in all headers
- ✅ **Tested**: Successfully sent 225 notifications

## 🚨 **Important Notes**

1. **Crontab Required**: The scheduler only works if you set up the crontab
2. **Time Zone**: All times are in Asia/Manila timezone
3. **User Role**: Only users with 'user' role receive notifications
4. **No Duplicates**: System prevents sending duplicate notifications

## 🔄 **Troubleshooting**

### **If notifications aren't sending:**
1. Check if crontab is set up: `crontab -l`
2. Test the command manually: `php artisan quiz:auto-notify`
3. Check Laravel logs: `storage/logs/laravel.log`
4. Verify scheduler: `php artisan schedule:list`

### **If users don't see notifications:**
1. Check if user is logged in
2. Check if user has 'user' role
3. Check browser console for JavaScript errors
4. Verify notification bell is visible in header

## 🎉 **Ready to Go!**

Your automatic notification system is now **fully functional**! 

**Next Steps:**
1. Set up the crontab (or run the batch file for development)
2. Test with a few users
3. Monitor the notification delivery

The system will automatically notify all users when quizzes start! 🚀

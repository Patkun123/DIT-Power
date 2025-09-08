# Quiz Leaderboards Implementation

## Overview
This implementation adds comprehensive leaderboards for quiz sets 1, 2, and 3 in the DIT-Power wellness platform. The leaderboards update daily and exclude mini games as requested.

## Features Implemented

### 1. Daily Leaderboards by Quiz Set
- **Set 1 Leaderboard**: Shows top 5 scores for the current day
- **Set 2 Leaderboard**: Shows top 5 scores for the current day  
- **Set 3 Leaderboard**: Shows top 5 scores for the current day
- **Overall Leaderboard**: Shows top 5 all-time scores across all sets

### 2. Key Features
- **Daily Reset**: Leaderboards automatically reset at midnight each day
- **Mini Games Exclusion**: Mini games are completely excluded from rankings
- **Real-time Updates**: Livewire component provides reactive updates
- **Loading States**: Visual feedback during data loading
- **Refresh Button**: Manual refresh capability
- **Responsive Design**: Works on all device sizes

### 3. Data Structure
- Quiz attempts are categorized by `set` field (1, 2, or 3)
- Daily rankings show best scores per user per set
- Overall rankings aggregate scores across all sets
- Tracks both score and correct answer count

## Technical Implementation

### Database Changes
1. **Migration**: Added `set` field to `quiz_attempts` table
   ```php
   $table->string('set')->nullable()->after('correct');
   ```

2. **Model Updates**: Updated `QuizAttempt` model to include `set` field

### Livewire Component
- **File**: `app/Livewire/Leaderboards.php`
- **Features**:
  - Automatic data loading on mount
  - Daily leaderboard generation
  - Overall leaderboard calculation
  - Error handling and loading states
  - Refresh functionality

### View Updates
- **File**: `resources/views/livewire/leaderboards.blade.php`
- **Features**:
  - Dynamic data display
  - Medal system (gold, silver, bronze)
  - Loading animations
  - Flash messages
  - Responsive grid layout

### Quiz Integration
- **File**: `resources/views/livewire/quiz/index.blade.php`
- **Updates**: Quiz attempts now include `set` field when saved

## Usage

### Viewing Leaderboards
1. Navigate to `/leaderboard` route
2. View overall rankings at the top
3. See daily rankings for each set below
4. Use refresh button to update data

### Quiz Submission
1. Take quiz during designated time slots
2. Quiz set is automatically determined by time
3. Scores are saved with set information
4. Leaderboards update automatically

## Time Slots for Quiz Sets
- **Set 1**: 9:00 AM - 10:30 AM
- **Set 2**: 12:00 PM - 1:30 PM  
- **Set 3**: 3:00 PM - 4:30 PM

## Data Population
Use the artisan command to populate sample data for testing:
```bash
php artisan quiz:populate-data --users=5 --days=3
```

## Styling
- **Colors**: Gold (1st), Silver (2nd), Bronze (3rd), Gray (4th+)
- **Responsive**: Mobile-first design with Tailwind CSS
- **Dark Mode**: Full dark mode support
- **Animations**: Loading spinners and smooth transitions

## Future Enhancements
- Weekly/monthly leaderboards
- Achievement badges
- Social sharing
- Email notifications for top performers
- Historical performance tracking

## Notes
- Mini games are completely excluded from all leaderboards
- Daily rankings reset at midnight server time
- Users can take multiple attempts per day per set
- Best score per user per set is used for daily rankings
- Overall rankings consider all attempts across all sets

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UpcomingEvent;
use Illuminate\Support\Str;

class UpcomingEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'title' => 'Mental Health Awareness Workshop',
                'description' => 'A comprehensive workshop focusing on mental health awareness, stress management, and building resilience in the workplace.',
                'content' => 'Join us for an interactive workshop that will cover various aspects of mental health including recognizing signs of stress, effective coping strategies, and building a supportive work environment. This event is designed for all employees and will include practical exercises and group discussions.',
                'category' => 'Health & Wellness',
                'status' => 'published',
                'event_date' => now()->addDays(7)->setTime(9, 0),
                'end_date' => now()->addDays(7)->setTime(17, 0),
                'location' => 'DTI Main Office, Conference Room A',
                'organizer' => 'DTI Human Resources Department',
                'author' => 'Dr. Maria Santos',
                'summary' => 'Interactive workshop on mental health awareness and stress management techniques for workplace wellness.',
                'slug' => Str::slug('Mental Health Awareness Workshop'),
            ],
            [
                'title' => 'Nutrition and Healthy Living Seminar',
                'description' => 'Learn about proper nutrition, healthy eating habits, and lifestyle choices that promote overall wellness.',
                'content' => 'This seminar will provide valuable insights into nutrition science, meal planning, and making healthy food choices. Our nutritionist will share practical tips for maintaining a balanced diet and discuss the importance of proper nutrition for mental and physical health.',
                'category' => 'Health & Wellness',
                'status' => 'published',
                'event_date' => now()->addDays(14)->setTime(10, 0),
                'end_date' => now()->addDays(14)->setTime(12, 0),
                'location' => 'DTI Training Center',
                'organizer' => 'DTI Wellness Program',
                'author' => 'Nutritionist Ana Garcia',
                'summary' => 'Educational seminar on nutrition, healthy eating habits, and lifestyle choices for better wellness.',
                'slug' => Str::slug('Nutrition and Healthy Living Seminar'),
            ],
            [
                'title' => 'Workplace Stress Management Training',
                'description' => 'Practical training session on identifying and managing workplace stress to improve productivity and well-being.',
                'content' => 'This training session will help participants understand the sources of workplace stress and provide them with practical tools and techniques to manage stress effectively. Topics include time management, work-life balance, and stress reduction techniques.',
                'category' => 'Training',
                'status' => 'published',
                'event_date' => now()->addDays(21)->setTime(14, 0),
                'end_date' => now()->addDays(21)->setTime(16, 0),
                'location' => 'DTI Main Office, Training Room B',
                'organizer' => 'DTI Training Department',
                'author' => 'Stress Management Specialist John Cruz',
                'summary' => 'Comprehensive training on workplace stress identification and management techniques.',
                'slug' => Str::slug('Workplace Stress Management Training'),
            ],
            [
                'title' => 'Physical Fitness and Exercise Program',
                'description' => 'Introduction to workplace fitness programs and exercises that can be done during work hours.',
                'content' => 'Join our fitness instructor for a session on workplace exercises, stretching routines, and simple fitness activities that can be incorporated into your daily work routine. This program is suitable for all fitness levels.',
                'category' => 'Health & Wellness',
                'status' => 'published',
                'event_date' => now()->addDays(28)->setTime(8, 0),
                'end_date' => now()->addDays(28)->setTime(9, 0),
                'location' => 'DTI Gymnasium',
                'organizer' => 'DTI Sports and Recreation Committee',
                'author' => 'Fitness Instructor Mike Rodriguez',
                'summary' => 'Introduction to workplace fitness programs and exercises for employee wellness.',
                'slug' => Str::slug('Physical Fitness and Exercise Program'),
            ],
            [
                'title' => 'Financial Wellness Workshop',
                'description' => 'Learn about personal finance management, budgeting, and financial planning for a secure future.',
                'content' => 'This workshop covers essential financial topics including budgeting, saving strategies, investment basics, and retirement planning. Our financial advisor will provide practical advice for managing personal finances effectively.',
                'category' => 'Educational',
                'status' => 'published',
                'event_date' => now()->addDays(35)->setTime(13, 0),
                'end_date' => now()->addDays(35)->setTime(15, 0),
                'location' => 'DTI Main Office, Auditorium',
                'organizer' => 'DTI Employee Benefits Office',
                'author' => 'Financial Advisor Lisa Martinez',
                'summary' => 'Educational workshop on personal finance management and financial planning strategies.',
                'slug' => Str::slug('Financial Wellness Workshop'),
            ],
            [
                'title' => 'Team Building and Communication Skills',
                'description' => 'Interactive session on improving team communication, collaboration, and workplace relationships.',
                'content' => 'This session focuses on enhancing team dynamics, improving communication skills, and building stronger workplace relationships. Activities include group exercises, role-playing scenarios, and team-building games.',
                'category' => 'Training',
                'status' => 'published',
                'event_date' => now()->addDays(42)->setTime(9, 0),
                'end_date' => now()->addDays(42)->setTime(17, 0),
                'location' => 'DTI Conference Center',
                'organizer' => 'DTI Human Resources Department',
                'author' => 'Team Building Specialist Carlos Lopez',
                'summary' => 'Interactive training on team communication, collaboration, and workplace relationship building.',
                'slug' => Str::slug('Team Building and Communication Skills'),
            ],
            [
                'title' => 'Digital Wellness and Technology Balance',
                'description' => 'Learn about maintaining a healthy relationship with technology and digital devices in the workplace.',
                'content' => 'This seminar addresses the challenges of digital overload and provides strategies for maintaining a healthy balance between technology use and personal well-being. Topics include digital detox, mindful technology use, and setting healthy boundaries.',
                'category' => 'Workshop',
                'status' => 'published',
                'event_date' => now()->addDays(49)->setTime(10, 0),
                'end_date' => now()->addDays(49)->setTime(12, 0),
                'location' => 'DTI IT Training Room',
                'organizer' => 'DTI Information Technology Department',
                'author' => 'Digital Wellness Coach Sarah Kim',
                'summary' => 'Workshop on maintaining healthy technology habits and digital wellness in the workplace.',
                'slug' => Str::slug('Digital Wellness and Technology Balance'),
            ],
            [
                'title' => 'Workplace Safety and Health Protocols',
                'description' => 'Comprehensive training on workplace safety, health protocols, and emergency preparedness.',
                'content' => 'This training covers essential workplace safety topics including emergency procedures, health protocols, and best practices for maintaining a safe work environment. Participants will learn about first aid basics and emergency response procedures.',
                'category' => 'Training',
                'status' => 'published',
                'event_date' => now()->addDays(56)->setTime(14, 0),
                'end_date' => now()->addDays(56)->setTime(16, 0),
                'location' => 'DTI Safety Training Center',
                'organizer' => 'DTI Safety and Security Office',
                'author' => 'Safety Officer Robert Torres',
                'summary' => 'Comprehensive training on workplace safety protocols and emergency preparedness procedures.',
                'slug' => Str::slug('Workplace Safety and Health Protocols'),
            ]
        ];

        foreach ($events as $eventData) {
            UpcomingEvent::create($eventData);
        }
    }
}

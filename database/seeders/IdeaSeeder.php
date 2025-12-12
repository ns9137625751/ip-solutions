<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Idea;
use Illuminate\Database\Seeder;

class IdeaSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        
        if (!$user) {
            $user = User::create([
                'name' => 'Demo User',
                'email' => 'demo@example.com',
                'password' => bcrypt('password'),
                'is_admin' => false,
            ]);
        }

        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'),
                'is_admin' => true,
            ]
        );

        $ideas = [
            [
                'title' => 'AI-Powered Healthcare Diagnosis System',
                'summary' => 'An innovative AI system that can diagnose diseases from medical images with 95% accuracy. Uses deep learning and computer vision to assist doctors in early detection of critical conditions.',
                'stage' => 'Prototype',
                'domain' => 'Healthcare',
                'technology_type' => 'Artificial Intelligence',
                'co_applicants_needed' => 2,
                'funding_requirement' => 5000000,
                'status' => 'approved',
                'is_featured' => true,
            ],
            [
                'title' => 'Smart Agriculture IoT Solution',
                'summary' => 'IoT-based system for precision farming that monitors soil moisture, temperature, and crop health in real-time. Helps farmers optimize water usage and increase crop yield by 30%.',
                'stage' => 'Patent Filed',
                'domain' => 'Agriculture',
                'technology_type' => 'IoT',
                'co_applicants_needed' => 3,
                'funding_requirement' => 3000000,
                'status' => 'approved',
                'is_featured' => true,
            ],
            [
                'title' => 'Blockchain-Based Supply Chain Tracker',
                'summary' => 'Transparent supply chain management system using blockchain technology. Ensures product authenticity and tracks goods from manufacturer to consumer.',
                'stage' => 'Proof of Concept',
                'domain' => 'Logistics',
                'technology_type' => 'Blockchain',
                'co_applicants_needed' => 2,
                'funding_requirement' => 4000000,
                'status' => 'approved',
                'is_featured' => false,
            ],
            [
                'title' => 'Renewable Energy Storage System',
                'summary' => 'Novel battery technology for efficient storage of solar and wind energy. 40% more efficient than current lithium-ion batteries with longer lifespan.',
                'stage' => 'Ideation',
                'domain' => 'Energy',
                'technology_type' => 'Hardware',
                'co_applicants_needed' => 4,
                'funding_requirement' => 10000000,
                'status' => 'approved',
                'is_featured' => true,
            ],
            [
                'title' => 'EdTech Personalized Learning Platform',
                'summary' => 'AI-driven educational platform that adapts to individual student learning styles and pace. Provides personalized curriculum and real-time feedback.',
                'stage' => 'Commercial Stage',
                'domain' => 'Education',
                'technology_type' => 'Software',
                'co_applicants_needed' => 1,
                'funding_requirement' => 2000000,
                'status' => 'approved',
                'is_featured' => false,
            ],
            [
                'title' => 'Water Purification Nanotechnology',
                'summary' => 'Nano-filter technology that removes 99.9% of contaminants from water at low cost. Portable and suitable for rural areas without electricity.',
                'stage' => 'Prototype',
                'domain' => 'Environment',
                'technology_type' => 'Nanotechnology',
                'co_applicants_needed' => 2,
                'funding_requirement' => 6000000,
                'status' => 'approved',
                'is_featured' => true,
            ],
        ];

        foreach ($ideas as $ideaData) {
            Idea::create(array_merge($ideaData, ['user_id' => $user->id]));
        }
    }
}

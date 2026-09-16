<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Seeds the 6 real Al-Falah Marketing services — same data as the live site
     * and the Base44 Al-Falah Services backend, so this isn't empty on first run.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Web Development',
                'short_description' => "Custom-coded, high-performance websites designed to convert visitors into customers 24/7.",
                'description' => "We build lightning-fast, mobile-friendly websites that don't just look good—they perform. From landing pages to full web applications, every site is crafted to drive conversions and grow your business.",
                'features' => ['Custom Web Apps', 'E-commerce Solutions', 'CMS Integration', 'Mobile-Friendly Design', 'Speed Optimization'],
                'price' => 499,
                'price_label' => '',
                'currency' => 'USD',
                'category' => 'Development',
                'icon_name' => 'Code',
                'image_url' => 'https://images.unsplash.com/photo-1547658719-da2b51169166?w=800',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Digital Marketing',
                'short_description' => 'Data-driven growth strategies from Local SEO to Google Ads that get you found by the right audience.',
                'description' => 'We ensure your business ranks high and gets found by the right audience. Our data-driven strategies combine SEO, paid advertising, and email marketing to drive measurable growth.',
                'features' => ['SEO & SEM', 'Social Media Ads', 'Email Marketing', 'Local SEO', 'Google Ads Management'],
                'price' => 299,
                'price_label' => '/mo',
                'currency' => 'USD',
                'category' => 'Marketing',
                'icon_name' => 'TrendingUp',
                'image_url' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Branding & Design',
                'short_description' => 'Visual identities that tell your story and build trust with professional logos and brand guidelines.',
                'description' => 'We create visual identities that tell your story. Professional logos, UI/UX design, and brand guidelines that build trust and authority in your market.',
                'features' => ['Logo & Visual Identity', 'UI/UX Design', 'Marketing Collateral', 'Brand Guidelines', 'Social Media Kits'],
                'price' => 199,
                'price_label' => '',
                'currency' => 'USD',
                'category' => 'Design',
                'icon_name' => 'Palette',
                'image_url' => 'https://images.unsplash.com/photo-1626785774573-4b799315345d?w=800',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'AI & Automation',
                'short_description' => 'AI chatbots and automated workflows that save you hours of manual work every day.',
                'description' => 'Work smarter, not harder. We implement AI chatbots and automated lead nurture workflows to save you hours of manual work every day, while improving customer engagement.',
                'features' => ['AI Chatbots', 'CRM Automation', 'Workflow Optimization', 'Lead Nurturing', 'Smart Integrations'],
                'price' => 399,
                'price_label' => '',
                'currency' => 'USD',
                'category' => 'AI',
                'icon_name' => 'Bot',
                'image_url' => 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?w=800',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Content Creation',
                'short_description' => 'High-quality blogs, videos, and social media content that positions you as an industry leader.',
                'description' => 'Content that converts. Our team produces high-quality blogs, videos, and social media content that positions you as a leader in your industry and drives engagement.',
                'features' => ['Video Marketing', 'Blog & Copywriting', 'Graphics Production', 'Social Media Content', 'Content Strategy'],
                'price' => 149,
                'price_label' => '',
                'currency' => 'USD',
                'category' => 'Content',
                'icon_name' => 'Video',
                'image_url' => 'https://images.unsplash.com/photo-1492619375914-88005aa9e8fb?w=800',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'IT Solutions',
                'short_description' => 'Reliable tech support from secure cloud hosting to enterprise IT management for smooth operations.',
                'description' => 'Reliable tech support for your growth. From secure cloud hosting to enterprise IT management, we keep your digital operations running smooth and secure.',
                'features' => ['Cloud Hosting', 'Cyber Security', 'Tech Support', 'Server Management', 'Data Backup'],
                'price' => 199,
                'price_label' => '/mo',
                'currency' => 'USD',
                'category' => 'IT',
                'icon_name' => 'Server',
                'image_url' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=800',
                'is_active' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(['name' => $service['name']], $service);
        }
    }
}

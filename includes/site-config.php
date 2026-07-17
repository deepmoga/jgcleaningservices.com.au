<?php
/**
 * Central website content.
 *
 * Keeping editable content in one place makes this homepage ready to be
 * connected to the future administration panel and database.
 */

$site = [
    'name' => 'JG Cleaning Services',
    'short_name' => 'JG Cleaning',
    'phone_display' => '0450 785 456',
    'phone_link' => '+61450785456',
    'email' => 'info@jgcleaningservices.com.au',
    'address' => 'PO BOX 1396, Clayton VIC 3169',
    'hours' => 'Mon–Sat: 8:00am–10:00pm',
    'closed' => 'Sunday closed',
];

$services = [
    [
        'number' => '01',
        'title' => 'Builders Cleaning',
        'slug' => 'builders-cleaning',
        'icon' => 'builder',
        'description' => 'Detailed post-construction cleaning that removes dust, debris and marks so your new or renovated space is ready to use.',
    ],
    [
        'number' => '02',
        'title' => 'Office Cleaning',
        'slug' => 'office-cleaning',
        'icon' => 'office',
        'description' => 'Reliable commercial office cleaning tailored around your operating hours for a healthier, more productive workplace.',
    ],
    [
        'number' => '03',
        'title' => 'Window Cleaning',
        'slug' => 'window-cleaning',
        'icon' => 'window',
        'description' => 'Professional interior and exterior window cleaning for clear glass, polished frames and a brighter property.',
    ],
    [
        'number' => '04',
        'title' => 'Carpet Cleaning',
        'slug' => 'carpet-cleaning',
        'icon' => 'carpet',
        'description' => 'Deep carpet cleaning to lift embedded dirt, common stains and odours while refreshing tired fibres.',
    ],
    [
        'number' => '05',
        'title' => 'Pressure Cleaning',
        'slug' => 'pressure-cleaning',
        'icon' => 'pressure',
        'description' => 'Powerful exterior cleaning for driveways, paths, walls and hard surfaces with a careful, professional finish.',
    ],
    [
        'number' => '06',
        'title' => 'Curtain Cleaning',
        'slug' => 'curtain-cleaning',
        'icon' => 'curtain',
        'description' => 'Specialist curtain care that removes settled dust and helps restore a fresher look without unnecessary disruption.',
    ],
];

$testimonials = [
    [
        'quote' => 'JG Cleaning Services left our office looking immaculate. The team was punctual, respectful and paid attention to the small details that make a big difference.',
        'name' => 'Michael R.',
        'role' => 'Office Manager, Clayton',
        'initials' => 'MR',
    ],
    [
        'quote' => 'We booked a builders clean after a major renovation. They removed the fine dust from everywhere and handed back a space that finally felt ready to enjoy.',
        'name' => 'Sarah T.',
        'role' => 'Property Owner, Melbourne',
        'initials' => 'ST',
    ],
    [
        'quote' => 'Friendly service, clear communication and excellent results on our carpets and windows. I would happily recommend the JG team.',
        'name' => 'Daniel K.',
        'role' => 'Local Business Owner',
        'initials' => 'DK',
    ],
];

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}


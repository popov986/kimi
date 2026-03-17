<?php
/**
 * Shared gallery data: categories, projects (title, date, cat, files). Used by home.php and gallery.php.
 * Include once; then use $gallery_cats, $gallery_projects_by_folder and $gallery_grid.
 */

// Filter categories: slug => label (for "All projects" filter menu). Order defines menu order.
$gallery_cats = [
    'cat1' => tr('Tiles'),
    'cat2' => tr('Drywall'),
    'cat3' => tr('Renovations'),
    'cat4' => tr('Interior Design'),
    'cat5' => tr('Videos'),
];

$gallery_projects_by_folder = [
    'project 18' => [
        'title' => tr('Project 18'),
        'date' => tr('Match 2026'),
        'cat' => 'cat1 cat3',
        'front_image' => 'project18_1.jpg',
        'files' => [
            'project18_2.jpg', 'project18_3.jpg', 'project18_4.jpg', 'project18_5.jpg', 'project18_6.jpg'
        ],
    ],
    'project 17' => [
        'title' => tr('Project 17'),
        'date' => tr('Match 2026'),
        'cat' => 'cat2',
        'front_image' => 'project17_3.jpeg',
        'files' => [
            'project17_1.jpeg', 'project17_2.jpeg', 'project17_3.jpeg', 'project17_4.jpeg', 'project17_5.jpeg',
            'project17_6.jpeg', 'project17_7.jpeg', 'project17_8.jpeg', 'project17_9.jpeg', 'project17_10.jpeg'
        ],
    ],
    'project 1' => [
        'title' => tr('Project'),
        'date' => tr('February 2026'),
        'cat' => 'cat1 cat2',
        'front_image' => 'project1_1.jpg',
        'files' => [
            'project1_5.jpg', 'project1_2.jpg', 'project1_3.jpg', 'project1_4.jpg', 'project1_6.jpg',
            'project1_7.jpg', 'project1_8.jpg','project1_9.jpg','project1_10.jpg','project1_11.jpg'
        ],
    ],
    'project 2' => [
        'title' => tr('Project'),
        'date' => tr('February 2026'),
        'cat' => 'cat4',
        'front_image' => 'project2_3.jpg',
        'files' => ['project2_2.jpg', 'project2_1.jpg'],
    ],
    'project 3' => [
        'title' => tr('Project'),
        'date' => tr('February 2026'),
        'cat' => 'cat1 cat2 cat3',
        'front_image' => 'project3_4.jpg',
        'files' => ['project3_5.jpg', 'project3_1.jpg', 'project3_2.jpg', 'project3_3.jpg'],
    ],
    'project 4' => [
        'title' => tr('Project 4'),
        'date' => tr('February 2026'),
        'cat' => 'cat1 cat4',
        'front_image' => 'project4_1.jpg',
        'files' => ['project4_2.jpg','project4_3.jpg','project4_4.jpg'],
    ],
    'project 5' => [
        'title' => tr('Project'),
        'date' => tr('February 2026'),
        'cat' => 'cat1 cat3 cat4',
        'front_image' => 'project5_4.jpg',
        'files' => [
            'project5_2.jpg', 'project5_5.jpg', 'project5_6.jpg', 'project5_7.jpg',
            'project5_8.jpg', 'project5_10.jpg', 'project5_1.jpg', 'project5_3.jpg'
        ],
    ],
    'project 6' => [
        'title' => tr('Project'),
        'date' => tr('February 2026'),
        'cat' => 'cat1 cat3 cat4',
        'front_image' => 'project6_2.jpg',
        'files' => ['project6_3.jpg', 'project6_1.jpg'],
    ],
    'project 7' => [
        'title' => tr('Project'),
        'date' => tr('February 2026'),
        'front_image' => 'project7_3.jpg',
        'cat' => 'cat3 cat4',
        'files' => ['project7_1.jpg', 'project7_2.jpg', 'project7_4.jpg'],
    ],
    'project 8' => [
        'title' => tr('Project'),
        'date' => tr('February 2026'),
        'cat' => 'cat3 cat4',
        'front_image' => 'project8_1.jpg',
        'files' => ['project8_2.jpg','project8_1.jpg', 'project8_2.jpg'],
    ],
    'project 9' => [
        'title' => tr('Project'),
        'date' => tr('February 2026'),
        'cat' => 'cat1 cat2',
        'front_image' => 'project9_1.jpg',
        'files' => [
            'project9_3.jpg', 'project9_6.jpg', 'project9_7.jpg', 'project9_9.jpg',
            'project9_10.jpg', 'project9_1.jpg', 'project9_2.jpg', 'project9_4.jpg', 'project9_5.jpg','project9_8.jpg'
        ],
    ],
    'project 10' => [
        'title' => tr('Project'),
        'date' => tr('February 2026'),
        'cat' => 'cat1',
        'front_image' => 'project10_4.jpg',
        'files' => [
            'project10_1.jpg', 'project10_2.jpg', 'project10_3.jpg', 'project10_6.jpg', 'project10_7.jpg',
            'project10_8.jpg',  'project10_10.jpg', 'project10_9.jpg', 'project10_5.jpg',
        ],
    ],
    'project 11' => [
        'title' => tr('Project'),
        'date' => tr('February 2026'),
        'cat' => 'cat1 cat2 cat3 cat4',
        'front_image' => 'project11_7.jpg',
        'files' => [
            'project11_2.jpg', 'project11_3.jpg', 'project11_4.jpg',
            'project11_6.jpg', 'project11_8.jpg', 'project11_5.jpg', 'project11_1.jpg',
        ],
    ],
    'project 12' => [
        'title' => tr('Project'),
        'date' => tr('February 2026'),
        'cat' => 'cat1 cat2 cat3 cat4',
        'front_image' => 'project12_2.jpg',
        'files' => [
            'project12_3.jpg', 'project12_4.jpg','project12_5.jpg',
            'project12_6.jpg','project12_7.jpg', 'project12_1.jpg'
        ],
    ],
    'project 13' => [
        'title' => tr('Project'),
        'date' => tr('February 2026'),
        'cat' => 'cat1 cat3',
        'front_image' => 'project13_7.jpg',
        'files' => [
            'project13_4.jpg', 'project13_6.jpg', 'project13_1.jpg',
            'project13_2.jpg', 'project13_3.jpg', 'project13_5.jpg'
        ],
    ],
    'project 14' => [
        'title' => tr('Project'),
        'date' => tr('February 2026'),
        'cat' => 'cat1 cat3',
        'front_image' => 'project14_4.jpeg',
        'files' => [
            'project14_1.jpeg', 'project14_2.jpeg', 'project14_3.jpeg',
            'project14_5.jpeg', 'project14_6.jpeg'
        ],
    ],
    'project 15' => [
        'title' => tr('Project'),
        'date' => tr('February 2026'),
        'cat' => 'cat1',
        'front_image' => 'project15_1.jpeg',
        'files' => ['project15_2.jpeg', 'project15_3.jpeg'],
    ],
    'project 16' => [
        'title' => tr('Project'),
        'date' => tr('February 2026'),
        'cat' => 'cat1',
        'front_image' => 'project16_1.jpeg',
        'files' => ['project16_2.jpeg', 'project16_3.jpeg'],
    ],
];

// Sort by project number: 1, 2, 3, ... 16
//uksort($gallery_projects_by_folder, function ($a, $b) {
//    return (int) preg_replace('/\D/', '', $a) - (int) preg_replace('/\D/', '', $b);
//});

// For gallery.php grid: folder => list of files
$gallery_grid = [];
foreach ($gallery_projects_by_folder as $folder => $data) {
    $gallery_grid[$folder] = $data['files'];
}

// Videos: same folder structure as projects. Each video has its own folder under gallery/videos/ (e.g. video 1, video 2).
$gallery_videos_by_folder = [
    'video 1' => [
        'title' => tr('Video 1'),
        'date' => '',
        'cat' => 'cat5',
        'front_image' => 'video1.png',
        'files' => ['video1.mp4'],
        'is_video' => true,
    ],
    'video 2' => [
        'title' => tr('Video 2'),
        'date' => '',
        'cat' => 'cat5',
        'front_image' => 'video2.png',
        'files' => ['video2.mp4'],
        'is_video' => true,
    ],
    'video 3' => [
        'title' => tr('Video 3'),
        'date' => '',
        'cat' => 'cat5',
        'front_image' => 'video3.png',
        'files' => ['video3.mp4'],
        'is_video' => true,
    ],
];

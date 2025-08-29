<?php

return [
  'filesystem' => [
    'name' => 'imedia::filesystem',
    'default' => 's3'
  ],
  'allowedImageTypes' => [
    'name' => 'imedia::allowedImageTypes',
    'default' => ['jpg', 'png', 'jpeg', 'webp'],
    'dynamicField' => [
      'type' => 'select',
      'columns' => 'col-12 col-md-6',
      'props' => [
        'type' => 'select',
        'useInput' => true,
        'useChips' => true,
        'multiple' => true,
        'hideDropdownIcon' => true,
        'newValueMode' => 'add-unique',
        'label' => 'imedia::settings.label.allowedImageTypes',
      ],
    ]
  ],
  'allowedFileTypes' => [
    'name' => 'imedia::allowedFileTypes',
    'default' => ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'svg'],
    'dynamicField' => [
      'type' => 'select',
      'columns' => 'col-12 col-md-6',
      'props' => [
        'useInput' => true,
        'useChips' => true,
        'multiple' => true,
        'hideDropdownIcon' => true,
        'newValueMode' => 'add-unique',
        'label' => 'imedia::settings.label.allowedFileTypes',
      ]
    ]
  ],
  'allowedVideoTypes' => [
    'name' => 'imedia::allowedVideoTypes',
    'default' => ['mp4', 'webm', 'ogg'],
    'dynamicField' => [
      'type' => 'select',
      'columns' => 'col-12 col-md-6',
      'props' => [
        'useInput' => true,
        'useChips' => true,
        'multiple' => true,
        'hideDropdownIcon' => true,
        'newValueMode' => 'add-unique',
        'label' => 'imedia::settings.label.allowedVideoTypes',
      ]
    ]
  ],
  'allowedAudioTypes' => [
    'name' => 'imedia::allowedAudioTypes',
    'default' => ['mp3', 'avi'],
    'dynamicField' => [
      'type' => 'select',
      'columns' => 'col-12 col-md-6',
      'props' => [
        'useInput' => true,
        'useChips' => true,
        'multiple' => true,
        'hideDropdownIcon' => true,
        'newValueMode' => 'add-unique',
        'label' => 'imedia::settings.label.allowedAudioTypes',
      ]
    ]
  ],
  'allowedRatios' => [
    'name' => 'imedia::allowedRatios',
    'default' => ['16:9', '4:3', '1:1', '2:3', 'free'],
    'dynamicField' => [
      'type' => 'select',
      'columns' => 'col-12 col-md-6',
      'props' => [
        'useInput' => true,
        'useChips' => true,
        'multiple' => true,
        'hideDropdownIcon' => true,
        'newValueMode' => 'add-unique',
        'label' => 'imedia::settings.label.allowedRatios',
      ]
    ]
  ],
  'maxFileSize' => [
    'name' => 'imedia::maxFileSize',
    'default' => '10',
    'dynamicField' => [
      'type' => 'input',
      'columns' => 'col-12 col-md-6',
      'props' => [
        'label' => 'imedia::settings.label.maxFileSize',
      ]
    ]
  ],
  'maxTotalSize' => [
    'name' => 'imedia::maxTotalSize',
    'default' => 1000000000,
    'dynamicField' => [
      'type' => 'input',
      'columns' => 'col-12 col-md-6',
      'props' => [
        'label' => 'imedia::settings.label.maxTotalSize',
      ]
    ]
  ],

  'thumbnails' => [
    'name' => 'imedia::thumbnails',
    'default' => [
      'smallThumb' => [
        'quality' => 80,
        'width' => 300,
        'height' => null,
        'aspectRatio' => true,
        'upsize' => true,
        'format' => 'webp',
      ],
      'mediumThumb' => [
        'quality' => 80,
        'width' => 600,
        'height' => null,
        'aspectRatio' => true,
        'upsize' => true,
        'format' => 'webp',
      ],
      'largeThumb' => [
        'quality' => 80,
        'width' => 900,
        'height' => null,
        'aspectRatio' => true,
        'upsize' => true,
        'format' => 'webp',
      ],
      'extraLargeThumb' => [
        'quality' => 80,
        'width' => 1920,
        'height' => null,
        'aspectRatio' => true,
        'upsize' => true,
        'format' => 'webp',
      ],
    ],
    'dynamicField' => [
      'label' => 'Thumbnail Config',
      'type' => 'json',
      'columns' => 'col-12',
      'props' => [
        'label' => 'imedia::settings.label.thumbnails',
        'type' => 'textarea',
      ]
    ]
  ],
  'defaultImageSize' => [
    'name' => 'imedia::defaultImageSize',
    'default' => ['width' => 1920, 'height' => 1920, 'quality' => 90],
    'dynamicField' => [
      'label' => 'Default Image Size',
      'type' => 'json',
      'columns' => 'col-12',
      'props' => [
        'label' => 'imedia::settings.label.defaultImageSize',
        'type' => 'textarea',
      ]
    ]
  ]
];

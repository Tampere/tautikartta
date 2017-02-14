<?php
function translateICD($icd)
{
    $ICDCODES = [
        '',
        'Influenssa ja influenssan kaltaiset taudit',
        'Vatsataudit (tai ripuli- oksennustaudit)',
        'Vesirokko',
        'Streptokokin aiheuttamat nieluinfektiot ja tulirokko',
        'Aikuistyypin diabetes',
        'Klamydia'
    ];
    return $ICDCODES[$icd];
}
<?php

function months($month){
    $monthes = [
        '01' => 'يناير',
        '02' => 'فبراير',
        '03'=> 'مارس',
        '04'=> 'ابريل',
        '05'=> 'مايو',
        '06'=> 'يونيو',
        '07'=> 'يوليو',
        '08'=> 'اغسطس',
        '09'=> 'سبتمبر',
        '10'=> 'أكتوبر',
        '11'=> 'نوفمبر',
        '12'=> 'ديسمبر',
    ];
    return $monthes[$month];
}

function period($period){
    $periods = [
        'AM' => 'صباحاً',
        'PM' => 'مساءاً'
    ];
    return $periods[$period];
}

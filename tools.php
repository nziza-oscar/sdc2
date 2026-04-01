<?php
function displayBanner($title = "") {
    if (empty($title)) {
        $title = "Page Title";
    }
    
    $output = '
    <section class=" py-20 banner-bg mt-8 ">
        <div class="px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white">
                ' . $title . '
            </h1>
        </div>
    </section>
    ';
    
    echo $output;
}
?>
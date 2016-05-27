<?php

if (!function_exists('create_breadcrumb')) {

    function create_breadcrumb() {
        $ci = &get_instance();
        $i = 1;
        $uri = $ci->uri->segment($i);
        $link = '<ul class="breadcrumb1"><li>You are here:</li>';

        while ($uri != '') {
            $prep_link = '';
            for ($j = 1; $j <= $i; $j++) {
                $prep_link .= $ci->uri->segment($j) . '/';
            }

            if ($ci->uri->segment($i + 1) == '') {
                $link.='<li><a title="" class="tip" href="index.php" data-original-title="back to dashboard"><i class="s16 icomoon-icon-screen-2"></i></a></li>';
                $link.='<span class="divider"><i class="s16 icomoon-icon-arrow-right-3"></i></span>';
                $link.='<li><a href="' . site_url($prep_link) . '">';
                $link.=$ci->uri->segment($i) . '</a></li> ';
            } else {
                $link.='<span class="divider"><i class="s16 icomoon-icon-arrow-right-3"></i></span>';
                $link.='<li><a href="' . site_url($prep_link) . '">';
                $link.=$ci->uri->segment($i) . '</a></li> ';
            }

            $i++;
            $uri = $ci->uri->segment($i);
        }
        $link .= '</ul>';
        return $link;
    }

}

// <ul class="breadcrumb"><li>You are here:</li><li><a title="" class="tip" href="index.html" data-original-title="back to dashboard"><i class="s16 icomoon-icon-screen-2"></i></a></li><span class="divider"><i class="s16 icomoon-icon-arrow-right-3"></i></span><li>Dashboard</li></ul>
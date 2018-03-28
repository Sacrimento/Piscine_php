<?php

    function ft_is_sort($array)
    {
	    $diff = $array;
	    sort($diff);
	    return array_diff_assoc($array, $diff) ? false : true;
    }

?>
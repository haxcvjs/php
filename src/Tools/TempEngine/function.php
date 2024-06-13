<?php

return function ($var) {

    foreach ($var as $key => $value) {
        $$key = $value;
    }
    
?>{{code}}<?php

}
?>
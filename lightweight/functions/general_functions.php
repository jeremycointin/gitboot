<?


function lower_with_underscores($string) {

   $string = strtolower ( $string );
   
   $string = str_replace(' ', '_', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\_]/', '', $string); // Removes special chars.
}

function lower_no_spaces($string) {

   $string = strtolower ( $string );

   return preg_replace('/[^A-Za-z0-9\_]/', '', $string); // Removes special chars.
}

function make_slug($string) {

   $string = strtolower ( $string );
   
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}



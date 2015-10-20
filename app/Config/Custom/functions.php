<?php

    /**
     * String functions
     */

    function string_urlFriendly( $string = '' )
    {
        $output = '';
        if( isset( $string ) && ( strlen( $string ) > 0 ) )
        {
            $output = '';
            $output = str_replace( ':', '-', $string );
            $output = str_replace( '%', ' percent ', $string );
			$output = ereg_replace( "[-]+", "-", ereg_replace( "[^a-z0-9-]", "", strtolower( str_replace( " ", "-", $string ) ) ) );
        }
        return $output;
    }
		
    function time_ago ($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'tahun',
            'm' => 'bulan',
            'w' => 'minggu',
            'd' => 'hari',
            'h' => 'jam',
            'i' => 'menit',
            's' => 'detik',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v;
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ' . 'yang lalu' : 'baru saja';
    }         
    /*
    public function string_limitWord( $string = '', $word_limit = 32 )
    {
        $string = trim( $string );
        $string = strip_tags( $string );
        $string = preg_replace( array('/\s{2,}/', '/[\t\n]/'), ' ', $string );
        $words  = explode( " ", $string );
        return implode( " ", array_splice( $words, 0, $word_limit ) );
    }
    */

    function convert_to_csv($input_array, $output_file_name, $delimiter) // convert_to_csv($array_to_csv, 'report.csv', ',');
    {
        /** open raw memory as file, no need for temp files */
        $temp_memory = fopen('php://memory', 'w');
        /** loop through array  */
        foreach ($input_array as $line) {
            /** default php csv handler **/
            fputcsv($temp_memory, $line, $delimiter);
        }
        /** rewrind the "file" with the csv lines **/
        fseek($temp_memory, 0);
        /** modify header to be downloadable csv file **/
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename={$output_file_name}.csv");
        header("Pragma: no-cache");
        header("Expires: 0");        /** Send file to browser for download */
        fpassthru($temp_memory);
    }

    function number2roman($num,$isUpper=true) {
        $n = intval($num);
        $res = '';

        /*** roman_numerals array ***/
        $roman_numerals = array(
            'M' => 1000,
            'CM' => 900,
            'D' => 500,
            'CD' => 400,
            'C' => 100,
            'XC' => 90,
            'L' => 50,
            'XL' => 40,
            'X' => 10,
            'IX' => 9,
            'V' => 5,
            'IV' => 4,
            'I' => 1
        );

        foreach ($roman_numerals as $roman => $number)
        {
            /*** divide to get matches ***/
            $matches = intval($n / $number);

            /*** assign the roman char * $matches ***/
            $res .= str_repeat($roman, $matches);

            /*** substract from the number ***/
            $n = $n % $number;
        }

        /*** return the res ***/
        if($isUpper) return $res;
        else return strtolower($res);
    }
    
    function sum_subarrays_by_key( $tab, $key ) {
            
        $sum = 0;

        foreach($tab as $sub_array) {
            $sum += $sub_array[$key];
        }
        
        return $sum;
        
    }

    function rem_array( $array, $str ){
        
        foreach ( $array as $key => $value) {
            if ($array[$key] == "$str") unset($array[$key]);
        }
        return $array;
    }

    function discount( $price, $discount )
    {
        return $price * ( $discount / 100 );
    }

    function text_status( $status = 0, $text = array() )
    {
        $output = '';
        if( is_numeric( $status ) )
        {
            switch( $status )
            {
                case 0:
                    $output = TEXT_ENABLED;
                    break;
                case 1:
                    $output = TEXT_DISABLED;
                    break;
            }
        }
        return $output;
    }

    function text_done( $status = 0, $text = array() )
    {
        $output = '';
        if( is_numeric( $status ) )
        {
            switch( $status )
            {
                case 0:
                    $output = TEXT_DONE;
                    break;
                case 1:
                    $output = TEXT_NOT_DONE;
                    break;
            }
        }
        return $output;
    }

    function text_approved( $status = 0, $text = array() )
    {
        $output = '';
        if( is_numeric( $status ) )
        {
            switch( $status )
            {
                case 0:
                    $output = TEXT_NOT_APPROVED;
                    break;
                case 1:
                    $output = TEXT_APPROVED;
                    break;
            }
        }
        return $output;
    }
    
    /**
     * Bootstrap functions
     */

    function bootstrap_nav_active( $controller = '', $value = '', $show_class = true, $active_class = 'active' )
    {
        $output = '';  
        
        if( is_array( $value ) )
        {
            if( in_array( $controller, $value ) )
            {
                $output = ' ' . $active_class . ' ';

                if( $show_class ) $output = ' class=" ' . $active_class . ' " ';
            }
        }
        else
        {
            if( $controller == $value )
            {
                $output = ' ' . $active_class . ' ';

                if( $show_class ) $output = ' class=" ' . $active_class . ' " ';
            }
        }
        return $output;
    }

    function bootstrap_row_status( $status = 0 )
    {
        $output = '';
        if( is_numeric( $status ) )
        {
            switch( $status )
            {
                case 0:
                    $output = '';
                    break;
                case 1:
                    $output = 'danger';
                    break;
            }
        }
        return $output;
    }

    function bootstrap_row_status_type2( $status = 0 )
    {
        $output = '';
        if( is_numeric( $status ) )
        {
            switch( $status )
            {
                case 0:
                    $output = 'danger';
                    break;
                case 1:
                    $output = '';
                    break;
            }
        }
        return $output;
    }

    function bootstrap_print_navbar( $array = array() )
    {

        if( isset( $array ) && is_array( $array ) )
        {
            $length = count( $array );

            if( isset( $array[ 'children' ] ) )
            {
                if( count( $array[ 'children' ] ) > 0 )
                {
                    for( $i = 0; $i < count( $array[ 'children' ] ); $i++ )
                    {
                        $row = $array[ 'children' ][ $i ];

                        if( isset( $row[ 'PostCategory' ] ) )
                        {
                            if( isset( $row[ 'children' ] ) && ( count( $row[ 'children' ] ) > 0 ) )
                            {
                                echo '<li class="dropdown">'; 
                                echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown">';
                                echo $row[ 'PostCategory' ][ 'name' ];
                                echo '<b class="caret"></b></a>';
                                echo '<ul class="dropdown-menu">';
                                bootstrap_print_navbar( $row );
                                echo '</ul>';
                                echo '</li>';
                            }
                            else
                            {
                                $url = Router::url( 
                                    array( 
                                        'controller' => 'posts', 
                                        'action' => 'category', 
                                        $row[ 'PostCategory' ][ 'id' ],
                                        string_urlFriendly( $row[ 'PostCategory' ][ 'name' ] )
                                    ) 
                                );
                                echo '<li>';
                                echo '<a href="' . $url . '">';
                                echo $row[ 'PostCategory' ][ 'name' ];
                                echo '</a>';
                                echo '</li>';
                            }


                        }
                    }
                }
            }

        }
    }

    /**
     * Date functions
     */

    

    /**
     * Awesome & useful functions
     */

    function isMobileBrowser()
    {
        $useragent = $_SERVER[ 'HTTP_USER_AGENT' ];
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
            {
                return true;
            }
            else
            {
                return false;
            }
    }

?>
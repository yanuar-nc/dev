<?php

$a1 = array( 
    0 => array(
        'nama' => 'jancuk',
        'notelp' => array(
            '0991',
            '0992'
        )
    ),
    1 => array(
        'nama' => 'jaenap',
        'notelp' => array(
            '0191',
            '0492'
        )
    ),
    2 => array(
        'nama' => 'jancuk',
        'notelp' => array(
            '0994',
            '0993'
        )
    )
);

$a2 = array();
foreach( $a1 as $key => $val )
{
    $a2[ $key ] = $val;
    foreach( $a2 as $key_2 => $val_2 )
    {
        $x1 = $a1[ $key ]; 
        if ( $x1[ 'nama' ] == @$a2[ $key_2 ][ 'nama' ] && ( $x1 != @$a2[ $key_2 ] ) )
        {
            $a2[ $key_2 ][ 'notelp' ] = array_merge($a2[ $key_2 ][ 'notelp' ], $x1[ 'notelp' ]);
            unset( $a2[ $key ] );
        }
    }

}
pr( $a2 ); // print_r();
unset( $a2 );
?>
<br>
<?php
$obj = json_decode('[
    {
        "id_template": "2",
        "nama": "Kuesioner Evaluasi Pembelajaran",
        "kompetensi": [
            {
                "id_kompetensi": "1",
                "nama_kompetensi": "Kompetensi Pedagogik",
                "butir": [
                    {
                        "id_butir": "6",
                        "butir": "Kesiapan memberikan kuliah dan atau praktik",
                        "jawaban": "5"
                    },
                    {
                        "id_butir": "7",
                        "butir": "Kelengkapan atribut mata kuliah (meliputi: kontrak kuliah, media ajar, problem solving, e-learning)",
                        "jawaban": "5"
                    }
                ]
            },
            {
                "id_kompetensi": "2",
                "nama_kompetensi": "Kompetensi Profesional",
                "butir": [
                    {
                        "id_butir": "10",
                        "butir": "Kemampuan menjelaskan pokok bahasan\/topik secara sistematis",
                        "jawaban": "5"
                    },
                    {
                        "id_butir": "11",
                        "butir": "Penguasaan terhadap materi pembelajaran",
                        "jawaban": "5"
                    }
                ]
            }
        ]
    },
    {
        "id_template": "2",
        "nama": "Kuesioner Evaluasi Pembelajaran",
        "kompetensi": [
            {
                "id_kompetensi": "1",
                "nama_kompetensi": "Kompetensi Pedagogik",
                "butir": [
                    {
                        "id_butir": "6",
                        "butir": "Kesiapan memberikan kuliah dan atau praktik",
                        "jawaban": "5"
                    },
                    {
                        "id_butir": "7",
                        "butir": "Kelengkapan atribut mata kuliah (meliputi: kontrak kuliah, media ajar, problem solving, e-learning)",
                        "jawaban": "5"
                    }
                ]
            },
            {
                "id_kompetensi": "2",
                "nama_kompetensi": "Kompetensi Profesional",
                "butir": [
                    {
                        "id_butir": "10",
                        "butir": "Kemampuan menjelaskan pokok bahasan\/topik secara sistematis",
                        "jawaban": "5"
                    },
                    {
                        "id_butir": "11",
                        "butir": "Penguasaan terhadap materi pembelajaran",
                        "jawaban": "5"
                    }
                ]
            }
        ]
    }
]');

$a2 = $hell = array();
foreach( $obj as $key => $val )
{
    $a2[ $key ] = $val;
    /*foreach( $obj[ $key ]->kompetensi as $key_1 => $val_1 )
    {
        $hell[ $key_1 ] = $val_1;*/
        foreach( $a2 as $key_2 => $val_2 )
        {
            $x1 = $obj[ $key ]; 
            //echo $val_1->nama_kompetensi."<br>";
            if ( @$val->nama == $val_2->nama && ( $x1 == @$a2[ $key_2 ] ) )
            {
                $a2[ $key_2 ]->kompetensi = array_merge($a2[ $key_2 ]->kompetensi, $x1->kompetensi);
                
                echo "bithc";
            } else {
                unset( $a2[ $key ] );
                echo "FUCK";
            }
        }

    //}

}


echo "<pre>";
print_r ($a2);
echo "</pre>";

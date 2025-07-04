<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaisController extends Controller
{
    private $paises = [
        [
            'pais' => 'ECUADOR',
            'estados' => [
                [
                    'estado' => 'AZUAY',
                    'ciudades' => [
                        'CAMILO PONCE',
                        'CHORDELEG',
                        'CUENCA',
                        'EL PAN',
                        'GIRON',
                        'GUACHAPALA',
                        'GUALACEO',
                        'NABON',
                        'OÑA',
                        'PAUTE',
                        'PUCARA',
                        'SAN FERNANDO',
                        'SANTA ISABEL',
                        'SEVILLA DE ORO',
                        'SIGSIG'
                    ]
                ],
                
                [
                    'estado' => 'BOLIVAR',
                    'ciudades' => [
                        'CALUMA',
                        'CHILLANES',
                        'CHIMBO',
                        'ECHEANDIA',
                        'GURANDA',
                        'LAS NAVES',
                        'SAN MIGUEL'
                    ]
                ],
                
                [
                    'estado' => 'CAÑAR',
                    'ciudades' => [
                        'AZOGUES',
                        'BIBLIAN',
                        'CAÑAR',
                        'DELEG',
                        'LA TRONCAL',
                        'SUSCAL',
                        'TAMBO'
                    ]
                ],
                
                [
                    'estado' => 'CARCHI',
                    'ciudades' => [
                        'BOLIVAR',
                        'ESPEJO',
                        'MIRA',
                        'MONTUFAR',
                        'SAN PEDRO DE HUACA',
                        'TULCAN'
                    ]
                ],
                
                [
                    'estado' => 'CHIMBORAZO',
                    'ciudades' => [
                        'ALAUSI',
                        'CHAMBO',
                        'CHUNCHI',
                        'COLTA',
                        'GUAMOTE',
                        'GUANO',
                        'PALLATANGA',
                        'PENIPE',
                        'RIOBAMBA'
                    ]
                ],
                
                [
                    'estado' => 'COTOPAXI',
                    'ciudades' => [
                        'LA MENA',
                        'LATACUNGA',
                        'PANGUA',
                        'PUJILI',
                        'SALCEDO',
                        'SAQUISILI',
                        'SIGCHO'
                    ]
                ],
                
                [
                    'estado' => 'EL ORO',
                    'ciudades' => [
                        'ARENILLAS',
                        'ATAHUALPA',
                        'BALSAS',
                        'CHILLA',
                        'EL GUABO',
                        'HUAQUILLAS',
                        'LAS LAJAS',
                        'MACHALA',
                        'MARCABELI',
                        'PASAJE',
                        'PINAS',
                        'PORTOVELO',
                        'SANTA ROSA',
                        'ZARUMA'
                    ]
                ],
                
                [
                    'estado' => 'ESMERALDAS',
                    'ciudades' => [
                        'ATACAMES',
                        'ELOY ALFARO',
                        'ESMERALDAS',
                        'MUISNE',
                        'QUININDE',
                        'RIO VERDE',
                        'SAN LORENZO'
                    ]
                ],
                
                [
                    'estado' => 'GALAPAGOS',
                    'ciudades' => [
                        'ISABELA',
                        'SAN CRISTOBAL',
                        'SANTA CRUZ'
                    ]
                ],
                
                [
                    'estado' => 'GUAYAS',
                    'ciudades' => [
                        'ALFREDO BAQUERIZO MORENO(JUJAN)',
                        'BALAO',
                        'BALZAR',
                        'COLIMES',
                        'DAULE',
                        'DURAN',
                        'EL TRIUNFO',
                        'EMPALME',
                        'GENERAL ANTONIO ELIZALDE (BUCAY)',
                        'GENERAL VILLAMIL (PLAYAS)',
                        'GUAYAQUIL',
                        'ISIDRO AYURA',
                        'LOMAS DE SARGENTILIO',
                        'MARCELINO MARIDUENA',
                        'MILAGRO',
                        'NARANJAL',
                        'NARANJITO',
                        'NOBOL (NARCISA DE JESUS)',
                        'PALESTINA',
                        'PEDRO CARBO',
                        'SAMBORONDON',
                        'SANRA LUCIA',
                        'SIMON BOLIVAR',
                        'URBINA JADO (SALITRE)',
                        'YAGUACHI'
                    ]
                ],
                
                [
                    'estado' => 'IMBABURA',
                    'ciudades' => [
                        'ATUNTAQUI (ANTONIO ANTE)',
                        'COTACACHI',
                        'IBARRA',
                        'OTAVALO',
                        'PIMAMPIRO',
                        'URCUQUI'
                    ]
                ],
                
                [
                    'estado' => 'LOJA',
                    'ciudades' => [
                        'CALVAS (CARIAMANGA)',
                        'CATAMAYO',
                        'CELICA',
                        'CHAGUARPAMBA',
                        'ESPINDOLA',
                        'GONZANAMA',
                        'LOJA',
                        'MACARA',
                        'OLMEDO',
                        'PALTAS (CATACOCHA)',
                        'PINDAL',
                        'PUYANGO (ALAMOR)',
                        'QUILANGA',
                        'SARAGURO',
                        'SOZARANGA',
                        'ZAPOTILlO'
                    ]
                ],
                
                [
                    'estado' => 'LOS RIOS',
                    'ciudades' => [
                        'BABA',
                        'BABHOYO',
                        'BUENA FE',
                        'MOCACHE',
                        'MONTALVO',
                        'PALENQUE',
                        'PUEBLO VIEJO',
                        'QUEVEDO',
                        'URDANETA',
                        'VALENCIA',
                        'VENTANAS',
                        'VINCES'
                    ]
                ],
                
                [
                    'estado' => 'MANABI',
                    'ciudades' => [
                        '24 DE MAYO',
                        'BOLIVAR',
                        'CHONE',
                        'EL CARMEN',
                        'FLAVIO ALFARO',
                        'JAMA',
                        'JARAMIJO',
                        'JIPIJAPA',
                        'JUNIN',
                        'MANTA',
                        'MONTECRISTI',
                        'OLMEDO',
                        'PAJAN',
                        'PEDERNALES',
                        'PICHINCHA',
                        'PORTOVIEJO',
                        'PUERTO LOPEZ',
                        'ROCAFUERTE',
                        'SAN VICENTE',
                        'SANTA ANA',
                        'SUCRE',
                        'TOSAGUA'
                    ]
                ],
                
                [
                    'estado' => 'MORONA SANTIAGO',
                    'ciudades' => [
                        'GUALAQUIZA',
                        'HUAMBOYA',
                        'LIMON-INDANZA',
                        'LOGROÑO',
                        'MORONA',
                        'PABLO Vl',
                        'PALORA',
                        'SAN JUAN BOSCO',
                        'SUCUA',
                        'TAISHA',
                        'TWINTZA'
                    ]
                ],
                
                [
                    'estado' => 'NAPO',
                    'ciudades' => [
                        'AGUARICO',
                        'ARCHIDONA',
                        'CARLOS J AROSEMENA',
                        'EL CHARCO',
                        'QUIJOS',
                        'TENA'
                    ]
                ],
                
                [
                    'estado' => 'ORELlANA',
                    'ciudades' => [
                        'AGUARICO',
                        'LA JOYA DE LOS SACHAS',
                        'LORETO',
                        'ORELLANA'
                    ]
                ],
                
                [
                    'estado' => 'PASTAZA',
                    'ciudades' => [
                        'PUYO',
                        'ARAJUNO',
                        'MERA',
                        'PASTAZA',
                        'SANTA CLARA'
                    ]
                ],
                
                [
                    'estado' => 'PICHINCHA',
                    'ciudades' => [
                        'CAYAMBE',
                        'MEJIA',
                        'PEDRO MONCAYO',
                        'PEDRO VICENTE MALDONADO',
                        'PUERTO QUITO',
                        'QUITO',
                        'RUMIÑAHUI',
                        'SAN MIGUEL DE LOS BANCOS'
                    ]
                ],
                
                [
                    'estado' => 'SANTA ELENA',
                    'ciudades' => [
                        'LA LIBERTAD',
                        'SALINAS',
                        'SANTA ELENA'
                    ]
                ],
                
                [
                    'estado' => 'SANTO DOMINGO DE LOS TSACHILAS',
                    'ciudades' => [
                        'SANTO DOMINGO DE LOS TSACHILAS'
                    ]
                ],
                
                [
                    'estado' => 'SUCUMBIOS',
                    'ciudades' => [
                        'CASCALES',
                        'CUYABENO',
                        'GONZALO PIZARRO',
                        'LAGO AGRIO',
                        'PUTUMAYO',
                        'SHUSHUFINDI',
                        'SUCUMBIOS'
                    ]
                ],
                
                [
                    'estado' => 'TUNGURAHUA',
                    'ciudades' => [
                        'AMBATO',
                        'BAÑOS DE AGUA SANTA',
                        'CEVALLOS',
                        'MOCHA',
                        'PATATE',
                        'QUERO',
                        'SAN PEDRO DE PELILEO',
                        'SANTIAGO DE PILlARO',
                        'TISALEO'
                    ]
                ],
                
                [
                    'estado' => 'ZAMORA CHINCHIPE',
                    'ciudades' => [
                        'CENTINELA DEL CONDOR',
                        'CHINCHIPE',
                        'EL PANGUI',
                        'NANGARITZA',
                        'PALANDA',
                        'YACUAMBI',
                        'YANTZAZA',
                        'ZAMORA'
                    ]
                ]
                
            ]
        ]
    ];

    public function index()
    {
        return $this->paises;
    }

    public function estados($pais)
    {
        foreach ($this->paises as $row) {
            if ($row['pais'] == $pais) {
                return $row['estados'];
            }
        }
    }

    public function ciudades($pais,$estado)
    {
        foreach ($this->paises as $row) {
            if ($row['pais'] == $pais) {
                foreach ($row['estados'] as $est) {
                    if ($est['estado'] == $estado){
                        return $est['ciudades'];
                    }
                }
                break;
            }
        }
    }
}

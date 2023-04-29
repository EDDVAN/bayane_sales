<?php

namespace Classes;

// if(!defined('ACCESSCHECK')) {
//       die('Direct access not permitted');
// }


use mikehaertl\pdftk\Pdf;

class GeneratePDF
{


      public function generate($data, $path)
      {

            try {
                  $pdf = new Pdf('./new_auth_v2.pdf');
                  $pdf->fillForm($data)
                        ->flatten()
                        ->saveAs($path);
                  //->send( $filename . '.pdf');

                  return $path;
            } catch (Exception $e) {
                  return $e->getMessage();
            }
      }
}

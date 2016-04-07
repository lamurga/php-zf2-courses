<?php
/*
Funciones personalizadas por nosotros
*/

namespace Application\library;
use Complements\Entity\MoreInfo;
use Application\Module;

class Utils
{
    function uniqueSlug($em, $string, $entity, $parent_id, $separator='-') 
    { 
        $slug = $this->fixForUri($this->normalizeWords(utf8_encode($string))); //covertimos la cadena al formato Slug
        $similar = $em->getRepository($entity)->findOneBy(array('slug'=>$slug)); //Consultamos a la bd, si ya existe el slug registrado
        
        if($similar) $slug = $slug.$separator.$parent_id; //Si el slug ya está registrado, lo concatenamos con el parent_id
       
        return $slug;
    }

    public static function toAscii($clean) {
        setlocale(LC_ALL, 'en_US.UTF8');
        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
        $clean = preg_replace("/[^a-zA-Z0-9\/_| -]/", '', $clean);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_| -]+/", '-', $clean);

        return $clean;
    }

    public static function fixForUri($string, $separator='-'){
        $slug = trim($string); // trim a la cadena
        $slug= preg_replace('/[^a-zA-Z0-9 -]/','',$slug ); // solo caracteres alfanuméricos pero manteniedo los guiones
        $slug= str_replace(' ',$separator, $slug); // Reemplazamos espacios en blanco por el separador
        $slug= strtolower($slug);  // convertimos a minusculas
        return $slug;
    }

    public static function friendly_url($string, $seperator='-') {
        $url = strtolower($string);
        $find = array('Ã¡', 'Ã©', 'Ã­', 'Ã³', 'Ãº', 'Ã±', 'Ã�', 'Ã‰' , 'Ã“', 'ú', 'á', 'é', 'í', 'ó', 'ñ');
        $repl = array('a', 'e', 'i', 'o', 'u', 'n' , 'a', 'e', 'o', 'u', 'a', 'e', 'i', 'o','n');
        $url = str_replace ($find, $repl, $url);
        $find = array(' ', '&', '\r\n', '\n', '+', ':');
        $url = str_replace ($find, '-', $url);
        $find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
        //$repl = array('', '-', '');
        $url = preg_replace ($find, $seperator, $url);
        return $url;
    }

    public static function normalizeWords($string) {
        $table = array(
                'Š'=>'S', 'š'=>'s', 'Đ'=>'Dj', 'đ'=>'dj', 'Ž'=>'Z', 'ž'=>'z', 'Č'=>'C', 'č'=>'c', 'Ć'=>'C', 'ć'=>'c',
                'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
                'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
                'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss',
                'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
                'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o',
                'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b',
                'ÿ'=>'y', 'Ŕ'=>'R', 'ŕ'=>'r', '-'=>' '
        );

        $normalized = strtolower(strtr($string, $table));

        // -- return after Remove multiple and srtar-end  spaces
        return trim(preg_replace('/\s+/', ' ',$normalized));
    }

    function saveMoreInfo($em_user, $data, $url_ref) 
    { 
        $success = false;
        if(!empty($data)){
            /*
            $module = new Module();
            $config = $module->getCustomConfig();
            $group_types = $config['group_types'];
            //Obteniendo los tipos agrupados en base a los criterios definidos en Application/Module.php
            
            $tipos = array();
            foreach ($data['chkTipos'] as $tipo) {
                foreach($group_types[$tipo] as $i)
                    array_push($tipos, $i);
            }
            */
            $tipo_ids = \Zend\Json\Json::encode($data['chkTipos']);

            $MoreInfo = new MoreInfo();
            $MoreInfo->setName(utf8_decode($data['txtNombres']));
            $MoreInfo->setLastName(utf8_decode($data['txtApellidos']));
            $MoreInfo->setEmail($data['txtEmail']);
            $MoreInfo->setPhone($data['txtTelefono']);
            $MoreInfo->setCellPhone($data['txtCelular']);
            $MoreInfo->setCountry($data['cboPais']);
            $MoreInfo->setCity(utf8_decode($data['txtCiudad']));
            $MoreInfo->setUrlRef($url_ref);
            //$MoreInfo->setCourseType(json_encode($data['chkTipos']));
            $MoreInfo->setCourseType($tipo_ids);
            $MoreInfo->setTopicsInterest(utf8_decode($data['txtTemas']));
            $MoreInfo->setCreatedAt(new \DateTime());
            
            $em_user->persist($MoreInfo);
            $em_user->flush();
            $success = true;
        }
               
        return $success; 
    }

}

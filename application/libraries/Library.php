<?php
class Library
{
    public function __construct()
    {
        $this->CI = &get_instance();
    }
    function numberToRoman($number) {
        $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $returnValue = '';
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }

    // countPages($path) 
    // digunakan untuk menghitung halman file ekstensi .pdf
    // $path : Lokasi file
    public function countPages($path)
    {
        $pdftext = file_get_contents($path);
        $num = preg_match_all("/\/Page\W/", $pdftext, $dummy);
        return $num;
    }

    public function FileSize($path)
    {
        $size = filesize($path);
        $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $power = $size > 0 ? floor(log($size, 1024)) : 0;
        return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
    }

    public function XssClean($input)
    {
        // $this->printr($_POST);
        return htmlspecialchars(trim($_POST[$input]));
    }

    public function GetDay($DayName)
    {
        $tampung = '';
        switch ($DayName) {
            case 'Sun':
                $tampung = 'Minggu';
                break;
            case 'Mon':
                $tampung = 'Senin';
                break;
            case 'Tue':
                $tampung = 'Selasa';
                break;
            case 'Wed':
                $tampung = 'Rabu';
                break;
            case 'Thu':
                $tampung = 'Kamis';
                break;
            case 'Fri':
                $tampung = 'Jum\'at';
                break;
            case 'Sat':
                $tampung = 'Sabtu';
                break;
        }

        return $tampung;
    }

    function Romawi($number)
    {
        $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $returnValue = '';
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if ($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }
    public function GetMonth($MonthName)
    {
        $tampung = '';
        switch ($MonthName) {
            case 'Jan':
                $tampung = 'Januari';
                break;
            case 'Feb':
                $tampung = 'Februari';
                break;
            case 'Mar':
                $tampung = 'Maret';
                break;
            case 'Apr':
                $tampung = 'April';
                break;
            case 'May':
                $tampung = 'Mei';
                break;
            case 'Jun':
                $tampung = 'Juni';
                break;
            case 'Jul':
                $tampung = 'Juli';
                break;
            case 'Aug':
                $tampung = 'Agustus';
                break;
            case 'Sept':
                $tampung = 'September';
                break;
            case 'Oct':
                $tampung = 'Oktober';
                break;
            case 'Nov':
                $tampung = 'November';
                break;
            case 'Dec':
                $tampung = 'Desember';
                break;
        }
        return $tampung;
    }

    public function GetMonthNum($MonthName)
    {
        $tampung = '';
        switch ($MonthName) {
            case 'Jan':
                $tampung = '01';
                break;
            case 'Feb':
                $tampung = '02';
                break;
            case 'Mar':
                $tampung = '03';
                break;
            case 'Apr':
                $tampung = '04';
                break;
            case 'May':
                $tampung = '05';
                break;
            case 'Jun':
                $tampung = '06';
                break;
            case 'Jul':
                $tampung = '07';
                break;
            case 'Aug':
                $tampung = '08';
                break;
            case 'Sept':
                $tampung = '09';
                break;
            case 'Oct':
                $tampung = '10';
                break;
            case 'Nov':
                $tampung = '11';
                break;
            case 'Dec':
                $tampung = '12';
                break;
        }
        return $tampung;
    }
    public function get_client_ip()
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'IP tidak dikenali';
        return $ipaddress;
    }

    // Mendapatkan jenis web browser pengunjung
    function get_client_browser()
    {
        $browser = '';
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'Netscape'))
            $browser = 'Netscape';
        else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox'))
            $browser = 'Firefox';
        else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome'))
            $browser = 'Chrome';
        else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Opera'))
            $browser = 'Opera';
        else if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE'))
            $browser = 'Internet Explorer';
        else
            $browser = 'Other';
        return $browser;
    }

    public function Encode($string, $count = 7)
    {
        $tampung = [];
        for ($x = 0; $x < $count; $x++) {
            if (count($tampung) == 0) $tampung[] = base64_encode($string);
            else $tampung[] = base64_encode($tampung[$x - 1]);
        }

        return str_replace('=', '', ($tampung[count($tampung) - 1]));
    }

    public function Decode($stringDecode, $count, $RemoveSalt = '')
    {
        $tampung = [];
        for ($x = 0; $x < $count; $x++) {
            if (count($tampung) == 0) $tampung[] = base64_decode($stringDecode);
            else $tampung[] = base64_decode($tampung[$x - 1]);
        }

        return str_replace('=', '', ($tampung[count($tampung) - 1]));
    }

    public function PreviousPage($string = '')
    {

        // import session
        $tampung = substr($_SERVER['REQUEST_URI'], 1, strlen($_SERVER['REQUEST_URI']));
        $page = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $tampung;
        $ExplodePage = explode('?', $page);
        $this->CI->session->set_userdata('previous_page', str_replace($string, '', $ExplodePage[0]));
    }

    public function RedirectPrevious()
    {
        $CekSession = $this->CI->session->userdata('previous_page');
        return !empty($CekSession) ? $CekSession : '/';
    }
    public function printr($array, $mode = 'exit')
    {
        echo '<pre>' . print_r($array, true) . '</pre>';
        if ($mode == 'exit') exit(1);
    }

    public function ValidateEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL))
            return true;
        else
            return false;
    }

    public static function slug($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

    public function UrlMedia($link)
    {
        return "https://gate.bisaai.id/elearning/{$link}/media/";
    }
}
<?php

class FarsiGD {

    public $p_chars = array(
        'آ' => array('ﺂ', 'ﺂ', 'آ'),
        'ا' => array('ﺎ', 'ﺎ', 'ا'),
        'ب' => array('ﺐ', 'ﺒ', 'ﺑ'),
        'پ' => array('ﭗ', 'ﭙ', 'ﭘ'),
        'ت' => array('ﺖ', 'ﺘ', 'ﺗ'),
        'ث' => array('ﺚ', 'ﺜ', 'ﺛ'),
        'ج' => array('ﺞ', 'ﺠ', 'ﺟ'),
        'چ' => array('ﭻ', 'ﭽ', 'ﭼ'),
        'ح' => array('ﺢ', 'ﺤ', 'ﺣ'),
        'خ' => array('ﺦ', 'ﺨ', 'ﺧ'),
        'د' => array('ﺪ', 'ﺪ', 'ﺩ'),
        'ذ' => array('ﺬ', 'ﺬ', 'ﺫ'),
        'ر' => array('ﺮ', 'ﺮ', 'ﺭ'),
        'ز' => array('ﺰ', 'ﺰ', 'ﺯ'),
        'ژ' => array('ﮋ', 'ﮋ', 'ﮊ'),
        'س' => array('ﺲ', 'ﺴ', 'ﺳ'),
        'ش' => array('ﺶ', 'ﺸ', 'ﺷ'),
        'ص' => array('ﺺ', 'ﺼ', 'ﺻ'),
        'ض' => array('ﺾ', 'ﻀ', 'ﺿ'),
        'ط' => array('ﻂ', 'ﻄ', 'ﻃ'),
        'ظ' => array('ﻆ', 'ﻈ', 'ﻇ'),
        'ع' => array('ﻊ', 'ﻌ', 'ﻋ'),
        'غ' => array('ﻎ', 'ﻐ', 'ﻏ'),
        'ف' => array('ﻒ', 'ﻔ', 'ﻓ'),
        'ق' => array('ﻖ', 'ﻘ', 'ﻗ'),
        'ک' => array('ﻚ', 'ﻜ', 'ﻛ'),
        'گ' => array('ﮓ', 'ﮕ', 'ﮔ'),
        'ل' => array('ﻞ', 'ﻠ', 'ﻟ'),
        'م' => array('ﻢ', 'ﻤ', 'ﻣ'),
        'ن' => array('ﻦ', 'ﻨ', 'ﻧ'),
        'و' => array('ﻮ', 'ﻮ', 'ﻭ'),
        'ی' => array('ﯽ', 'ﯿ', 'ﯾ'),
        'ك' => array('ﻚ', 'ﻜ', 'ﻛ'),
        'ي' => array('ﻲ', 'ﻴ', 'ﻳ'),
        'أ' => array('ﺄ', 'ﺄ', 'ﺃ'),
        'ؤ' => array('ﺆ', 'ﺆ', 'ﺅ'),
        'إ' => array('ﺈ', 'ﺈ', 'ﺇ'),
        'ئ' => array('ﺊ', 'ﺌ', 'ﺋ'),
        'ة' => array('ﺔ', 'ﺘ', 'ﺗ')
    );
    public $tahoma = array(
        'ه' => array('ﮫ', 'ﮭ', 'ﮬ')
    );
    public $normal = array(
        'ه' => array('ﻪ', 'ﻬ', 'ﻫ')
    );
    public $mp_chars = array('آ', 'ا', 'د', 'ذ', 'ر', 'ز', 'ژ', 'و', 'أ', 'إ', 'ؤ');
    public $ignorelist = array('', 'ٌ', 'ٍ', 'ً', 'ُ', 'ِ', 'َ', 'ّ', 'ٓ', 'ٰ', 'ٔ', 'ﹶ', 'ﹺ', 'ﹸ', 'ﹼ', 'ﹾ', 'ﹴ', 'ﹰ', 'ﱞ', 'ﱟ', 'ﱠ', 'ﱡ', 'ﱢ', 'ﱣ',);
    public $openClose = array('>', ')', '}', ']', '<', '(', '{', '[');
    public $en_chars = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'); 

    public function persianText($str, $z = null, $method = 'tahoma', $farsiNumber = true) {
        $en_str = '';
        $output = '';
        $e_output = '';
        if($method == 'tahoma') {
            $this->p_chars = array_merge($this->p_chars, $this->tahoma);
        }
        else {
            $this->p_chars = array_merge($this->p_chars, $this->normal);
        }
        $str_len = mb_strlen($str);
        preg_match_all('/./u', $str, $ar);
        for ($i = 0; $i < $str_len; $i++) {
            $gatherNumbers = false;
            $str1 = $ar[0][$i];
            if (isset($ar[0][$i + 1]) && in_array($ar[0][$i + 1], $this->ignorelist)) {
                $str_next = $ar[0][$i + 2];
                if ($i == 2)
                    $str_back = $ar[0][$i - 2];
                if ($i != 2)
                    $str_back = $ar[0][$i - 1];
            }elseif (isset($ar[0][$i - 1]) && !in_array($ar[0][$i - 1], $this->ignorelist)) {
                $str_next = $ar[0][$i + 1];
                if ($i != 0)
                    $str_back = $ar[0][$i - 1];
            }else {
                if (isset($ar[0][$i + 1]) && !empty($ar[0][$i + 1])) {
                    $str_next = $ar[0][$i + 1];
                } else {
                    $str_next = $ar[0][$i - 1];
                }
                if ($i != 0)
                    $str_back = $ar[0][$i - 2];
            }
            if(!isset($str_back)) {
              $str_back = null;
            }
            if (!in_array($str1, $this->ignorelist)) {
                if (array_key_exists($str1, $this->p_chars)) {
                    if (empty($str_back) || !array_key_exists($str_back, $this->p_chars)) {
                        if (!array_key_exists($str_back, $this->p_chars) && !array_key_exists($str_next, $this->p_chars))
                            $output = $str1 . $output;
                        else
                            $output = $this->p_chars[$str1][2] . $output;
                        continue;
                    }
                    elseif (array_key_exists($str_next, $this->p_chars) && array_key_exists($str_back, $this->p_chars)) {
                        if (in_array($str_back, $this->mp_chars) && array_key_exists($str_next, $this->p_chars)) {
                            $output = $this->p_chars[$str1][2] . $output;
                        } else {
                            $output = $this->p_chars[$str1][1] . $output;
                        }
                        continue;
                    } elseif (array_key_exists($str_back, $this->p_chars) && !array_key_exists($str_next, $this->p_chars)) {
                        if (in_array($str_back, $this->mp_chars)) {
                            $output =  $str1 . $output;
                        } else {
                            $output = $this->p_chars[$str1][0] . $output;
                        }
                        continue;
                    }
                }
                elseif ($z == 'fa') {

                    $number = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩', '۴', '۵', '۶', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
                    switch ($str1) {
                        case ')' : $str1 = '(';
                            break;
                        case '(' : $str1 = ')';
                            break;
                        case '}' : $str1 = '{';
                            break;
                        case '{' : $str1 = '}';
                            break;
                        case ']' : $str1 = '[';
                            break;
                        case '[' : $str1 = ']';
                            break;
                        case '>' : $str1 = '<';
                            break;
                        case '<' : $str1 = '>';
                            break;
                    }
                    if (in_array($str1, $number)) {
                        if ( $farsiNumber ) {
                            $num .= $this->fa_number($str1);
                        } else {
                            $num .= $str1;
                        }
                        $str1 = '';
                    }
                    
                    if ( !in_array($str_next, $number) ) {
                        if ( in_array(strtolower($str1), $this->en_chars) || (($str1==' ' || $str1=='.') &&$en_str!='' && !in_array($str_next, $this->p_chars)) ) {
                            $en_str .= $str1 . $num;
                            $str1 = '';
                        } else {
                            if ( $en_str!='' ) {
                                if ($i == $str_len - 1) {
                                    $str1 = $str1.$num;
                                } else {
                                    $en_str .= $str1 .$num;
                                }
                            } else {
                                $str1 = $str1.$num;
                            }    
                           
                        }
                        $num = '';
                    }
                    if ($en_str != '' || ($str1 != '' && $i == 0 && (!array_key_exists($str_next, $this->p_chars) && $str_next != ' ')) || $gatherNumbers ) {

                        if ( !array_key_exists($str1, $this->p_chars) ) {
                            if ( !array_key_exists($str_next, $this->p_chars) && $str_next!=' ' && !in_array($str_next, $this->openClose) ) { 
                                $en_str = $en_str.$str1;                               
                            } else {
                                if ( in_array($ar[0][$i+2], $this->en_chars) ) {
                                   $en_str = $en_str.$str1;
                                } else {
                                    
                                    if ( $str_next==' ' && ( in_array($ar[0][$i+2], $number) || in_array(strtolower($ar[0][$i+2]), $this->en_chars) ) ) {
                                        $en_str = $en_str.$str1;
                                    } else {
                                            $output = $en_str . $output;
                                            $en_str = '';
                                    }
                                    
                                }
                            }
                            
                        }
                        elseif($num) {
                            $en_str = $en_str .$num;
                        }
                        else {
                            $output = $en_str . $str1 . $output ;
                            $en_str = '';
                        }
                        
                    }
                    else {
                        
                        if(in_array($str1, $number) && $str_next == '.' && in_array($ar[0][$i+2], $number)) {
                            $en_str = $str1;
                        }
                        else {
                            $output = $str1. $output ;
                        }
                    }    
                }
                else {
                    if (($str1 == '،') || ($str1 == '؟') || ($str1 == 'ء') || (array_key_exists($str_next, $this->p_chars) && array_key_exists($str_back, $this->p_chars)) or
                            ($str1 == ' ' && array_key_exists($str_back, $this->p_chars)) || ($str1 == ' ' && array_key_exists($str_next, $this->p_chars))) {
                        if ($e_output) {
                            $output = $e_output . $output;
                            $e_output = '';
                        }
                        $output = $str1 . $output;
                    } else {
                        $e_output.=$str1;
                        if (array_key_exists($str_next, $this->p_chars) || $str_next == '') {
                            $output = $e_output . $output;
                            $e_output = '';
                        }
                    }
                }
            } else {
                $output = $str1 . $output;
            }
            
            $str_next = null;
            $str_back = null;
        }

        if(!empty($en_str)) {
            $output = $en_str . $output;
        }
        return $output;
    }

    public function fa_number($num) {
        return str_replace(array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'), array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'), $num);
    }

}

?>
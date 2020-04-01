<?php

/**
 * 域名品相分析
 * Class DomainCheck
 */
class DomainCheck
{
    public function check($domain)
    {
        // 判断是否为域名
        $idDomain = !empty($domain) && strpos($domain, '--') === false
        && preg_match('/^([a-z0-9]+([a-z0-9-]*(?:[a-z0-9]+))?\.)?[a-z0-9]+([a-z0-9-]*(?:[a-z0-9]+))?(\.us|\.tv|\.org\.cn|\.org|\.net\.cn|\.net|\.mobi|\.me|\.la|\.info|\.hk|\.gov\.cn|\.edu|\.com\.cn|\.com|\.co\.jp|\.co|\.cn|\.cc|\.biz)$/i', $domain) ? true : false;
        if (!$idDomain) {
            return '域名格式不正确';
        }

        // 取 www.baidu.com 中的baidu来分析
        $strs = explode('.', $domain);
        $checkStrs = array_reverse($strs)[1];

        // 判断是否为数字域名
        if (preg_match("/^\d*$/", $checkStrs)) {
            return '纯数字域名';
        }


        // 判断是否为纯字母域名
        if (preg_match('/^[a-zA-z]*$/', $checkStrs)) {
            $result = explode(' ', $this->split_func($checkStrs));
            if (count($result) > 1) {
              return count($result) . '拼域名';
            } else {
                return '纯字母域名';
            }

        }

        // 判断是否为杂米域名  包含数字字母以及-
        if (preg_match('/^[a-zA-z0-9\-]*$/', $checkStrs)) {
            return '杂米域名';
        }

    }

    private function split_func($str)
    {
        $vowel = array('a', 'e', 'i', 'o', 'u', 'v');;
        $result = "";
        $i = 0;
        for ($i = 0; $i < strlen($str); $i++) {
            if (in_array($str[$i], $vowel)) {
                $result .= $str[$i];
                continue;
            } else {
                if ($str[$i] != 'n') {
                    if ($i == 0) {
                        $result .= $str[$i];
                    } else {
                        $result .= ' ' . $str[$i];
                    }
                    if ((($i + 1) < strlen($str) and $str[$i] == 'z' or $str[$i] == 'c' or $str[$i] == 's') and ($str[$i + 1] == 'h')) {
                        $result .= 'h';
                        $i++;
                    }
                    continue;
                } else                 //是n,继续向后
                {
                    if ($i == strlen($str) - 1) {
                        $result .= $str[$i];
                        continue;
                    } else
                        $i++;   //继续向后

                    if (in_array($str[$i], $vowel))   //如果是原音,从n前分开
                    {
                        if ($i == 1) {
                            $result .= 'n' . $str[$i];
                            continue;
                        } else {
                            $result .= ' ' . 'n' . $str[$i];
                            continue;
                        }
                    } //如果是辅音字母
                    else {
                        if ($str[$i] == 'g') {
                            if ($i == strlen($str) - 1) {
                                $result .= 'n' . $str[$i];
                                continue;
                            } else
                                $i++;  //继续向后

                            if (in_array($str[$i], $vowel)) {
                                $result .= 'n' . ' ' . 'g' . $str[$i];
                                continue;
                            } else {
                                $result .= 'n' . 'g' . ' ' . $str[$i];
                                if (($i + 1) < strlen($str) and ($str[$i] == 'z' or $str[$i] == 'c' or $str[$i] == 's') and
                                    ($str[$i + 1] == 'h')) {
                                    $result .= 'h';
                                    $i++;
                                }
                                continue;
                            }
                        } else   //不是g的辅音字母,从n后分开
                        {
                            $result .= 'n' . ' ' . $str[$i];
                            if (($i + 1) < strlen($str) and ($str[$i] == 'z' or $str[$i] == 'c' or $str[$i] == 's') and
                                ($str[$i + 1] == 'h')) {
                                $result .= 'h';
                                $i++;
                            }
                            continue;
                        }
                    }
                }
            }
        }
        return $result;
    }
}

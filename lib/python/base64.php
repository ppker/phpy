<?php
namespace python;

/**
Base16, Base32, Base64 (RFC 3548), Base85 and Ascii85 data encodings*/
class base64{
    /**
    * @return base64 
    */
    public static function import()
    {
        return \PyCore::import('base64');
    }
    public $MAXBINSIZE = 57;
    public $MAXLINESIZE = 76;

    public $_A85END = "~>";
    public $_A85START = "<~";
    public $_B32_DECODE_DOCSTRING = "\nDecode the {encoding} encoded bytes-like object or ASCII string s.\n\nOptional casefold is a flag specifying whether a lowercase alphabet is\nacceptable as input.  For security purposes, the default is False.\n{extra_args}\nThe result is returned as a bytes object.  A binascii.Error is raised if\nthe input is incorrectly padded or if there are non-alphabet\ncharacters present in the input.\n";
    public $_B32_DECODE_MAP01_DOCSTRING = "\nRFC 3548 allows for optional mapping of the digit 0 (zero) to the\nletter O (oh), and for optional mapping of the digit 1 (one) to\neither the letter I (eye) or letter L (el).  The optional argument\nmap01 when not None, specifies which letter the digit 1 should be\nmapped to (when map01 is not None, the digit 0 is always mapped to\nthe letter O).  For security purposes the default is None, so that\n0 and 1 are not allowed in the input.\n";
    public $_B32_ENCODE_DOCSTRING = "\nEncode the bytes-like objects using {encoding} and return a bytes object.\n";
    public $__name__ = "base64";
    public $__package__ = "";
    public $_a85chars = null;
    public $_a85chars2 = null;
    public $_b32alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ234567";
    public $_b32hexalphabet = "0123456789ABCDEFGHIJKLMNOPQRSTUV";
    public $_b85alphabet = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz!#$%&()*+-;<=>?@^_`{|}~";
    public $_b85chars = null;
    public $_b85chars2 = null;
    public $_b85dec = null;
    public $_urlsafe_decode_translation = "\x00\t\n\v\r !\"#$%&'()*+,+./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\\]^/`abcdefghijklmnopqrstuvwxyz{|}~��������������������������������������������������������������������������������������������������������������������������������";
    public $_urlsafe_encode_translation = "\x00\t\n\v\r !\"#$%&'()*-,-._0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\\]^_`abcdefghijklmnopqrstuvwxyz{|}~��������������������������������������������������������������������������������������������������������������������������������";

    public $_b32rev = null;
    public $_b32tab2 = null;
    public $binascii = null;
    public $bytes_types = null;
    public $re = null;
    public $struct = null;

    public function _85encode($b, $chars, $chars2, $pad = false, $foldnuls = false, $foldspaces = false)
    {
    }

    public function _b32decode($alphabet, $s, $casefold = false, $map01 = null)
    {
    }

    public function _b32encode($alphabet, $s)
    {
    }

    public function _bytes_from_decode_data($s)
    {
    }

    public function _input_type_check($s)
    {
    }

    public function a85decode($b)
    {
    }

    public function a85encode($b)
    {
    }

    public function b16decode($s, $casefold = false)
    {
    }

    public function b16encode($s)
    {
    }

    public function b32decode($s, $casefold = false, $map01 = null)
    {
    }

    public function b32encode($s)
    {
    }

    public function b32hexdecode($s, $casefold = false)
    {
    }

    public function b32hexencode($s)
    {
    }

    public function b64decode($s, $altchars = null, $validate = false)
    {
    }

    public function b64encode($s, $altchars = null)
    {
    }

    public function b85decode($b)
    {
    }

    public function b85encode($b, $pad = false)
    {
    }

    public function decode($input, $output)
    {
    }

    public function decodebytes($s)
    {
    }

    public function encode($input, $output)
    {
    }

    public function encodebytes($s)
    {
    }

    public function main()
    {
    }

    public function standard_b64decode($s)
    {
    }

    public function standard_b64encode($s)
    {
    }

    public function test()
    {
    }

    public function urlsafe_b64decode($s)
    {
    }

    public function urlsafe_b64encode($s)
    {
    }

}

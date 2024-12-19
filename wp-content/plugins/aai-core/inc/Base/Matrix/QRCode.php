<?php
namespace Element_Ready_Pro\Base\Matrix;

class QRCode
{
    const API_URL = 'https://chart.googleapis.com/chart?chs=';
    private $sData;
    private $color;
    private $encode;
    /**
     * Constructor.
     */
    public function __construct($color='',$encode ='UTF-8')
    {
        $this->color = $color; 
        $this->encode = $encode; 
        $this->sData = 'BEGIN:VCARD' . "\n";
        $this->sData .= 'VERSION:4.0' . "\n";
    }

    /**
     * The name of the person.
     *
     * @param string $sName
     *
     * @return self
     */
    public function add_line($sName)
    {
        $this->sData .= '' . $sName . "\n";
        return $this;
    }

    /**
     * Photo (avatar).
     *
     * @param string $sImgUrl URL of the image.
     *
     * @return self
     *
     * @throws InvalidArgumentException If the image format is invalid.
     */
    public function add_photo($sImgUrl)
    {
        $bIsImgExt = strtolower(substr(strrchr($sImgUrl, '.'), 1)); // Get the file extension.

        if ($bIsImgExt == 'jpeg' || $bIsImgExt == 'jpg' || $bIsImgExt == 'png' || $bIsImgExt == 'gif') {
            $sExt = strtoupper($bIsImgExt);
        } else {
            throw new InvalidArgumentException('Invalid format Image!');
        }

        $this->sData .= 'PHOTO;VALUE=URL;TYPE=' . $sExt . ':' . $sImgUrl . "\n";

        return $this;
    }

   

    /**
     * Generate the QR code.
     *
     * @return self
     */
    public function finish()
    {
        $this->sData .= 'END:VCARD';
        $this->sData = urlencode($this->sData);
   
        return $this;
    }

    /**
     * Get the URL of QR Code.
     *
     * @param integer $iSize Default 150
     * @param string $sECLevel Default L
     * @param integer $iMargin Default 1
     *
     * @return string The API URL configure.
     */
    public function get($iSize = 150, $sECLevel = 'L', $iMargin = 1)
    {
       
        $this->color = $this->rgb_to_hex($this->color);
        return self::API_URL . $iSize . 'x' . $iSize . '&cht=qr&chld=' . $sECLevel . '|' . $iMargin . '&chl=' . $this->sData."&choe=$this->encode&chf=bg,lg,$this->color ";
    }

    public function rgb_to_hex( $color ) {

        $pattern = "/(\d{1,3})\,?\s?(\d{1,3})\,?\s?(\d{1,3})/";
    
        // Only if it's RGB
        if ( preg_match( $pattern, $color, $matches ) ) {
          $r = $matches[1];
          $g = $matches[2];
          $b = $matches[3];
    
          $color = sprintf("%02x%02x%02x", $r, $g, $b);
        }
    
        return str_replace('#','',$color);
    }

    /**
     * The HTML code for displaying the QR Code.
     *
     * @return void
     */
    public function display($iSize = 150, $sECLevel = 'L', $iMargin = 1)
    {
        echo '<p class="center"><img src="' . $this->_cleanUrl($this->get($iSize, $sECLevel, $iMargin)) . '" alt="QR Code" /></p>';
    }

    /**
     * Clean URL.
     *
     * @param string $sUrl
     *
     * @return string
     */
    private function _cleanUrl($sUrl)
    {
        return str_replace('&', '&amp;', $sUrl);
    }
}